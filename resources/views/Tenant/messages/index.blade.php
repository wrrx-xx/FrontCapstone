@extends('layouts.app')

@section('content')
<div class="main-content">
  <div class="container py-4">
    <h2 class="mb-4">Messages</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm" style="min-height: 600px;">
          <div class="row g-0">
            <!-- Sidebar: List of chat partners and send message dropdown -->
            <div class="col-md-3 border-end bg-light d-flex flex-column">
              <div class="p-3 border-bottom bg-primary text-white d-flex align-items-center">
                <i class="fas fa-users me-2"></i>
                <strong>Conversations</strong>
              </div>
              <div id="chat-partners-list" class="list-group list-group-flush overflow-auto flex-grow-1" style="max-height: 400px;">
                @php
                  $userId = auth()->id();
                  $chatPartners = collect();
                  if (isset($owner)) {
                    $chatPartners->push($owner);
                    foreach ($owner->caretakers as $caretaker) {
                      $chatPartners->push($caretaker);
                    }
                  }
                  $chatPartners = $chatPartners->unique('id')->values();

                  // Get IDs of chat partners to exclude from dropdown
                  $chatPartnerIds = $chatPartners->pluck('id')->all();

                  // Filter caretakers to exclude those already in conversations
                  $caretakersForDropdown = collect();
                  if (isset($owner)) {
                    foreach ($owner->caretakers as $caretaker) {
                      if (!in_array($caretaker->id, $chatPartnerIds)) {
                        $caretakersForDropdown->push($caretaker);
                      }
                    }
                  }
                @endphp
                @forelse($chatPartners as $partner)
                  <a href="#" class="list-group-item list-group-item-action chat-partner-item" data-user-id="{{ $partner->id }}">
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                           style="width: 40px; height: 40px;">
                        {{ strtoupper(substr($partner->fname, 0, 1)) }}
                      </div>
                      <div>
                        <div class="fw-bold">{{ $partner->fname }} {{ $partner->lname }}</div>
                        <div class="small text-muted">{{ $partner->email }}</div>
                      </div>
                    </div>
                  </a>
                @empty
                  <div class="list-group-item text-center text-muted py-4">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <div>No conversations yet</div>
                  </div>
                @endforelse
              </div>
              @if(isset($owner))
              <div class="p-3 border-top bg-white">
                <label for="recipient-select" class="form-label mb-1">Send message to:</label>
                <select id="recipient-select" class="form-select form-select-sm w-100" name="recipient_id">
                  <option value="{{ $owner->id }}" selected>Owner{{ ' ('.$owner->fname.' '.$owner->lname.')' }}</option>
                  @foreach($caretakersForDropdown as $caretaker)
                    <option value="{{ $caretaker->id }}">Caretaker{{ ' ('.$caretaker->fname.' '.$caretaker->lname.')' }}</option>
                  @endforeach
                </select>
              </div>
              @endif
            </div>
            <!-- Chat area -->
            <div class="col-md-9 d-flex flex-column">
              <div class="p-3 border-bottom bg-light d-flex align-items-center">
                <strong id="chat-header">Select a conversation to start chatting</strong>
              </div>
              <div class="flex-grow-1 overflow-auto px-4 py-3" id="chat-box" style="background: #f8f9fa; height: 450px;"></div>
              <div class="p-3 border-top bg-white">
                <form id="sendMessageForm" class="d-flex gap-2 align-items-center" style="display:none;">
                  @csrf
                  <input type="hidden" name="listing_id" id="listing_id" value="{{ $listing->id ?? request('listing_id') ?? '' }}">
                  <input type="hidden" name="receiver_id" id="receiver_id" value="">
                  <div class="flex-grow-1 position-relative">
                    <textarea class="form-control" id="message" name="message" rows="1" 
                              placeholder="Type your message..." required style="resize:none; padding-right: 40px;"></textarea>
                    <div id="typing-status" class="position-absolute bottom-0 end-0 p-2 text-muted" style="display: none;">
                      <small><i class="fas fa-check"></i></small>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-paper-plane"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
  const userId = {{ auth()->id() }};
  const chatPartners = @json($chatPartners ?? []);
  const messages = [];
  const chatBox = document.getElementById('chat-box');
  const chatHeader = document.getElementById('chat-header');
  const form = document.getElementById('sendMessageForm');
  const messageInput = document.getElementById('message');
  const receiverInput = document.getElementById('receiver_id');
  const listingIdInput = document.getElementById('listing_id');
  const recipientSelect = document.getElementById('recipient-select');
  let selectedUserId = null;

  // Initialize Pusher
  const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
    forceTLS: true
  });

  const channel = pusher.subscribe('chat-channel');

  channel.bind('new-message', function(data) {
    if ((data.sender_id === userId && data.receiver_id === selectedUserId) ||
        (data.sender_id === selectedUserId && data.receiver_id === userId)) {
      messages.push(data);
      renderChat(selectedUserId);
    }
  });

   function renderChat(tenantId) {
    chatBox.innerHTML = '';
    const chatMessages = messages.filter(m =>
      (m.sender_id == tenantId && m.receiver_id == userId) ||
      (m.sender_id == userId && m.receiver_id == tenantId)
    ).sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

    let lastDate = '';
    
    chatMessages.forEach(msg => {
      const messageDate = new Date(msg.created_at).toLocaleDateString();
      
      // Add date separator if it's a new day
      if (messageDate !== lastDate) {
        const dateDiv = document.createElement('div');
        dateDiv.className = 'text-center my-3';
        dateDiv.innerHTML = `<span class="badge bg-secondary">${messageDate}</span>`;
        chatBox.appendChild(dateDiv);
        lastDate = messageDate;
      }

      const isMine = msg.sender_id == userId;
      const msgDiv = document.createElement('div');
      msgDiv.className = `d-flex ${isMine ? 'justify-content-end' : 'justify-content-start'} mb-3`;
      
      const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      
      msgDiv.innerHTML = `
        <div class="message ${isMine ? 'message-mine' : 'message-other'}" 
             style="max-width: 70%; background: ${isMine ? '#007bff' : '#f8f9fa'}; 
                    color: ${isMine ? 'white' : 'black'}; 
                    border-radius: 15px;
                    padding: 10px 15px;
                    margin: 2px 15px;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
          <div style="word-break: break-word;">${msg.message}</div>
          <div class="small ${isMine ? 'text-white-50' : 'text-muted'} text-end">${time}</div>
        </div>
      `;
      
      chatBox.appendChild(msgDiv);
    });
    
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  document.querySelectorAll('.chat-partner-item').forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      selectedUserId = parseInt(this.getAttribute('data-user-id'));
      receiverInput.value = selectedUserId;
      chatHeader.textContent = this.textContent.trim();
      form.style.display = 'flex';
      fetchMessages(selectedUserId);
    });
  });

  if (recipientSelect) {
    recipientSelect.addEventListener('change', function() {
      receiverInput.value = this.value;
    });
  }

  function fetchMessages(userId) {
    fetch(`{{ route('messages.fetch') }}?listing_id=${listingIdInput.value}&user_id=${userId}`)
      .then(response => response.json())
      .then(data => {
        messages.length = 0;
        messages.push(...data);
        renderChat(userId);
      });
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    fetch("{{ route('messages.send') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': formData.get('_token'),
        'Accept': 'application/json',
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      messageInput.value = '';
      messages.push(data);
      renderChat(selectedUserId);
    });
  });
</script>
@endsection

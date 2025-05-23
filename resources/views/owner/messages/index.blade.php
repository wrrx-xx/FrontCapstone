@extends('layouts.app')

@section('content')
<div class="main-content">
  <div class="container py-4">
    <h2 class="mb-4">Messages</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm" style="min-height: 500px;">
          <div class="row g-0">
            <!-- Sidebar: List of tenants -->
            <div class="col-md-4 border-end" style="background: #f8f9fa; min-height: 500px;">
              <div class="p-3 border-bottom bg-primary text-white"><strong>Tenants</strong></div>
              <div id="tenant-list" class="list-group list-group-flush">
                @php
                  $userId = auth()->id();
                  $tenants = collect($messages)->map(function($m) use ($userId) {
                    return $m->sender_id == $userId ? $m->receiver : $m->sender;
                  })->unique('id')->values();
                @endphp
                @forelse($tenants as $tenant)
                  <a href="#" class="list-group-item list-group-item-action tenant-item" data-tenant-id="{{ $tenant->id }}">
                    <div class="fw-bold">{{ $tenant->fname }} {{ $tenant->lname }}</div>
                    <div class="small text-muted">{{ $tenant->email }}</div>
                  </a>
                @empty
                  <div class="list-group-item text-center text-muted">No tenants have messaged you yet.</div>
                @endforelse
              </div>
            </div>
            <!-- Chat area -->
            <div class="col-md-8 d-flex flex-column" style="min-height: 500px;">
              <div class="p-3 border-bottom bg-light"><strong id="chat-header">Select a tenant to view messages</strong></div>
              <div class="flex-grow-1 overflow-auto" id="chat-box" style="background: #f8f9fa; padding: 1rem; height: 350px;"></div>
              <div class="p-3 border-top bg-white">
                <form id="sendMessageForm" class="d-flex gap-2 align-items-center" style="display:none;">
                  @csrf
                  <input type="hidden" name="listing_id" id="listing_id" value="">
                  <input type="hidden" name="receiver_id" id="receiver_id" value="">
                  <textarea class="form-control" id="message" name="message" rows="1" placeholder="Type your message..." required style="resize:none;"></textarea>
                  <button type="submit" class="btn btn-primary px-4">Send</button>
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
  const tenants = @json($tenants ?? []);
  const messages = @json($messages);
  const chatBox = document.getElementById('chat-box');
  const tenantList = document.getElementById('tenant-list');
  const chatHeader = document.getElementById('chat-header');
  const form = document.getElementById('sendMessageForm');
  const messageInput = document.getElementById('message');
  let selectedTenantId = null;
  let selectedListingId = null;

  // Pusher config for local websocket
  var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
    wsHost: '{{ env('PUSHER_HOST') }}',
    wsPort: {{ env('PUSHER_PORT') }},
    forceTLS: false,
    encrypted: false,
    enabledTransports: ['ws', 'wss'],
  });
  var channel = pusher.subscribe('chat-channel');
  channel.bind('new-message', function(data) {
    // Only update if the message is for this conversation
    if ((data.sender_id == userId && data.receiver_id == selectedTenantId) ||
        (data.sender_id == selectedTenantId && data.receiver_id == userId)) {
      renderChat(selectedTenantId);
    }
  });

  // Render chat messages for selected tenant
  function renderChat(tenantId) {
    chatBox.innerHTML = '';
    const chatMessages = messages.filter(m =>
      (m.sender_id == tenantId && m.receiver_id == userId) ||
      (m.sender_id == userId && m.receiver_id == tenantId)
    );
    chatMessages.forEach(msg => {
      const isMine = msg.sender_id == userId;
      let senderLabel = '';
      if (!isMine) {
        if (msg.sender_role === 'caretaker') {
          senderLabel = '<div class="small fw-bold text-info mb-1">Caretaker</div>';
        } else {
          senderLabel = '<div class="small fw-bold text-primary mb-1">Owner</div>';
        }
      }
      const msgDiv = document.createElement('div');
      msgDiv.className = 'd-flex ' + (isMine ? 'justify-content-end' : 'justify-content-start');
      msgDiv.innerHTML = `${senderLabel}<div class="p-2 rounded ${isMine ? 'bg-primary text-white' : 'bg-light border'}" style="max-width: 70%; word-break: break-word;">
        <div class="small">${msg.message}</div>
        <div class="text-end small text-muted mt-1">${new Date(msg.created_at).toLocaleString()}</div>
      </div>`;
      chatBox.appendChild(msgDiv);
    });
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  // Handle tenant click
  tenantList.querySelectorAll('.tenant-item').forEach(item => {
    item.addEventListener('click', function() {
      selectedTenantId = this.getAttribute('data-tenant-id');
      // Find the first message to get the listing_id
      const firstMsg = messages.find(m =>
        (m.sender_id == selectedTenantId && m.receiver_id == userId) ||
        (m.sender_id == userId && m.receiver_id == selectedTenantId)
      );
      selectedListingId = firstMsg ? firstMsg.listing_id : '';
      const tenant = tenants.find(t => t.id == selectedTenantId);
      chatHeader.textContent = tenant ? (tenant.fname + ' ' + tenant.lname) : 'Chat';
      document.getElementById('receiver_id').value = selectedTenantId;
      document.getElementById('listing_id').value = selectedListingId;
      form.style.display = '';
      renderChat(selectedTenantId);
    });
  });

  // Send message via AJAX
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
      renderChat(selectedTenantId);
    });
  });
</script>
@endsection

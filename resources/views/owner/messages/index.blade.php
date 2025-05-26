@extends('layouts.app')

@section('content')
<div class="main-content">
  <div class="container py-4">
    <h2 class="mb-4">Messages</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm" style="min-height: 600px;">
          <div class="row g-0">
            <!-- Sidebar: List of contacts -->
            <div class="col-md-4 border-end" style="background: #f8f9fa;">
              <div class="p-3 border-bottom bg-primary text-white">
                <i class="fas fa-users me-2"></i>
                <strong>Contacts</strong>
              </div>
              <div id="tenant-list" class="list-group list-group-flush overflow-auto" style="max-height: 540px;">
                <!-- Caretakers Section -->
                @if($caretakers->isNotEmpty())
                  <div class="list-group-item bg-light">
                    <small class="text-muted">CARETAKERS</small>
                  </div>
                  @foreach($caretakers as $caretaker)
                    <a href="#" class="list-group-item list-group-item-action tenant-item" data-tenant-id="{{ $caretaker->id }}">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                             style="width: 40px; height: 40px;">
                          {{ strtoupper(substr($caretaker->fname, 0, 1)) }}
                        </div>
                        <div>
                          <div class="fw-bold">
                            {{ $caretaker->fname }} {{ $caretaker->lname }}
                            <small class="text-muted">(Caretaker)</small>
                          </div>
                          <div class="small text-muted">{{ $caretaker->email }}</div>
                        </div>
                      </div>
                    </a>
                  @endforeach
                @endif

                <!-- Tenants Section -->
                @if($tenants->isNotEmpty())
                  <div class="list-group-item bg-light">
                    <small class="text-muted">TENANTS</small>
                  </div>
                  @foreach($tenants as $tenant)
                    <a href="#" class="list-group-item list-group-item-action tenant-item" data-tenant-id="{{ $tenant->id }}">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                             style="width: 40px; height: 40px;">
                          {{ strtoupper(substr($tenant->fname, 0, 1)) }}
                        </div>
                        <div>
                          <div class="fw-bold">
                            {{ $tenant->fname }} {{ $tenant->lname }}
                            <small class="text-muted">(Tenant)</small>
                          </div>
                          <div class="small text-muted">{{ $tenant->email }}</div>
                        </div>
                      </div>
                    </a>
                  @endforeach
                @endif

                @if($caretakers->isEmpty() && $tenants->isEmpty())
                  <div class="list-group-item text-center text-muted py-4">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <div>No messages yet</div>
                  </div>
                @endif
              </div>
            </div>
            <!-- Chat area -->
            <div class="col-md-8 d-flex flex-column">
              <div class="p-3 border-bottom bg-light d-flex align-items-center">
                <strong id="chat-header">Select a contact to view messages</strong>
                <div id="typing-indicator" class="ms-2 text-muted small" style="display: none;">
                  <i class="fas fa-ellipsis-h"></i> typing...
                </div>
              </div>
              <div class="flex-grow-1 overflow-auto px-4 py-3" id="chat-box" style="background: #f8f9fa; height: 450px;"></div>
              <div class="p-3 border-top bg-white">
                <form id="sendMessageForm" class="d-flex gap-2 align-items-center" style="display:none;">
                  @csrf
                  <input type="hidden" name="listing_id" id="listing_id" value="">
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
  const tenants = @json($tenants ?? []);
  const caretakers = @json($caretakers ?? []);
  const messages = @json($messages);
  const chatBox = document.getElementById('chat-box');
  const tenantList = document.getElementById('tenant-list');
  const chatHeader = document.getElementById('chat-header');
  const form = document.getElementById('sendMessageForm');
  const messageInput = document.getElementById('message');
  const typingIndicator = document.getElementById('typing-indicator');
  let selectedTenantId = null;
  let selectedListingId = null;
  let typingTimeout;

  // Initialize Pusher with your credentials
  const pusher = new Pusher('cd41a83ff730f0a45b61', {
    cluster: 'ap1',
    forceTLS: true
  });

  const channel = pusher.subscribe('chat-channel');
  
  // Listen for new messages
  channel.bind('new-message', function(data) {
    if (data.sender_id != userId &&
        ((data.sender_id == selectedTenantId && data.receiver_id == userId) ||
         (data.sender_id == userId && data.receiver_id == selectedTenantId))) {
      messages.push(data);
      renderChat(selectedTenantId);
    }
  });

  // Listen for typing events
  channel.bind('user-typing', function(data) {
    if (data.sender_id == selectedTenantId && data.receiver_id == userId) {
      typingIndicator.style.display = data.typing ? 'block' : 'none';
    }
  });

  function renderChat(tenantId) {
    if (!tenantId) return;
    
    chatBox.innerHTML = '';
    const chatMessages = messages.filter(m =>
      (m.sender_id == tenantId && m.receiver_id == userId) ||
      (m.sender_id == userId && m.receiver_id == tenantId)
    ).sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

    if (chatMessages.length === 0) {
      chatBox.innerHTML = `
        <div class="text-center text-muted py-5">
          <i class="fas fa-comments fa-3x mb-3"></i>
          <div>No messages yet. Start the conversation!</div>
        </div>
      `;
      return;
    }

    let lastDate = '';
    
    chatMessages.forEach(msg => {
      const messageDate = new Date(msg.created_at).toLocaleDateString();
      
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

  // Handle contact selection
  tenantList.querySelectorAll('.tenant-item').forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      tenantList.querySelectorAll('.tenant-item').forEach(i => i.classList.remove('active'));
      this.classList.add('active');
      
      selectedTenantId = this.getAttribute('data-tenant-id');
      const firstMsg = messages.find(m =>
        (m.sender_id == selectedTenantId && m.receiver_id == userId) ||
        (m.sender_id == userId && m.receiver_id == selectedTenantId)
      );
      selectedListingId = firstMsg ? firstMsg.listing_id : '';
      
      const selectedUser = [...tenants, ...caretakers].find(t => t && t.id == selectedTenantId);
      chatHeader.textContent = selectedUser ? `${selectedUser.fname} ${selectedUser.lname}` : 'Chat';
      
      document.getElementById('receiver_id').value = selectedTenantId;
      document.getElementById('listing_id').value = selectedListingId;
      form.style.display = 'flex';

      // Clear chat box immediately and show loading state
      chatBox.innerHTML = `
        <div class="text-center text-muted py-5">
          <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
          <div>Loading conversation...</div>
        </div>
      `;

      // Fetch messages for the selected user
      if (selectedListingId) {
        fetch(`/messages/fetch?listing_id=${selectedListingId}&user_id=${selectedTenantId}`, {
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
        .then(response => response.json())
        .then(data => {
          messages.length = 0; // Clear existing messages
          messages.push(...data); // Add new messages
          renderChat(selectedTenantId);
        })
        .catch(error => {
          console.error('Error fetching messages:', error);
          chatBox.innerHTML = `
            <div class="text-center text-danger py-5">
              <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
              <div>Failed to load conversation.</div>
            </div>
          `;
        });
      } else {
        renderChat(selectedTenantId);
      }
    });
  });

  // Handle message typing
  messageInput.addEventListener('input', function() {
    if (selectedTenantId) {
      clearTimeout(typingTimeout);
      
      fetch('/messages/typing', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          receiver_id: selectedTenantId,
          listing_id: selectedListingId,
          typing: true
        })
      });

      typingTimeout = setTimeout(() => {
        fetch('/messages/typing', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            receiver_id: selectedTenantId,
            listing_id: selectedListingId,
            typing: false
          })
        });
      }, 1000);
    }
  });

  // Handle form submission
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const message = messageInput.value.trim();
    if (!message || !selectedTenantId) return;

    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    fetch('/messages/send', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        receiver_id: selectedTenantId,
        listing_id: selectedListingId,
        message: message
      })
    })
    .then(response => response.json())
    .then(data => {
      messages.push(data);
      messageInput.value = '';
      renderChat(selectedTenantId);
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Failed to send message. Please try again.');
    })
    .finally(() => {
      submitButton.disabled = false;
      messageInput.focus();
    });
  });
</script>

<style>
.tenant-item {
  transition: all 0.2s ease;
}
.tenant-item:hover {
  background-color: #f0f0f0;
}
.tenant-item.active {
  background-color: #e9ecef;
  border-left: 4px solid #007bff;
}
.message {
  transition: all 0.2s ease;
}
.message:hover {
  transform: translateY(-1px);
}
</style>
@endsection

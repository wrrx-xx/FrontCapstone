@extends('layouts.app')

@section('content')
<div class="main-content">
  <div class="container py-4">
    <h2 class="mb-4">Messages</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm" style="min-height: 600px;">
          <div class="row g-0">
            <!-- Sidebar: List of tenants -->
            <div class="col-md-4 border-end" style="background: #f8f9fa;">
              <div class="p-3 border-bottom bg-primary text-white d-flex align-items-center justify-content-between">
                <div>
                  <i class="fas fa-users me-2"></i>
                  <strong>Contacts</strong>
                </div>
                @if(isset($owner))
                  <button id="messageOwnerBtn" class="btn btn-sm btn-light" type="button">
                    Message Owner
                  </button>
                @endif
              </div>
              <div id="tenant-list" class="list-group list-group-flush overflow-auto" style="max-height: 540px;">
                @forelse($tenants as $tenant)
                  <a href="#" class="list-group-item list-group-item-action tenant-item" data-tenant-id="{{ $tenant->id }}">
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" 
                           style="width: 40px; height: 40px;">
                        {{ strtoupper(substr($tenant->fname, 0, 1)) }}
                      </div>
                      <div>
                        <div class="fw-bold">
                          {{ $tenant->fname }} {{ $tenant->lname }}
                          @if(isset($tenant->role))
                            <small class="text-muted">({{ ucfirst($tenant->role) }})</small>
                          @endif
                        </div>
                        <div class="small text-muted">{{ $tenant->email }}</div>
                      </div>
                    </div>
                  </a>
                @empty
                  <div class="list-group-item text-center text-muted py-4">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <div>No messages yet</div>
                  </div>
                @endforelse
              </div>
            </div>
            <!-- Chat area -->
            <div class="col-md-8 d-flex flex-column">
              <div class="p-3 border-bottom bg-light d-flex align-items-center">
                <strong id="chat-header">Select a tenant to view messages</strong>
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
    // Only add message if sender is not the current user to avoid duplication
    if (data.sender_id != userId &&
        ((data.sender_id == selectedTenantId && data.receiver_id == userId) ||
         (data.sender_id == userId && data.receiver_id == selectedTenantId))) {
      // Add the new message to our messages array
      messages.push(data);
      renderChat(selectedTenantId);
    }
  });

  // Listen for typing events
  channel.bind('user-typing', function(data) {
    if (data.sender_id == selectedTenantId && data.receiver_id == userId) {
      if (data.typing) {
        typingIndicator.style.display = 'block';
      } else {
        typingIndicator.style.display = 'none';
      }
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

  // Handle tenant selection
  tenantList.querySelectorAll('.tenant-item').forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      // Remove active class from all items
      tenantList.querySelectorAll('.tenant-item').forEach(i => i.classList.remove('active'));
      // Add active class to selected item
      this.classList.add('active');
      
      selectedTenantId = this.getAttribute('data-tenant-id');
      const firstMsg = messages.find(m =>
        (m.sender_id == selectedTenantId && m.receiver_id == userId) ||
        (m.sender_id == userId && m.receiver_id == selectedTenantId)
      );
      selectedListingId = firstMsg ? firstMsg.listing_id : '';
      
      const tenant = tenants.find(t => t.id == selectedTenantId);
      chatHeader.textContent = tenant ? `${tenant.fname} ${tenant.lname}` : 'Chat';
      
      document.getElementById('receiver_id').value = selectedTenantId;
      document.getElementById('listing_id').value = selectedListingId;
      form.style.display = 'flex';
      renderChat(selectedTenantId);
    });
  });

  // Message Owner button click handler
  const messageOwnerBtn = document.getElementById('messageOwnerBtn');
  if (messageOwnerBtn) {
    messageOwnerBtn.addEventListener('click', function() {
      const owner = @json($owner);
      const listing = @json($listing);
      if (!owner) return;

      // Remove active class from all items
      tenantList.querySelectorAll('.tenant-item').forEach(i => i.classList.remove('active'));

      // Check if owner is in the contacts list and select them
      const ownerItem = Array.from(tenantList.querySelectorAll('.tenant-item')).find(item => {
        return item.getAttribute('data-tenant-id') == owner.id;
      });

      if (ownerItem) {
        ownerItem.classList.add('active');
        selectedTenantId = owner.id;
        const firstMsg = messages.find(m =>
          (m.sender_id == selectedTenantId && m.receiver_id == userId) ||
          (m.sender_id == userId && m.receiver_id == selectedTenantId)
        );
        selectedListingId = firstMsg ? firstMsg.listing_id : (listing ? listing.id : '');

        chatHeader.textContent = `${owner.fname} ${owner.lname}`;
        document.getElementById('receiver_id').value = selectedTenantId;
        document.getElementById('listing_id').value = selectedListingId;
        form.style.display = 'flex';
        renderChat(selectedTenantId);
      } else {
        alert('Owner is not in your contacts list.');
      }
    });
  }

  // Handle message typing
  messageInput.addEventListener('input', function() {
    if (selectedTenantId) {
      clearTimeout(typingTimeout);
      
      // Send typing indicator
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

      // Clear typing indicator after 3 seconds of no input
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
      }, 3000);
    }
  });

  // Send message handler
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    
    // Disable submit button while sending
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    
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
    })
    .finally(() => {
      submitButton.disabled = false;
      messageInput.focus();
    });
  });

  // Auto-resize textarea
  messageInput.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
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

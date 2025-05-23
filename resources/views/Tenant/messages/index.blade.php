@extends('layouts.app')

@section('content')
<div class="main-content">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <strong>Chat</strong>
            <span id="connection-status" class="badge bg-success">Connected</span>
          </div>
          <div class="row g-0">
            <div class="col-md-3 border-end bg-light p-3">
              @if(isset($owner))
                <label for="recipient-select" class="form-label mb-1">Send message to:</label>
                <select id="recipient-select" class="form-select form-select-sm w-100 mb-3">
                  <option value="{{ $owner->id }}" selected>Owner{{ ' ('.$owner->fname.' '.$owner->lname.')' }}</option>
                  @foreach($owner->caretakers as $caretaker)
                    <option value="{{ $caretaker->id }}">Caretaker{{ ' ('.$caretaker->fname.' '.$caretaker->lname.')' }}</option>
                  @endforeach
                </select>
              @endif
            </div>
            <div class="col-md-9">
              <div class="card-body p-0" style="height: 450px; overflow-y: auto; background: #f8f9fa;" id="chat-box">
                <div id="messages-list" class="p-3 d-flex flex-column gap-2">
                  {{-- Messages will be loaded here by JS --}}
                </div>
                <div id="loading-indicator" class="text-center p-3" style="display: none;">
                  <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-white">
                <!-- Debug Panel (remove in production) -->
                <div id="debug-panel" class="alert alert-info small mb-2" style="display: none;">
                  <strong>Debug Info:</strong>
                  <div>User ID: {{ auth()->id() }}</div>
                  <div>Receiver ID: <span id="debug-receiver"></span></div>
                  <div>Listing ID: <span id="debug-listing"></span></div>
                  <div>Last Error: <span id="debug-error">None</span></div>
                </div>
                <form id="sendMessageForm" method="POST" action="{{ route('messages.send') }}" class="d-flex gap-2 align-items-end">
                  @csrf
                  <input type="hidden" name="listing_id" value="{{ $listing->id ?? request('listing_id') ?? '' }}">
                  <input type="hidden" name="receiver_id" value="{{ $owner->id ?? request('receiver_id') ?? '' }}">
                  <div class="flex-grow-1">
                    <textarea 
                      class="form-control" 
                      id="message" 
                      name="message" 
                      rows="1" 
                      placeholder="Type your message..." 
                      required 
                      style="resize:none; max-height: 120px;"
                      maxlength="1000"
                    ></textarea>
                    <div class="small text-muted mt-1">
                      <span id="char-count">0</span>/1000
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary px-4" id="send-btn">
                    <i class="fas fa-paper-plane"></i> Send
                  </button>
                </form>
                <!-- Debug Toggle Button (remove in production) -->
                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="toggleDebug()">
                  Toggle Debug
                </button>
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
  const chatBox = document.getElementById('chat-box');
  const messagesList = document.getElementById('messages-list');
  const form = document.getElementById('sendMessageForm');
  const messageInput = document.getElementById('message');
  const sendBtn = document.getElementById('send-btn');
  const charCount = document.getElementById('char-count');
  const connectionStatus = document.getElementById('connection-status');
  const loadingIndicator = document.getElementById('loading-indicator');
  const debugPanel = document.getElementById('debug-panel');
  const debugError = document.getElementById('debug-error');
  const recipientSelect = document.getElementById('recipient-select');
  
  let receiverId = form.querySelector('input[name="receiver_id"]').value;
  const listingId = form.querySelector('input[name="listing_id"]').value;
  const userId = {{ auth()->id() }};
  
  // Debug function
  function toggleDebug() {
    debugPanel.style.display = debugPanel.style.display === 'none' ? 'block' : 'none';
    document.getElementById('debug-receiver').textContent = receiverId;
    document.getElementById('debug-listing').textContent = listingId;
  }
  
  function logError(error, context = '') {
    console.error(`${context}:`, error);
    debugError.textContent = `${context}: ${error.message || error}`;
  }

  // Auto-resize textarea and character count
  messageInput.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
    charCount.textContent = this.value.length;
  });

  // Enhanced message rendering with error handling
  function renderMessage(msg) {
    try {
      const isMine = msg.sender_id == userId;
      const messageTime = new Date(msg.created_at);
      const timeString = messageTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
      
      let senderLabel = '';
      if (!isMine) {
        if (msg.sender_role === 'caretaker') {
          senderLabel = '<div class="small fw-bold text-info mb-1">Caretaker</div>';
        } else {
          senderLabel = '<div class="small fw-bold text-primary mb-1">Owner</div>';
        }
      }
      
      const messageContainer = document.createElement('div');
      messageContainer.className = 'd-flex mb-2 message-bubble ' + (isMine ? 'justify-content-end' : 'justify-content-start');
      messageContainer.innerHTML = `
        <div class="position-relative" style="max-width: 70%;">
          ${senderLabel}
          <div class="p-3 rounded-3 ${isMine ? 'bg-primary text-white' : 'bg-white border shadow-sm'}" 
               style="word-break: break-word;">
            <div>${escapeHtml(msg.message)}</div>
            <div class="text-end small ${isMine ? 'text-light' : 'text-muted'} mt-1 opacity-75">
              ${timeString}
            </div>
          </div>
        </div>
      `;
      
      return messageContainer;
    } catch (error) {
      logError(error, 'Message Rendering');
      return document.createElement('div');
    }
  }

  // Escape HTML to prevent XSS
  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Enhanced fetch messages with better error handling
  function fetchMessages() {
    loadingIndicator.style.display = 'block';
    
    const url = `{{ route('messages.fetch') }}?listing_id=${listingId}&user_id=${receiverId}`;
    console.log('Fetching messages from:', url);
    
    fetch(url)
      .then(response => {
        console.log('Fetch response status:', response.status);
        console.log('Fetch response headers:', [...response.headers.entries()]);
        
        if (!response.ok) {
          throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        return response.text().then(text => {
          try {
            return JSON.parse(text);
          } catch (e) {
            console.log('Response text:', text);
            throw new Error('Invalid JSON response');
          }
        });
      })
      .then(messages => {
        console.log('Messages received:', messages);
        messagesList.innerHTML = '';
        
        if (Array.isArray(messages)) {
          messages.forEach(msg => {
            messagesList.appendChild(renderMessage(msg));
          });
        } else {
          throw new Error('Messages is not an array');
        }
        
        scrollToBottom();
        connectionStatus.textContent = 'Connected';
        connectionStatus.className = 'badge bg-success';
      })
      .catch(error => {
        logError(error, 'Fetch Messages');
        connectionStatus.textContent = 'Error';
        connectionStatus.className = 'badge bg-danger';
      })
      .finally(() => {
        loadingIndicator.style.display = 'none';
      });
  }

  // Smooth scroll to bottom
  function scrollToBottom() {
    chatBox.scrollTo({
      top: chatBox.scrollHeight,
      behavior: 'smooth'
    });
  }

  // Enhanced Pusher setup with error handling
  try {
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
      wsHost: '{{ env('PUSHER_HOST') }}',
      wsPort: {{ env('PUSHER_PORT') }},
      forceTLS: false,
      encrypted: false,
      enabledTransports: ['ws', 'wss'],
    });

    // Connection state monitoring
    pusher.connection.bind('connected', function() {
      connectionStatus.textContent = 'Connected';
      connectionStatus.className = 'badge bg-success';
    });

    pusher.connection.bind('disconnected', function() {
      connectionStatus.textContent = 'Disconnected';
      connectionStatus.className = 'badge bg-warning';
    });

    pusher.connection.bind('failed', function() {
      connectionStatus.textContent = 'Failed';
      connectionStatus.className = 'badge bg-danger';
    });

    var channel = pusher.subscribe('chat-channel');
    
    // Handle new messages
    channel.bind('new-message', function(data) {
      console.log('New message received:', data);
      if ((data.sender_id == userId && data.receiver_id == receiverId) || 
          (data.sender_id == receiverId && data.receiver_id == userId)) {
        fetchMessages();
      }
    });
  } catch (error) {
    logError(error, 'Pusher Setup');
  }

  // Enhanced form submission with detailed debugging
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const message = messageInput.value.trim();
    if (!message) {
      alert('Please enter a message');
      return;
    }
    
    console.log('Sending message:', {
      message: message,
      listing_id: listingId,
      receiver_id: receiverId,
      sender_id: userId
    });
    
    // Disable form during submission
    sendBtn.disabled = true;
    messageInput.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    
    // Use URLSearchParams for more reliable form data handling
    const formData = new URLSearchParams();
    formData.append('_token', document.querySelector('input[name="_token"]').value);
    formData.append('message', message);
    formData.append('listing_id', listingId);
    formData.append('receiver_id', receiverId);
    
    // Log form data
    console.log('Form data entries:');
    for (let [key, value] of formData.entries()) {
      console.log(`${key}: ${value}`);
    }
    
    fetch(form.action, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData.toString()
    })
    .then(response => {
      console.log('Send response status:', response.status);
      console.log('Send response headers:', [...response.headers.entries()]);
      
      return response.text().then(text => {
        console.log('Send response text:', text);
        
        if (!response.ok) {
          let errorMessage = `HTTP ${response.status}`;
          try {
            const errorData = JSON.parse(text);
            errorMessage = errorData.message || errorData.error || errorMessage;
            console.log('Error data:', errorData);
          } catch (e) {
            console.log('Could not parse error response as JSON');
          }
          throw new Error(errorMessage);
        }
        
        try {
          return JSON.parse(text);
        } catch (e) {
          console.log('Response is not JSON, treating as success');
          return { success: true };
        }
      });
    })
    .then(data => {
      console.log('Message sent successfully:', data);
      messageInput.value = '';
      messageInput.style.height = 'auto';
      charCount.textContent = '0';
      fetchMessages();
      debugError.textContent = 'None';
    })
    .catch(error => {
      logError(error, 'Send Message');
      
      // Show user-friendly error message
      let userMessage = 'Failed to send message. ';
      if (error.message.includes('422')) {
        userMessage += 'Please check your input and try again.';
      } else if (error.message.includes('419')) {
        userMessage += 'Your session has expired. Please refresh the page.';
      } else if (error.message.includes('403')) {
        userMessage += 'You do not have permission to send this message.';
      } else if (error.message.includes('500')) {
        userMessage += 'Server error. Please try again later.';
      } else {
        userMessage += 'Please try again.';
      }
      
      alert(userMessage);
    })
    .finally(() => {
      sendBtn.disabled = false;
      messageInput.disabled = false;
      sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send';
      messageInput.focus();
    });
  });

  // Enter to send (Shift+Enter for new line)
  messageInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      form.dispatchEvent(new Event('submit'));
    }
  });
  
  if (recipientSelect) {
    recipientSelect.addEventListener('change', function() {
      receiverId = this.value;
      form.querySelector('input[name="receiver_id"]').value = this.value;
      fetchMessages();
    });
  }

  // Initialize
  console.log('Initializing chat with:', {
    userId: userId,
    receiverId: receiverId,
    listingId: listingId,
    sendUrl: form.action,
    fetchUrl: `{{ route('messages.fetch') }}`
  });
  
  fetchMessages();
  messageInput.focus();
</script>

@push('styles')
<style>
  #chat-box::-webkit-scrollbar {
    width: 6px;
  }
  
  #chat-box::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  
  #chat-box::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
  }
  
  #chat-box::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
  }
  
  .message-bubble {
    animation: fadeIn 0.3s ease-in;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>
@endpush
@endsection
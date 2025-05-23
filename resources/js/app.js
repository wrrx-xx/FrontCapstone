import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Pusher from 'pusher-js';

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

const pusher = new Pusher('10942F2C232D87ABC56E7A7C75867FFB74D082DF5EDBA5BA8EE0D012E5777ACE', {
  cluster: 'ap1',
  encrypted: true
});

const channel = pusher.subscribe('chat-channel');
channel.bind('new-message', function(data) {
  // You can update your chat UI here
  console.log('New message:', data);
  // Example: append message to chat box
  // document.getElementById('chat-box').append(...)
});

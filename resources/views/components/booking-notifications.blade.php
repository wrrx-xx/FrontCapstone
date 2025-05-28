@props(['notifications'])

<div class="dropdown-menu dropdown-menu-end" aria-labelledby="bookingNotifications">
    @forelse($notifications as $notification)
        <div class="dropdown-item">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    @if($notification->data['type'] === 'success')
                        <i class="fas fa-check-circle text-success"></i>
                    @elseif($notification->data['type'] === 'error')
                        <i class="fas fa-times-circle text-danger"></i>
                    @else
                        <i class="fas fa-info-circle text-info"></i>
                    @endif
                </div>
                <div class="flex-grow-1 ms-2">
                    <h6 class="mb-0">{{ $notification->data['title'] }}</h6>
                    <small class="text-muted">{{ $notification->data['message'] }}</small>
                    <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        @if(!$loop->last)
            <div class="dropdown-divider"></div>
        @endif
    @empty
        <div class="dropdown-item text-center">
            <p class="mb-0">No new notifications</p>
        </div>
    @endforelse
</div> 
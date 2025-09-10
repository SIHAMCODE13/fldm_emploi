@php
    $notifications = auth()->user()->unreadNotifications ?? [];
    $count = count($notifications);
@endphp

<div class="notification-dropdown">
    <i class="fas fa-bell"></i>
    @if($count > 0)
        <span class="notification-badge">{{ $count }}</span>
    @endif
    <div class="notification-dropdown-content">
        @if($count > 0)
            @foreach($notifications as $notification)
                <div class="notification-item">
                    <p>{{ $notification->data['message'] }}</p>
                    <small>{{ \Carbon\Carbon::parse($notification->data['time'])->diffForHumans() }}</small>
                </div>
            @endforeach
        @else
            <div class="notification-item">
                <p>Aucune notification</p>
            </div>
        @endif
    </div>
</div>
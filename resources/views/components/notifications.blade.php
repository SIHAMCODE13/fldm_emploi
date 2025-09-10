@php
    $notifications = auth()->user()->unreadNotifications ?? [];
    $count = count($notifications);
@endphp

<li class="nav-item dropdown">
    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        @if($count > 0)
            <span class="badge bg-danger notification-badge">{{ $count }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><h6 class="dropdown-header">Notifications</h6></li>
        @if($count > 0)
            @foreach($notifications as $notification)
                <li>
                    <a class="dropdown-item" href="{{ route('admin.declarations') }}" onclick="markAsRead('{{ $notification->id }}')">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                {{ $notification->data['message'] }}
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($notification->data['time'])->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        @else
            <li><span class="dropdown-item text-muted">Aucune notification</span></li>
        @endif
    </ul>
</li>

<script>
function markAsRead(notificationId) {
    fetch('/admin/notification/' + notificationId + '/read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
}
</script>
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-2xl font-bold">Notifications</h2>
            @if(Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="text-blue-600 hover:text-blue-800">
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        <div class="divide-y">
            @forelse($notifications as $notification)
                <div class="p-6 @if(!$notification->read_at) bg-blue-50 @endif">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="font-medium">{{ $notification->data['message'] }}</div>
                            @if(isset($notification->data['action_url']))
                                <a href="{{ $notification->data['action_url'] }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Details
                                </a>
                            @endif
                            <div class="text-sm text-gray-500 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.mark-read', $notification->id) }}" 
                                      method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="text-blue-600 hover:text-blue-800">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('notifications.destroy', $notification->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-600">
                    No notifications to display.
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="p-6 border-t">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

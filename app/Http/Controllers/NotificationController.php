<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10); // Paginate for better performance
        return view('notifications.index', compact('notifications'));
    }
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }
    public function markAllAsRead()
    {
        $user = Auth::user();

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class NotificationController extends Controller
{
    function index()
    {
        $notifications = DB::table('notifications')
            ->get()
            ->groupBy('message_id')
            ->map(function ($noti) {
                return $noti->first();
            });

        return view('admin.notifications.index', [
            'notifications' => $notifications
        ]);
    }
    function create()
    {
        return view('admin.notifications.create', [
            'roles' => Role::all()
        ]);
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'role' => 'required',
            'list_check' => 'sometimes'
        ]);
        if (array_key_exists('list_check', $validated)) {
            if ($validated['role'] == 'user') {
                foreach ($validated['list_check'] as $user_id) {
                    $this->sendNoti(User::find($user_id), $validated['message']);
                }
            } else {
                foreach ($validated['list_check'] as $user_id) {
                    $this->sendNoti(Admin::find($user_id), $validated['message']);
                }
            }
        } else {
            if ($validated['role'] == 'user') {
                $this->sendNoti(User::all(), $validated['message']);
            } else {
                $this->sendNoti(Admin::role($validated['role'])->get(), $validated['message']);
            }
        }

        return back()->with('message', 'Success');
    }

    public function sendNoti($collection, $message)
    {
        return Notification::send($collection, new AdminNotification($message));
    }

    function edit(Request $request, $id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();
        $notification->data = json_decode($notification->data);

        $user_list_id = DB::table('notifications')->where('message_id', $notification->message_id)->get()->pluck('notifiable_id')->toArray();

        $user_list = User::whereIn('id', $user_list_id)->get()->pluck('name')->toArray();

        return view('admin.notifications.edit', [
            'notification' => $notification,
            'user_list' => $user_list
        ]);
    }

    function update(Request $request, $message_id)
    {
        DB::table('notifications')->where('message_id', $message_id)->update([
            'data->message' => $request->message
        ]);
        return back()->with('message', 'Success');
    }

    function destroy($message_id)
    {
        DB::table('notifications')->where('message_id', $message_id)->delete();
        return back()->with('message', 'Deleted');
    }

    function showUserNotifications()
    {
        return view('notifications', [
            'notifications' => Auth::user()->notifications,
        ]);
    }
    function read($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        $notification->markAsRead();

        return view('noti-detail', [
            'notification' => $notification
        ]);
    }
}

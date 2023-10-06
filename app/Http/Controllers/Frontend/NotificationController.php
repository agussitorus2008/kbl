<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function counter()
    {
        $user = User::find(Auth::user()->id);
        $total = $user->unreadNotifications->count();

        return response()->json([
            'total' => $total
        ]);
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        $output = '';
        if ($notifications->count() > 0) {
            foreach ($notifications as $notification) {
                if ($notification->type == 'success') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                            <i class="fas fa-check-circle text-success"></i>
                            <div class="notification-text">
                                <strong>KBL</strong> ' . $notification->message . '
                                <br>
                                <small>' . $notification->created_at->diffForHumans() . '</small>
                            </div>
                        </div>
                    </a>
                    ';
                } elseif ($notification->type == 'error') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <div class="notification-text">
                                <strong>KBL</strong> ' . $notification->message . '
                                <br>
                                <small>' . $notification->created_at->diffForHumans() . '</small>
                            </div>
                        </div>
                    </a>
                    ';
                } elseif ($notification->type == 'info') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                            <i class="fas fa-info-circle text-info"></i>
                            <div class="notification-text">
                                <strong>KBL</strong> ' . $notification->message . '
                                <br>
                                <small>' . $notification->created_at->diffForHumans() . '</small>
                            </div>
                        </div>
                    </a>
                    ';
                }
            }
        } else {
            $output .= '
            <a class="dropdown-item" href="javascript:;">
                <div class="notification-content">
                    <i class="fas fa-info-circle text-info"></i>
                    <div class="notification-text">
                        <strong>KBL</strong> Tidak ada notifikasi
                        <br>
                    </div>
                </div>
            </a>
            ';
        }

        $user->unreadNotifications->markAsRead();

        return response()->json([
            'notifications' => $output,
        ]);
    }
}

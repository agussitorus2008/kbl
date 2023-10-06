<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function counter()
    {
        $total = Auth::user()->unreadNotifications->count();
        return response()->json([
            'total' => $total,
        ]);
    }

    public function index()
    {
        $user = User::find(Auth::id());
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        $output = '';

        if ($notifications->count() > 0) {
            foreach ($notifications as $notification) {
                if ($notification->type == 'success') {
                    $output .= '
                    <a href="javascript:;" class="navi-item">
						<div class="navi-link">
							<div class="navi-icon mr-2">
                                <i class="fas fa-check-circle text-success"></i>
						    </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">' . $notification->message . '</div>
                                <div class="text-muted">' . $notification->created_at->diffForHumans() . '</div>
                            </div>
                        </div>
                    </a>';
                } elseif ($notification->type == 'danger') {
                    $output .= '
                    <a href="javascript:;" class="navi-item">
                        <div class="navi-link">
                            <div class="navi-icon mr-2">
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">' . $notification->message . '</div>
                                <div class="text-muted">' . $notification->created_at->diffForHumans() . '</div>
                            </div>
                        </div>
                    </a>';
                } elseif ($notification->type == 'info') {
                    $output .= '
                    <a href="javascript:;" class="navi-item">
                        <div class="navi-link">
                            <div class="navi-icon mr-2">
                                <i class="fas fa-info-circle text-info"></i>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">' . $notification->message . '</div>
                                <div class="text-muted">' . $notification->created_at->diffForHumans() . '</div>
                            </div>
                        </div>
                    </a>';
                } elseif ($notification->type == 'warning') {
                    $output .= '
                    <a href="javascript:;" class="navi-item">
                        <div class="navi-link">
                            <div class="navi-icon mr-2">
                                <i class="fas fa-exclamation-circle text-warning"></i>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold">' . $notification->message . '</div>
                                <div class="text-muted">' . $notification->created_at->diffForHumans() . '</div>
                            </div>
                        </div>
                    </a>';
                }
            }
        } else {
            $output .= '
            <a href="javascript:;" class="navi-item">
                <div class="navi-link">
                    <div class="navi-text">
                        <div class="font-weight-bold">No new notifications</div>
                    </div>
                </div>';
        }

        $notifications->each(function ($notification) {
            $notification->read = true;
            $notification->save();
        });

        return response()->json([
            'notifications' => $output,
        ]);
    }
}

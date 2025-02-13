<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class PageAdminDashboardController extends Controller
{
    public function __invoke()
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('login');
        }
        $totalCourses = Course::count();
        $totalVideos = Video::count();
        $totalUsers = User::role('client')->count();
        return view('pages.admin-dashboard', compact('totalCourses', 'totalVideos', 'totalUsers'));
    }
}

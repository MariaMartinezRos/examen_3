<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

class PageAdminDashboardController extends Controller
{
    public function __invoke()
    {
        $totalCourses = Course::count();
        $totalVideos = Video::count();
        $totalUsers = User::role('client')->count();
        return view('pages.admin-dashboard', compact('totalCourses', 'totalVideos', 'totalUsers'));
    }
}

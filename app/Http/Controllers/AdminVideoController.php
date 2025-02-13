<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminVideoController extends Controller
{

    public function checkAuth()
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('login');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuth();

        $videos = Video::with('course')->paginate(10);
        return view('pages.admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAuth();

        $courses = Course::all();
        return view('pages.admin.videos.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAuth();

        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'url' => 'required|url'
        ]);

        Video::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'course_id' => $request->course_id,
            'url' => $request->url
        ]);

        return redirect()->route('pages.admin.videos.index')->with('success', 'Vídeo creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        $this->checkAuth();

        $courses = Course::all();
        return view('pages.admin.videos.create', compact('video', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $this->checkAuth();

        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'url' => 'required|url'
        ]);

        $video->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'course_id' => $request->course_id,
            'url' => $request->url
        ]);

        return redirect()->route('pages.admin.videos.index')->with('success', 'Vídeo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $this->checkAuth();

        $video->delete();
        return redirect()->route('pages.admin.videos.index')->with('success', 'Vídeo eliminado.');
    }
}

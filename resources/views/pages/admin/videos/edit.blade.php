@extends('layouts.admin')
@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12">
                <div class="space-y-5 sm:space-y-4 md:max-w-xl lg:max-w-3xl xl:max-w-none">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Videos Section</h2>
                    <p class="text-xl text-gray-500">On the Videos Section you can customize your videos.</p>
                </div>

                <h1 class="text-2xl font-bold mb-4">Editar Vídeo</h1>

                <form action="{{ route('admin.videos.update', $video) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block">Título</label>
                        <input type="text" name="title" value="{{ $video->title }}" class="w-full p-2 border" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Curso</label>
                        <select name="course_id" class="w-full p-2 border" required>
{{--                            @foreach($courses as $course)--}}
{{--                                <option value="{{ $course->id }}" {{ $video->course_id == $course->id ? 'selected' : '' }}>--}}
{{--                                    {{ $course->title }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">URL del Vídeo</label>
                        <input type="url" name="url" value="{{ $video->url }}" class="w-full p-2 border" required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Actualizar</button>
                </form>

            </div>
        </div>
    </div>
@endsection


@extends('layouts.admin')
@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12">
                <div class="space-y-5 sm:space-y-4 md:max-w-xl lg:max-w-3xl xl:max-w-none">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Videos Section</h2>
                    <p class="text-xl text-gray-500">On the Videos Section you can customize your videos.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-indigo-500 text-white p-4 rounded-lg">
                <ul role="list"
                    class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">

                    <div class="w-64 h-full">
                        <div class="p-4">
                            <h2 class="text-2xl font-bold">Menu</h2>
                            <ul class="mt-4">
                                <li class="py-2">
                                    <a href="#" class="hover:text-yellow-400">Create Course</a>
                                </li>
                                <li class="py-2">
                                    <a href="{{ route('admin.videos.index') }}" class="hover:text-yellow-400">Create Video</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

                <h1 class="text-2xl font-bold mb-4">Videos</h1>
                <a href="{{ route('admin.videos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">New Video</a>

                <table class="mt-4 w-full bg-white shadow rounded-lg">
                    <thead>
                    <tr>
                        <th class="p-2">Tittle</th>
                        <th class="p-2">Course</th>
                        <th class="p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td class="p-2">{{ $video->title }}</td>
                            <td class="p-2">{{ $video->course->title }}</td>
                            <td class="p-2">
                                <a href="{{ route('admin.videos.edit', $video) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $videos->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection


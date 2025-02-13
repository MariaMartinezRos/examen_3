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
                                    <a href="#" class="hover:text-yellow-400">Create Video</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($videos as $video)
                        <div class="bg-indigo-500 text-white p-4 rounded-lg">
                            <h3 class="text-2xl font-bold">{{ $video->title }}</h3>
                            <p class="text-xl">{{ $video->url }}</p>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
@endsection


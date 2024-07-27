<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-4">
                <div class="mb-6">
                    <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md shadow text-sm font-medium text-black">
                        {{ __('Create New Course') }}
                    </a>
                </div>
                <h3 class="text-lg font-semibold mb-4">List of Courses</h3>
                @if($courses->isEmpty())
                    <p>No courses available.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 py-8">
                        @foreach($courses as $course)
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold mb-2">{{ $course->title }}</h4>
                            <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                            <div class="text-sm text-gray-500 mb-4">
                                <p>Created At: {{ $course->created_at->format('Y-m-d') }}</p>
                                <p>Updated At: {{ $course->updated_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('courses.pages', $course->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md shadow text-sm font-medium text-black">
                                    {{ __('Add Pages') }}
                                </a>
                                <a href="{{ route('courses.play', $course->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md shadow text-sm font-medium text-black">
                                    {{ __('Play Course') }}
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md shadow text-sm font-medium text-blackhover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

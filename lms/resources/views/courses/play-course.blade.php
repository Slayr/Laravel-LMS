<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Play Course: ') . $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Display the current page -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold">{{ $currentPage->title }}</h3>
                    @if($currentPage->image)
                        <img src="{{ asset('storage/' . $currentPage->image) }}" alt="{{ $currentPage->title }}" class="w-full h-64 object-cover mt-4">
                    @endif
                    <div class="mt-4">{{ $currentPage->content }}</div>
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-between mt-6">
                    @if($previousPage = $pages->where('id', '<', $currentPage->id)->last())
                        <a href="{{ route('courses.play', ['course' => $course->id, 'page_id' => $previousPage->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md shadow-sm text-sm font-medium text-black hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Previous Page
                        </a>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md shadow-sm text-sm font-medium text-black">
                            Previous Page
                        </span>
                    @endif

                    @if($nextPage = $pages->where('id', '>', $currentPage->id)->first())
                        <a href="{{ route('courses.play', ['course' => $course->id, 'page_id' => $nextPage->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md shadow-sm text-sm font-medium text-black hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Next Page
                        </a>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700">
                            Next Page
                        </span>
                    @endif

                    <a href="{{ route('courses') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md shadow-sm text-sm font-medium text-black hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Exit Course
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    
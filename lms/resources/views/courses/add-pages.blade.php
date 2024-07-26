<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Pages to Course: ') . $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Form to add a new page -->
                <form action="{{ route('courses.storePage', $course->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Page Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Page Content</label>
                        <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md shadow-sm text-sm font-medium text-black hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Add New Page') }}
                        </button>
                    </div>
                </form>

                <!-- List of pages -->
                <h3 class="text-lg font-semibold mb-4">Pages List</h3>
                @if($pages->isEmpty())
                    <p>No pages available.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                        @foreach($pages as $page)
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold mb-2">{{ $page->title }}</h4>
                            @if($page->image)
                                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full h-32 object-cover mb-4">
                            @endif
                            <p class="text-gray-700 mb-4">{{ $page->content }}</p>
                            <form action="{{ route('courses.destroyPage', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

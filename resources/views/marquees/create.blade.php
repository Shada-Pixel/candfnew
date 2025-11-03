<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Create New Marquee
        </h2>
    </x-slot>

     {{-- Page Content --}}
    <div class="flex flex-col gap-4">
        <div class="card mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6">
                <form action="{{ route('marquees.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block ">Content</label>
                        <textarea id="content" name="content" rows="3" class="form-textarea" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="order" class="block ">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="form-input">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                        @error('active')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 text-white rounded-md shadow-md hover:shadow-lg transition-all duration-200 ml-2">
                            Create Marquee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

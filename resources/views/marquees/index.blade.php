<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Marquee Management
            </h2>
            <a href="{{ route('marquees.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Add New Marquee
            </a>
        </div>
    </x-slot>

     {{-- Page Content --}}
    <div class="flex flex-col gap-4">
        <div class="card mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6">
                <h2 class="text-xl mb-4">Create Marquee</h2>
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
                            Create
                        </button>
                    </div>
                </form>
                <h2 class="text-xl mb-4">All Marquee</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Content</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Order</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($marquees as $marquee)
                            <tr>
                                <td class="px-6 py-4 whitespace-normal">{{ $marquee->content }}</td>
                                <td class="px-6 py-4">{{ $marquee->order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-sm {{ $marquee->active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                                        {{ $marquee->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('marquees.edit', $marquee) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('marquees.destroy', $marquee) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this marquee?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

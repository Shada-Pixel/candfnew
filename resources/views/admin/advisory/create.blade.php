<x-app-layout>
    <x-slot name="title">Add Committee Member</x-slot>

    <div class="card p-6">
        <div class="card-header">
            <h4 class="card-title">Add New Member</h4>
        </div>
        <div class="p-6">
            <form action="{{ route('advisory.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block mb-2">Name</label>
                        <input type="text" class="form-input" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="designation" class="block mb-2">Designation</label>
                        <input type="text" class="form-input" id="designation" name="designation" value="{{ old('designation') }}">
                        @error('designation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block mb-2">Display Order</label>
                        <input type="number" class="form-input" id="order" name="order" value="{{ old('order', 0) }}">
                        @error('order')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block mb-2">Photo</label>
                        <input type="file" class="form-input" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="type" class="block mb-2">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="EC Committee">EC Committee</option>
                            <option value="Ex-President">Ex-President</option>
                            <option value="Ex-General Secretary">Ex-General Secretary</option>
                            <option value="Election Committee">Election Committee</option>
                            <option value="Internal Audit Committee">Internal Audit Committee</option>
                        </select>
                        @error('type')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="active" value="1" checked>
                            <span class="ml-2">Active</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('advisory.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 text-white rounded-md shadow-md hover:shadow-lg transition-all duration-200 ml-2">Save Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

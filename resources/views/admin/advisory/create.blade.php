<x-app-layout>
    <x-slot name="title">Add Advisory Committee Member</x-slot>

    <div class="card">
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
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="active" value="1" checked>
                            <span class="ml-2">Active</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('advisory.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn bg-primary text-white">Save Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

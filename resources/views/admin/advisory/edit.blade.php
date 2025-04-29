<x-app-layout>
    <x-slot name="title">Edit Advisory Committee Member</x-slot>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Member</h4>
        </div>
        <div class="p-6">
            <form action="{{ route('advisory.update', $advisory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block mb-2">Name</label>
                        <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $advisory->name) }}" required>
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="designation" class="block mb-2">Designation</label>
                        <input type="text" class="form-input" id="designation" name="designation" value="{{ old('designation', $advisory->designation) }}">
                        @error('designation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block mb-2">Display Order</label>
                        <input type="number" class="form-input" id="order" name="order" value="{{ old('order', $advisory->order) }}">
                        @error('order')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block mb-2">Photo</label>
                        @if($advisory->photo)
                            <div class="mb-2">
                                <img src="{{ asset($advisory->photo) }}" alt="{{ $advisory->name }}" class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif
                        <input type="file" class="form-input" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="type" class="block mb-2">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="EC Committee" @if ($advisory->type == 'EC Committee') selected @endif>EC Committee</option>
                            <option value="Ex-President" @if ($advisory->type == 'Ex-President') selected @endif>Ex-President</option>
                            <option value="Ex-General Secretary" @if ($advisory->type == 'Ex-General Secretary') selected @endif>Ex-General Secretary</option>
                            <option value="Election Committee" @if ($advisory->type == 'Election Committee') selected @endif>Election Committee</option>
                            <option value="Internal Audit Committee" @if ($advisory->type == 'Internal Audit Committee') selected @endif>Internal Audit Committee</option>
                        </select>
                        @error('type')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" name="active" value="1" {{ $advisory->active ? 'checked' : '' }}>
                            <span class="ml-2">Active</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('advisory.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn bg-primary text-white">Update Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

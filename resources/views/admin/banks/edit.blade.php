<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Edit {{$bank->name}}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex justify-center items-center">
        <div class="card max-w-2xl">
            <div class="p-6">
                <h2 class="mb-4 text-xl">Edit Bank</h2>

                <form class="" id="bankCreateForm" action="{{ route('banks.update', $bank->id) }}" method="post">
                    @csrf
                        @method('PATCH')

                    <div class="flex items-end gap-5">

                        <div>
                            <label for="name" class="block mb-2">Bank Name</label>
                            <input type="text" class="form-input" id="name" name="name" required value="{{$bank->name}}">
                        </div> <!-- end -->

                        <div class="lg:col-span-2 ">
                            <button type="submit" class="font-mont mt-2 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300"
                                id="bankSaveBtn">Update</button>
                        </div>
                    </div>
                </form>
                <div class="flex justify-between mt-6">
                    <a href="{{route('baccounts.index')}}">
                        <button type="submit" class="font-mont mt-2 px-6 py-4 bg-black hover:bg-seagreen text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150" id="">New Account</button>
                    </a>
                    <a href="{{route('transactions.index')}}">
                        <button type="submit" class="font-mont mt-2 px-6 py-4 bg-black hover:bg-seagreen text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150" id="">New Transaction</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
    </x-slot>
</x-app-layout>

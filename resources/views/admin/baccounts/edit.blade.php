<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Edit Bank Account</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex justify-center items-center">
        <div class="card max-w-2xl">
            <div class="p-6">
                <h2 class="mb-4 text-xl">Edit Account</h2>

                <form class="" id="baccountCreateForm" action="{{route('baccounts.update',$bankAccount->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="">
                        <div>
                            <label for="bank" class="block mb-2">Bank</label>
                            <select class="form-select" id="bank_id" name="bank_id" required>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}" @if ($bank->id == $bankAccount->bank_id) selected @endif>{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div> <!-- end -->

                        <div class="mt-4">
                            <label for="account_number" class="block mb-2">Account Number</label>
                            <input type="text" class="form-input" id="account_number" name="account_number" value="{{$bankAccount->account_number}}" required>
                        </div> <!-- end -->


                        <div class="mt-4">
                            <label for="account_holder_name" class="block mb-2">Account Holder Name</label>
                            <input type="text" class="form-input" id="account_holder_name" name="account_holder_name" value="{{$bankAccount->account_holder_name ?? ''}}" placeholder="Name">
                        </div> <!-- end -->



                        <div class="mt-4">
                            <label for="balance" class="block mb-2">Balance</label>
                            <input type="number" class="form-input" id="balance" name="balance" step="0.01" value="{{$bankAccount->balance?? 0.00}}">
                        </div> <!-- end -->

                        <div class=" mt-4">
                            <button type="submit" class="font-mont mt-2 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300"
                                id="baccountSaveBtn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                $("form #name").on('blur', () => {
                    const slug = slugify($("form #name").val());
                    $("form #slug").val(slug);
                });
            });
        </script>
    </x-slot>
</x-app-layout>




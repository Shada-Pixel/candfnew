<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Donation</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Form --}}
        <div class="card max-w-2xl">
            <div class="p-6">
                <h2 class="mb-4 text-xl">New Donation</h2>

                <form action="{{ route('donations.store') }}" class="" id="ieCreateForm" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="agent_id" class="block mb-2">Select Agent</label>
                            <select class="form-select" name="agent_id" id="agent_id" required>
                                <option value="">Select One</option>
                                @forelse ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>            
                                    
                                @empty
                                    <option value="">No Agent Found</option>
                                @endforelse
                            </select>
                        </div> <!-- end -->
                        <div>
                            <label for="type" class="block mb-2">Select Type</label>
                            <select class="form-select" name="type" id="type" required>
                                <option value="Treatment">Treatment</option>
                                <option value="Education">Education</option>
                                <option value="Marrige">Marrige</option>
                                <option value="Other">Other</option>
                            </select>
                        </div> <!-- end -->

                        <div class="col-span-2">
                            <label for="purpose" class="block mb-2">Purpose</label>
                            <input type="text" class="form-input" id="purpose" name="purpose">
                        </div> <!-- end -->


                        <div class="">
                            <label for="amount" class="block mb-2">Amount</label>
                            <input type="text" class="onlynumber form-input" id="amount" name="amount" required>
                        </div> <!-- end -->

                        <div class="">
                            <label for="date" class="block mb-2">Date</label>
                            <input type="date" class="form-input" id="date" name="date">
                            <input type="hidden" class="form-input" id="" name="status" value="Pending">
                        </div> <!-- end -->
                        

                        <div class=" ">
                            <button type="submit"
                                class="font-mont mt-2 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300"
                                id="baccountSaveBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="script">
    </x-slot>
</x-app-layout>

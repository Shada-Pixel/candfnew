<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Certificate</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-4">
        <div class="card max-w-3xl mx-auto">
            <div class="p-6">
                <h2 class="text-xl mb-4">Input Informations to Print Certificate</h2>
                {{-- Certificate printing form --}}
                <form action="{{ route('agents.certificate.print') }}" method="POST" class="">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="name" class="block">Name</label>
                            <input id="name" class="form-input" type="text" name="name" required autofocus />
                        </div>

                        <div>
                            <label for="license_number" class="block">License Number</label>
                            <input id="license_number" class="form-input" type="text" name="license_number" required />
                        </div>

                        <div>
                            <label for="issue_date" class="block">Issue Date</label>
                            <input id="issue_date" class="form-input" type="text" name="issue_date" required />
                        </div>

                        <div>
                            <label for="expire_date" class="block">Expire Date</label>
                            <input id="expire_date" class="form-input" type="text" name="expire_date" required />
                        </div>
                        <div>
                            <label for="print_date" class="block">Print Date</label>
                            <input id="print_date" class="form-input" type="text" name="print_date" required  value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"/>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 col-span-2">
                        <button type="submit" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            {{ __('Print Certificate') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- flex-end -->
</x-app-layout>

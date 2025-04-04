<x-guest-layout>
    {{-- Title --}}
    <x-slot name="title">{{$agent->name}}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    <section>

        {{-- Page Content --}}
        <div class="bg-gradient-to-r from-violet-400 to-purple-300 py-8">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl font-bold text-center text-gray-800">{{$agent->name}}</h1>
            </div>
        </div>
    
        <div class="max-w-7xl mx-auto flex flex-col gap-6">
    
            <div class="card p-6">
                <div class="flex justify-between items-center gap-6 mb-6">

                    <div class="flex justify-between items-center gap-2 flex-grow">
    
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-violet-400 to-purple-300 h-2.5 rounded-full" style="width: {{$completionPercentage.'%'}}"></div>
                        </div>
                        <p class="text-violet-700">{{$completionPercentage.'%'}}</p>
                    </div>

                    <a href="{{route('agents.edit',$agent->id)}}">
                        <button class="font-mont px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Edit</button>
                    </a>
                </div>
    
    
                <div class="">
                    {{-- General Information --}}
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">General Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-account-card-details-outline"></i></span>
                                <p class="text-gray-700"><strong>Ain No:</strong> {{ $agent->ain_no ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-account-outline"></i></span>
                                <p class="text-gray-700"><strong>Owner / Manager:</strong> {{ $agent->owners_name ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-briefcase-outline"></i></span>
                                <p class="text-gray-700"><strong>Designation:</strong> {{ $agent->destination ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-office-building-outline"></i></span>
                                <p class="text-gray-700"><strong>Office Address:</strong> {!! $agent->office_address ?? 'N/A' !!}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-phone-outline"></i></span>
                                <p class="text-gray-700"><strong>Phone:</strong> {{ $agent->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-email-outline"></i></span>
                                <p class="text-gray-700"><strong>Email:</strong> {{ $agent->email ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-home-outline"></i></span>
                                <p class="text-gray-700"><strong>House:</strong> {{ $agent->house ?? 'N/A' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500"><i class="mdi mdi-note-outline"></i></span>
                                <p class="text-gray-700"><strong>Note:</strong> {{ $agent->note ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
    
                    


                    <div class="text-center">
                        <h3 class="text-2xl font-medium">Donation</h3>
                        <p>
                            Treatment: {{ $agent->donations->where('status', 'Approved')->where('type', 'Treatment')->count() }},
                            Education: {{ $agent->donations->where('status', 'Approved')->where('type', 'Education')->count() }},
                            Marriage: {{ $agent->donations->where('status', 'Approved')->where('type', 'Marrige')->count() }},
                            Other: {{ $agent->donations->where('status', 'Approved')->where('type', 'Other')->count() }}
                        </p>
                    </div>
                    <table id="donationTable" class="display stripe text-xs sm:text-base" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Agent</th>
                                <th>Date</th>
                                <th>Perpose</th>
                                <th>Amount</th>
                                <th>Status</th>
                                @role('admin')
                                <th class="text-right">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agent->donations as $donation)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$donation->agent->name}}</td>
                                <td>{{ $donation->formatted_date }}</td>
                                <td>{{$donation->purpose}}</td>
                                <td>{{$donation->amount}} Taka</td>
                                <td>{{$donation->status}}</td>
                                @role('admin')
                                <td>
                                    <div class="flex flex-col sm:flex-row gap-5 justify-end items-center">
                                        <a href="{{route('donations.edit',$donation->id)}}" class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" >
                                            <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                        </a>
    
                                        <form action="{{ route('donations.destroy',$donation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="text-red-500/70 hover:text-red  hover:scale-105 transition duration-150 ease-in-out text-xl">
                                                <span class="menu-icon"><i class="mdi mdi-delete"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right font-bold">Total Approved Amount:</td>
                                <td colspan="2" class="font-bold">
                                    {{ $agent->donations->where('status', 'Approved')->sum('amount') }} Taka
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
    
                </div>
    
    
    
            </div> <!-- end card -->
    
    
    
        </div>
    </section>




    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            var datatablelist = $('#donationTable').DataTable();
        </script>
    </x-slot>
</x-guest-layout>




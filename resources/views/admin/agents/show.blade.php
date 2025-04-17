<x-guest-layout>
    {{-- Title --}}
    <x-slot name="title">{{$agent->name}}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <style>
            .tablinks.active {
                color: #6d28d9;
                border-bottom: 2px solid #6d28d9;
            }
            .tabcontent {
                animation: fadeEffect 1s;
            }
            @keyframes fadeEffect {
                from {opacity: 0;}
                to {opacity: 1;}
            }
        </style>
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
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6" aria-labelledby="general-info-heading">
                        <h3 id="general-info-heading" class="text-xl font-semibold text-gray-800 mb-4">General Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-numeric"></i></span>
                                <p class="text-gray-700"><strong>AIN No:</strong> <span>{{ $agent->ain_no ?? 'N/A' }}</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-account-outline"></i></span>
                                <p class="text-gray-700"><strong>Owner / Manager:</strong> <span>{{ $agent->owners_name ?? 'N/A' }}</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-briefcase-outline"></i></span>
                                <p class="text-gray-700"><strong>Designation:</strong> <span>{{ $agent->owners_designation ?? 'N/A' }}</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-office-building-outline"></i></span>
                                <p class="text-gray-700"><strong>Office Address:</strong> <span>{!! $agent->office_address ?? 'N/A' !!}</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-phone-outline"></i></span>
                                <p class="text-gray-700"><strong>Phone:</strong> <a href="tel:{{ $agent->phone }}" class="hover:text-violet-600 transition-colors">{{ $agent->phone ?? 'N/A' }}</a></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-email-outline"></i></span>
                                <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:{{ $agent->email }}" class="hover:text-violet-600 transition-colors">{{ $agent->email ?? 'N/A' }}</a></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-home-outline"></i></span>
                                <p class="text-gray-700"><strong>House:</strong> <span>{{ $agent->house ?? 'N/A' }}</span></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500" aria-hidden="true"><i class="mdi mdi-note-outline"></i></span>
                                <p class="text-gray-700"><strong>Note:</strong> <span>{{ $agent->note ?? 'N/A' }}</span></p>
                            </div>
                        </div>
                    </div>
                    {{-- General Information End --}}

                    {{-- Three tab Custom Files, Donation, Fees --}}
                    <div class="mb-6">
                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 tablinks active" id="custom-files-tab" data-tab="custom-files">
                                        Custom Files
                                        @if($unpaidCount > 0)
                                            <span class="ml-1 px-2 py-1 text-xs text-red-600 bg-red-100 rounded-full">{{ $unpaidCount }} unpaid</span>
                                        @endif
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 tablinks" id="donation-tab" data-tab="donation">Donation</button>
                                </li>
                                <li role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 tablinks" id="fees-tab" data-tab="fees">Fees</button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab content -->
                        <div class="tab-content mt-6">
                            <!-- Custom Files Tab -->
                            <div id="custom-files" class="tabcontent active">
                                @if($unpaidCount > 0)
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    There are <strong>{{ $unpaidCount }}</strong> unpaid custom files with a total pending amount of <strong>৳{{ number_format($unpaidTotal, 2) }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Agent Name In Customs File</th>
                                            <th>B/E No</th>
                                            <th>Fees</th>
                                            <th>Agent Name in Chada</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($agent->custom_files as $file)
                                        <tr class="{{ $file->status == 'Unpaid' ? 'bg-red-50' : '' }}">
                                            <th>{{ $loop->index+1 }}</th>
                                            <td>{{$file->name}}</td>
                                            <td>{{$file->be_number}}</td>
                                            <td>৳{{number_format($file->fees, 2)}}</td>
                                            <td>{{$file->agent ? $file->agent->name : 'Unknown'}}</td>
                                            <td>{{$file->type}}</td>
                                            <td>
                                                @if ($file->status == 'Unpaid')
                                                    <span class="text-red-400">Unpaid</span>
                                                @else
                                                    <span class="text-green-600">Paid</span>
                                                @endif
                                            </td>

                                            <td class="flex justify-end items-center gap-2">
                                                @role('admin')
                                                <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-2xl" href="{{route('customfiles.edit', $file->id)}}">
                                                    <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                                </a>
                                                <a class="text-red-500/70 hover:text-red  hover:scale-105 transition duration-150 ease-in-out text-2xl" href="{{ route('customfiles.destroy', $file->id) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $file->id }}').submit();">
                                                <span class="menu-icon"><i class="mdi mdi-delete"></i></span>
                                                </a>

                                                <form id="delete-form-{{ $file->id }}" action="{{ route('customfiles.destroy', $file->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                @endrole

                                                @role('agent')
                                                <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-2xl" href="{{route('customfiles.edit', $file->id)}}">
                                                    <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                                </a>
                                                @endrole
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Donation Tab -->
                            <div id="donation" class="tabcontent hidden">
                                <div class="text-center mb-4">
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
                                            <th>Purpose</th>
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

                            <!-- Fees Tab -->
                            <div id="fees" class="tabcontent hidden">
                                <h3 class="text-2xl font-medium mb-4">Fees</h3>
                                <!-- Add your fees content here -->
                            </div>
                        </div>
                    </div>
                    {{-- Three tab Custom Files, Donation, Fees End --}}

                </div>
            </div> <!-- end card -->

        </div>
    </section>

    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            var datatablelist = $('#donationTable').DataTable();
            var customsfiles = $('#customsfiles').DataTable();

            // Tab functionality
            $(document).ready(function() {
                $('.tablinks').click(function() {
                    // Remove active class from all tabs and content
                    $('.tablinks').removeClass('active');
                    $('.tabcontent').addClass('hidden').removeClass('active');

                    // Add active class to clicked tab
                    $(this).addClass('active');

                    // Show corresponding content
                    const tabId = $(this).data('tab');
                    $(`#${tabId}`).removeClass('hidden').addClass('active');
                });
            });
        </script>
    </x-slot>
</x-guest-layout>




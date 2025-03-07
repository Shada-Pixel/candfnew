<x-guest-layout>

    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{asset('css/datatable.css')}}">
    </x-slot>

    <main>
        {{-- <x-marquee></x-marguee> --}}
        {{-- General Member --}}
        <section class=" ">
            <div class="bg-gradient-to-r from-violet-400 to-purple-300 py-8">
                <div class="container mx-auto px-4">
                    <h1 class="text-3xl font-bold text-center text-gray-800">General Members</h1>
                </div>
            </div>
            <div class="max-w-7xl mx-auto py-10">
                {{-- General member datatable --}}
                <div class="container mx-auto px-4 py-8">
                    <table class="min-w-full divide-y divide-gray-200" id="agenttable">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name(Bangali)</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($agents as $member)
                                <tr class="hover:bg-gray-50 transition-colors duration-200 @if($loop->even) bg-gray-50 @endif">
                                    <td class="whitespace-nowrap text-sm text-gray-900 px-4">
                                        @if ($member->agency_logo)
                                            <img src="{{ asset('storage/'.$member->agency_logo) }}" class="h-10 w-10 rounded-full" alt="logo">
                                        @elseif ($member->owner_photo)
                                            <img src="{{ asset('storage/'.$member->owner_photo) }}" class="h-10 w-10 rounded-full" alt="logo">
                                        @else
                                            <img src="{{ asset('images/placeholder.png') }}" class="h-10 w-10 rounded-full" alt="logo">
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap text-sm text-gray-900">{{ $member->name }}</td>
                                    <td class="whitespace-nowrap text-sm text-gray-900">{{ $member->bangla_name }}</td>
                                    <td class="text-sm text-gray-900 capitalize">
                                        <p>
                                            Owner: {{ $member->owners_name }} <br/>
                                            Owner's Designation: {{ $member->owners_designation }} <br/>
                                            Address: {{ $member->office_address }} <br/>
                                            Mobile: {{ $member->phone }} <br/>
                                            Email: {{ $member->email }}   
                                        </p>
                                        @if ($member->other_owner)
                                            <p>
                                                <span class="font-bold">Other Owner:</span> {{ $member->other_owner }}
                                            </p>
                                            <p>
                                                <span class="font-bold">Mobile:</span> {{ $member->owners_mobile }}
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            var datatablelist = $('#agenttable').DataTable({
                "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                "pageLength": 5,
                "responsive": true
            });

            document.addEventListener('DOMContentLoaded', function () {
                const items = document.querySelectorAll('.accordion-title');
                items.forEach(item => {
                    item.addEventListener('click', function () {
                        const content = this.nextElementSibling;
                        content.classList.toggle('hidden');
                    });
                });
            });
        </script>
    </x-slot>

</x-guest-layout>
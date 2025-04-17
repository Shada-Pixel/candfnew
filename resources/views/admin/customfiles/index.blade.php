<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Customs File</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-4">

        {{-- Import Form --}}
        <div class="card w-full">
            <div class="p-6">
                <form action="{{ route('customfiles.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
                    @csrf
                    <input type="file" name="excel_file" accept=".xlsx,.xls" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold text-sm rounded-md hover:bg-green-700 transition duration-150 ease-in-out">
                        Import
                    </button>
                </form>
                @if(session('success'))
                    <div class="mt-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mt-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Table --}}
        <div class="card w-full">
            <div class="p-6">
                {{-- Table start here --}}
                <table id="customsfiles" class="table is-narrow">
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
                    @foreach ($customFiles as $file)
                        <tr>
                            <th>{{ $loop->index+1 }}</th>
                            <td>{{$file->name}}</td>
                            <td>{{$file->be_number}}</td>
                            <td>{{$file->fees}}</td>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div> <!-- flex-end -->

    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $('#customsfiles').DataTable({
                "pageLength": 100
            });

        </script>
    </x-slot>
</x-app-layout>

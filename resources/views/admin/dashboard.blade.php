<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Dashboard</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">


        <div class="grid xl:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6">
            <!-- card-start -->
            <div class="card bg-cyan-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h4 class="card-title">Total File</h4>
                        <div class="text-end">
                            <h2 class="text-3xl font-normal">{{$todayFileDataCount}}</h2>
                            <p class="text-gray-400 font-normal">Today</p>
                        </div>
                    </div>
                </div>
            </div> <!-- card-end -->
            <!-- card-start -->
            <div class="card bg-sky-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h4 class="card-title">Total Delivered</h4>
                        <div class="text-end">
                            <h2 class="text-3xl font-normal">{{$deliveredFileDataCount}}</h2>
                            <p class="text-gray-400 font-normal">All Time</p>
                        </div>
                    </div>
                </div>
            </div> <!-- card-end -->
            <!-- card-start -->
            <div class="card bg-blue-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h4 class="card-title">Total Printed</h4>
                        <div class="text-end">
                            <h2 class="text-3xl font-normal">{{$printedFileDataCount}}</h2>
                            <p class="text-gray-400 font-normal">All time</p>
                        </div>
                    </div>
                </div>
            </div> <!-- card-end -->
            <!-- card-start -->
            <div class="card bg-indigo-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h4 class="card-title">Total Files</h4>
                        <div class="text-end">
                            <h2 class="text-3xl font-normal">{{$currentYearFileDataCount}}</h2>
                            <p class="text-gray-400 font-normal">This Year</p>
                        </div>
                    </div>
                </div>
            </div> <!-- card-end -->

        </div> <!-- grid-end -->


        {{-- Table --}}
        <div class="card w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl">Last 1000 Files</h2>
                    <div class="p-2 shadow-md rounded-lg bg-slate-200">
                        <form action="{{route('dashboard')}}" method="get">
                            @csrf
                            @method('GET')
                            <div class="flex justify-center items-center gap-4">

                                <select name="stype" id="">
                                    <option value="be_number" selected>B/E Number</option>
                                    <option value="manifest_no">Manifast Number</option>
                                    <option value="lodgement_no">Lodgement Number</option>
                                </select>
                                <input type="text" name="search" id="search" class="form-input" placeholder="Search">
                                <button type="submit" class="font-mont cursor-pointer px-4 py-3 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Search</button>
                                <a href="{{route('dashboard')}}" class="font-mont cursor-pointer px-4 py-3 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 ">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="">

                        <a href="{{route('file_datas.create')}}">
                            <button type="submit" class="font-mont px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Receive File</button>
                        </a>
                        <a href="{{route('ie_datas.index')}}">
                            <button type="submit" class="font-mont px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Emp/Exp</button>
                        </a>
                        <a href="{{route('agents.index')}}">
                            <button type="submit" class="font-mont px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Agents</button>
                        </a>
                    </div>
                </div>
                {{-- Table start here --}}
                <table id="suppliers" class="table is-narrow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Manifest No</th>
                            <th>Manifest Date</th>
                            <th>Lodgement No</th>

                            @role('admin|operator')

                            <th>Lodgement Date</th>
                            @endrole

                            @role('deliver')
                            <th>B/E No</th>
                            <th>B/E Date</th>
                            @endrole
                            <th>Agent Name</th>

                            @role('admin|operator|deliver')
                            <th>Importer / Exporter</th>
                            @endrole
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($file_datas as $file_data)
                        <tr>
                            <th>{{ $loop->index+1 }}</th>
                            <td>{{$file_data->manifest_no}}</td>
                            <td>{{$file_data->manifest_date}}</td>
                            <td>{{$file_data->lodgement_no}}</td>


                            @role('admin|operator')
                            <td>{{$file_data->lodgement_date}}</td>
                            @endrole

                            @role('deliver')
                            <td>{{$file_data->be_number}}</td>
                            <td>{{$file_data->be_date}}</td>
                            @endrole
                            <td>
                                @if ($file_data->agent)
                                <a href="{{route('agents.show', $file_data->agent->id) }}" class="hover:text-green-600 cursor-pointer">
                                    {{$file_data->agent->name}}
                                </a>
                                @endif
                            </td>

                            @role('admin|operator|deliver')
                            <td>
                                @if ($file_data->ie_data)
                                <a href="{{route('ie_datas.show', $file_data->ie_data->id) }}" class="hover:text-green-600 cursor-pointer">
                                    {{$file_data->ie_data->name ?? ''}}
                                </a>
                                @endif
                            </td>
                            @endrole

                            <td>{{$file_data->status}}</td>

                            <td class="has-text-right">
                                @role('admin')
                                    <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" href="{{route('file_datas.edit', $file_data->id)}}">
                                        <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                    </a>
                                    <a class="text-red-500/70 hover:text-red  hover:scale-105 transition duration-150 ease-in-out text-xl" href="{{ route('file_datas.destroy', $file_data->id) }}"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $file_data->id }}').submit();">
                                    <span class="menu-icon"><i class="mdi mdi-delete"></i></span>
                                    </a>

                                    <form id="delete-form-{{ $file_data->id }}" action="{{ route('file_datas.destroy', $file_data->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endrole

                                @role('operator')
                                    @if($file_data->status == 'Operated' || $file_data->status == 'Received')

                                        <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" href="{{route('file_datas.edit', $file_data->id)}}">
                                                @if($file_data->status == 'Operated')
                                                <span class="menu-icon"><i class="mdi mdi-table-edit"></i></span>
                                                @else
                                                <span class="menu-icon"><i class="mdi mdi-key"></i></span>
                                                @endif
                                        </a>

                                    @endif
                                @endrole

                                @role('deliver')
                                    @if ($file_data->status != 'Received')
                                        @if($file_data->status == 'Operated')
                                            <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" href="{{route('file_datas.edit', $file_data->id)}}">
                                                <span class="menu-icon"><i class="mdi mdi-truck-delivery"></i></span>
                                            </a>
                                        @elseif($file_data->status == 'Printed')
                                            <a class="text-seagreen/70 hover:text-seagreen  hover:scale-105 transition duration-150 ease-in-out text-xl" href="{{route('file_datas.show', $file_data->id)}}"><span class="menu-icon"><i class="mdi mdi-printer"></i></span></a>
                                        @endif
                                    @endif
                                @endrole
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
            $('#suppliers').DataTable({
                "pageLength": 100
            });

        </script>
    </x-slot>
</x-app-layout>

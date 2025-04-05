<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">File Receive Report</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">
        <div class="card w-full">

            {{-- Filter form --}}
            <div class="mb-4">
                <div class="p-4 shadow-md rounded-t-lg">
                    <form action="{{ route('reports.receiver_report') }}" method="get">
                        @csrf
                        @method('GET')
                        <div class="flex justify-between items-center gap-4">
                            <h2 class="text-xl">File Receive Report</h2>
                            <div class="flex justify-between items-center gap-4 flex-grow max-w-3xl">

                                <lable class="text-nowrap">Lodgement Date</lable>
                                <div id="reportrange" class="bg-white cursor-pointer px-5 py-1 border border-gray-300 rounded-sm w-full">
                                    <i class="mdi  mdi-calendar-clock text-green-400"></i>&nbsp;
                                    <span></span> <i class="mdi mdi-arrow-down"></i>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" name="filter" id="filter" class="font-mont cursor-pointer px-4 py-3 bg-green-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Search</button>
                                <button type="reset" name="refresh" id="refresh" class="font-mont cursor-pointer px-4 py-3 bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class=""></div>
            </div>

            {{-- Report table --}}
            <div class="p-6">
                {{-- Table start here --}}
                <table id="all_report" class="table is-narrow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lodg.No</th>
                            <th>Agent</th>
                            <th>M/F No</th>
                            <th>M/F Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($file_datas as $file_data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $file_data->lodgement_no }}</td>
                                <td>{{ $file_data->agent->name }}</td>
                                <td>{{ $file_data->manifest_no }}</td>
                                <td>{{ $file_data->manifest_date }}</td>
                                <td>{{ $file_data->status }}</td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                            
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Lodg.No</th>
                            <th>Agent</th>
                            <th>M/F No</th>
                            <th>M/F Date</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <!-- flex-end -->

    <x-slot name="script">
        <!-- Datatable script-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/filtering/row-based/range_dates.js"></script>

        <script>

            // date rang picker
            $(function() {
                var start = moment().subtract(29, 'days');
                var end = moment();
                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    var from_date = start.format('YYYY-MM-DD');
                    var to_date = end.format('YYYY-MM-DD');
                    $("#from_date").val(from_date);
                    $("#to_date").val(to_date);
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);
                cb(start, end);
            });

            // Files data table with buttons and page length
            $('#all_report').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                lengthMenu: [10, 25, 50, 100] // Add page length options
            });

        </script>
    </x-slot>
</x-app-layout>

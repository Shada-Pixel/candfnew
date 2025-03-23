<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Delivery Report</x-slot>

    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable CSS --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">
        {{-- Table --}}
        <div class="card w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl">Delivery Report</h2>
                    <div class="p-2 shadow-md rounded-lg bg-slate-200">
                        <form action="" method="get">
                            @csrf
                            @method('GET')
                            <div class="flex justify-center items-center gap-4">
                                <label class="text-nowrap">Lodgement Date</label>
                                <div id="reportrange" class="bg-white cursor-pointer px-5 py-1 border border-gray-300 rounded-sm w-full">
                                    <i class="mdi mdi-calendar-clock text-green-400"></i>&nbsp;
                                    <span></span> <i class="mdi mdi-arrow-down"></i>
                                </div>

                                {{-- Select Agent --}}
                                <select name="agent_id" id="agent_id" class="form-select w-full">
                                    <option value="">Select Agent</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>

                                <button type="button" name="filter" id="filter" class="font-mont cursor-pointer px-4 py-3 bg-green-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Search</button>
                                <button type="button" name="refresh" id="refresh" class="font-mont cursor-pointer px-4 py-3 bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Table Start --}}
                <table id="all_report" class="table is-narrow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Manifest No</th>
                            <th>B/E No</th>
                            <th>Agent</th>
                            <th>Manifest Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <!-- Datatable Scripts -->
        <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $(function() {
                // Date Range Picker Initialization
                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $('#from_date').val(start.format('YYYY-MM-DD'));
                    $('#to_date').val(end.format('YYYY-MM-DD'));
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

                // Initialize DataTable
                function load_data(from_date = '', to_date = '', agent_id = '') {
                    $('#all_report').DataTable({
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        dom: 'lBftip',
                        buttons: [
                            {
                                extend: 'pdf',
                                title: 'Delivery Report',
                                footer: true
                            },
                            {
                                extend: 'csv',
                                title: 'Delivery Report',
                                footer: true
                            },
                            {
                                extend: 'excel',
                                title: 'Delivery Report',
                                footer: true
                            },
                            {
                                extend: 'print',
                                title: 'Delivery Report',
                                footer: true
                            }
                        ],
                        ajax: {
                            url: '{!! route("reports.deliver_report") !!}',
                            data: {
                                from_date: from_date,
                                to_date: to_date,
                                agent_id: agent_id
                            }
                        },
                        columns: [
                            {
                                title: "No",
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            { data: 'manifest_no', name: 'manifest_no' },
                            { data: 'be_number', name: 'be_number' },
                            { data: 'agent.name', name: 'agent.name' },
                            { data: 'manifest_date', name: 'manifest_date' },
                            { data: 'status', name: 'status' }
                        ]
                    });
                }

                load_data();

                // Filter Button Click
                $('#filter').click(function() {
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    var agent_id = $('#agent_id').val();

                    if (from_date != '' && to_date != '') {
                        load_data(from_date, to_date, agent_id);
                    } else {
                        alert('Both Date is required');
                    }
                });

                // Refresh Button Click
                $('#refresh').click(function() {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    $('#agent_id').val('');
                    load_data();
                });
            });
        </script>
    </x-slot>
</x-app-layout>

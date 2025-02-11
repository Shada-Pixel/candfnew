<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Delivery Report</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

                                <lable class="text-nowrap">Lodgement Date</lable>
                                <div id="reportrange" class="bg-white cursor-pointer px-5 py-1 border border-gray-300 rounded-sm w-full">
                                    <i class="mdi  mdi-calendar-clock text-green-400"></i>&nbsp;
                                    <span></span> <i class="mdi mdi-arrow-down"></i>
                                </div>

                                <button type="button" name="filter" id="filter" class="font-mont cursor-pointer px-4 py-3 bg-green-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Search</button>
                                <button type="button" name="refresh" id="refresh" class="font-mont cursor-pointer px-4 py-3 bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class=""></div>
                </div>

                {{-- Table start here --}}
                <table id="all_report" class="table is-narrow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lodgement No</th>
                            <th>Agent</th>
                            <th>Group</th>
                            <th>Manifest No</th>
                            <th>Manifest Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Lodgement No</th>
                            <th>Agent</th>
                            <th>Group</th>
                            <th>Manifest No</th>
                            <th>Manifest Date</th>
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

        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/filtering/row-based/range_dates.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script !src="">
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
                    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
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

            //ajux data with date range

            $(function() {
                var customer_name = '';
                load_data();

                function load_data(from_date = '', to_date = '') {

                    $('#all_report').DataTable({
                        processing: true,
                        serverSide: true,
                        dom: 'lBftip',
                        buttons: [
                            {
                                extend: 'pdf',
                                messageTop: 'File Report',
                                footer: true
                            },
                            'csv',
                            'excel',
                            {
                                extend: 'print',
                                messageTop: '<h2>File Report ' +customer_name+ '</h2>',
                                footer: true
                            }
                        ],
                        ajax: {
                            url:'{!! route("reports.deliver_report") !!}',
                            data:{
                                from_date:from_date,
                                to_date:to_date
                            }
                        },
                        columns: [
                            {
                                title: "No",
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            { data: 'lodgement_no', name: 'lodgement_no' },
                            { data: 'agent.name', name: 'agent.name' },
                            { data: 'manifest_no', name: 'manifest_no' },
                            { data: 'manifest_date', name: 'manifest_date' },
                            { data: 'status', name: 'status' }
                        ],

                        "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();
                            api.columns('.sum', { page: 'current' }).every(function () {
                                var sum = this
                                .data()
                                .reduce(function (a, b) {
                                    var x = parseFloat(a) || 0;
                                    var y = parseFloat(b) || 0;
                                    return x + y;
                                }, 0);
                                console.log(sum);
                                // Update footer
                                $(this.footer()).html('Total = '+sum);
                            });
                        }


                    });

                }

                $('#filter').click(function(){
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();

                    if( from_date != '' &&  to_date != '')
                    {
                        $('#all_report').DataTable().destroy();
                        load_data(from_date, to_date);
                    }
                    else
                    {
                        alert('Both Date is required');
                    }
                });

                $('#refresh').click(function(){
                    $('#from_date').val('');
                    $('#to_date').val('');
                    $('#all_report').DataTable().destroy();
                    load_data();
                });

            });
        </script>
    </x-slot>
</x-app-layout>

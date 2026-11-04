<x-app-layout>
    <x-slot name="title">Unpaid Customs Files Report</x-slot>

    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable CSS --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        <style>
            @media print {
                table td {
                    border: 1px solid #000 !important;
                }

            }
        </style>
    </x-slot>

    <div class="container mx-auto px-4 py-6">


        {{-- Agents Table --}}
        <div class="bg-white rounded-lg shadow-md printdiv">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4 print:hidden">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <label for="year" class="mb-0">Year:</label>
                        <select id="year" class="form-select form-select-sm" style="width:110px">
                            @foreach ($years as $y)
                                <option value="{{ $y }}" @selected($y == $year)>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h2 class="text-2xl font-bold mb-6 text-center hidden print:block">Unpaid Customs Files Report </h2>
                {{-- Statistics Cards --}}
                <div class="flex justify-center items-center gap-6 mb-6">
                    <div class="flex justify-between items-center gap-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Unpaid Files</h3>
                        <p id="stat-total-unpaid" class="text-lg font-bold text-red-600">{{ $statistics['total_unpaid'] }}</p>
                    </div>

                    <div class="flex justify-between items-center gap-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Unpaid IM Files</h3>
                        <p id="stat-unpaid-im" class="text-lg font-bold text-orange-600">{{ $statistics['total_unpaid_im'] }}</p>
                    </div>

                    <div class="flex justify-between items-center gap-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Unpaid EX Files</h3>
                        <p id="stat-unpaid-ex" class="text-lg font-bold text-yellow-600">{{ $statistics['total_unpaid_ex'] }}</p>
                    </div>

                    <div class="flex justify-between items-center gap-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Total</h3>
                        <p id="stat-total-due" class="text-lg font-bold text-yellow-600">৳ {{ number_format($statistics['total_due'], 2) }}</p>
                    </div>
                </div>

                <table id="unpaidTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agent Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unpaid IM Files</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unpaid EX Files</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Unpaid Files</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount Due</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Datatable Script --}}
    <x-slot name="script">
        <!-- Datatable Scripts -->

        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                const table = new DataTable('#unpaidTable', {
                    processing: true,
                    serverSide: true,
                    pageLength: -1,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                    layout: {
                        topStart: ['pageLength', { buttons: [{ text: 'Print', action: printAllAction }] }],
                        bottomStart: 'info',
                        bottom: 'paging',
                        bottomEnd: null
                    },
                    dom: 'Bfrtip',
                    ajax: {
                        url: "{{ route('reports.unpaid') }}",
                        data: function (d) {
                            d.year = $('#year').val();
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name', name: 'agents.name'},
                        {data: 'unpaid_im_count', name: 'unpaid_im_count', searchable: false},
                        {data: 'unpaid_ex_count', name: 'unpaid_ex_count', searchable: false},
                        {data: 'total_unpaid_count', name: 'total_unpaid_count', searchable: false},
                        {data: 'total_unpaid_amount', name: 'total_unpaid_amount', searchable: false},
                    ]
                });

                // Reload table (and stats) when the year changes
                $('#year').on('change', function () {
                    table.ajax.reload();
                });

                // Update the stat cards from every AJAX response
                table.on('xhr.dt', function (e, settings, json) {
                    if (!json || !json.statistics) return;
                    const s = json.statistics;
                    $('#stat-total-unpaid').text(s.total_unpaid);
                    $('#stat-unpaid-im').text(s.total_unpaid_im);
                    $('#stat-unpaid-ex').text(s.total_unpaid_ex);
                    $('#stat-total-due').text(formatMoney(s.total_due));
                });
            });



            function escapeHtml(v) {
                return String(v ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            function printAllAction(e, dt, button, config) {
                // Same params as the last table request (year, search, sort), but ALL rows
                const params = $.extend({}, dt.ajax.params(), { start: 0, length: -1 });

                $.ajax({
                    url: dt.ajax.url(),
                    method: 'GET',
                    data: params
                }).done(function (json) {
                    const columns = dt.settings()[0].aoColumns;

                    const head = columns
                        .map(c => '<th>' + escapeHtml($(c.nTh).text()) + '</th>')
                        .join('');

                    const body = json.data.map(function (row) {
                        return '<tr>' + columns.map(function (c) {
                            return '<td>' + escapeHtml(row[c.data]) + '</td>';
                        }).join('') + '</tr>';
                    }).join('');

                    const title = 'Unpaid Files Report - ' + $('#year').val();
                    const stats =
                        'Unpaid Files: ' + $('#stat-total-unpaid').text() +
                        ' | IM: ' + $('#stat-unpaid-im').text() +
                        ' | EX: ' + $('#stat-unpaid-ex').text() +
                        ' | Total Due: ' + $('#stat-total-due').text();

                    const win = window.open('', '_blank');
                    win.document.write(`
                        <html>
                        <head>
                            <title>${title}</title>
                            <style>
                                body { font-family: Arial, sans-serif; font-size: 6px; color: #000; background: #fff; }
                                h1 { font-size: 8px; text-align: center; }
                                .stats { text-align: center; margin-bottom: 10px; }
                                table { width: 100%; border-collapse: collapse; }
                                th, td { border: 1px solid #eee; padding: 6px 8px; text-align: left; }
                                th { background: #eee; }
                                thead { display: table-header-group; }
                                tr { page-break-inside: avoid; }
                            </style>
                        </head>
                        <body>
                            <h1>${title}</h1>
                            <div class="stats">${stats}</div>
                            <table><thead><tr>${head}</tr></thead><tbody>${body}</tbody></table>
                        </body>
                        </html>
                    `);
                    win.document.close();
                    win.focus();
                    win.print();
                }).fail(function () {
                    alert('Could not load the report for printing.');
                });
            }

            function formatMoney(n) {
                return '৳ ' + Number(n).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
        </script>
    </x-slot>
</x-app-layout>

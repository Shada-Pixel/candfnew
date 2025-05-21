<x-app-layout>
    <x-slot name="title">Unpaid Customs Files Report</x-slot>

    <div class="container mx-auto px-4 py-6">
        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Unpaid Files -->
            <div class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Unpaid Files</h3>
                <p class="text-3xl font-bold text-red-600">{{ $statistics['total_unpaid'] }}</p>
            </div>

            <!-- Total Unpaid IM Files -->
            <div class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Unpaid IM Files</h3>
                <p class="text-3xl font-bold text-orange-600">{{ $statistics['total_unpaid_im'] }}</p>
            </div>

            <!-- Total Unpaid EX Files -->
            <div class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Unpaid EX Files</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $statistics['total_unpaid_ex'] }}</p>
            </div>
        </div>

        {{-- Agents Table --}}
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Agents with Unpaid Files</h2>

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
        <script>
            $(document).ready(function() {
                $('#unpaidTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('reports.unpaid') }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'unpaid_im_count', name: 'unpaid_im_count' },
                        { data: 'unpaid_ex_count', name: 'unpaid_ex_count' },
                        { data: 'total_unpaid_count', name: 'total_unpaid_count' },
                        { data: 'total_unpaid_amount', name: 'total_unpaid_amount' }
                    ],
                    order: [[1, 'asc']]
                });
            });
        </script>
    </x-slot>
</x-app-layout>

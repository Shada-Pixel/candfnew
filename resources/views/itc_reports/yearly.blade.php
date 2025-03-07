<x-guest-layout>

    <main>
        <section>
            <div class="bg-gradient-to-r from-violet-400 to-purple-300 py-8">
                <div class="container mx-auto px-4">
                    <h1 class="text-3xl font-bold text-center text-gray-800">Yearly ITC Reports</h1>
                </div>
            </div>
            <div class="max-w-7xl mx-auto py-10">
            <div class="container mx-auto px-4 py-8">
                    <table class="table w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Link</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reports as $report)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $report->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">{{ $report->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ $report->file_link }}" 
                                           target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors duration-200">
                                            View PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

</x-guest-layout>

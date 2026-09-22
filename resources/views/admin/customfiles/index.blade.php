<x-app-layout>

    <x-slot name="title">
        Custom File
    </x-slot>

    <x-slot name="headerstyle">

        {{-- DataTable CSS --}}
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css"
        >

        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.dataTables.css"
        >

    </x-slot>


    <div class="flex flex-col gap-4">

        {{-- ============================================================
            IMPORT FORM
            Hidden from checker and payunpay
        ============================================================= --}}
        @unlessrole('checker|payunpay')

            <div class="card w-full print:hidden">

                <div class="p-6">

                    <form
                        action="{{ route('customfiles.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="flex items-center gap-4"
                    >

                        @csrf

                        <input
                            type="file"
                            name="excel_file"
                            accept=".xlsx,.xls"
                            class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100"
                            required
                        >

                        <button
                            type="submit"
                            class="block text-center px-4 py-2
                                   bg-gradient-to-r from-violet-400 to-purple-300
                                   rounded-md shadow-md hover:shadow-lg
                                   hover:scale-105 duration-150 transition-all
                                   font-bold text-lg text-white"
                        >
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

        @endunlessrole


        {{-- ============================================================
            CUSTOM FILE TABLE
        ============================================================= --}}
        <div class="card w-full print:hidden">

            <div class="p-6">


                {{-- ====================================================
                    PAYUNPAY BUTTONS
                ===================================================== --}}
                @role('payunpay')

                    <div class="flex justify-start items-center mb-4 gap-4">

                        <button
                            id="clearMemoSession"
                            type="button"
                            class="block text-center px-2 py-1
                                   bg-gradient-to-r from-blue-400 to-blue-600
                                   rounded-md shadow-md hover:shadow-lg
                                   hover:scale-105 duration-150 transition-all
                                   font-bold text-md text-white"
                        >
                            <i class="mdi mdi-delete"></i>
                            Clear Memo Session
                        </button>


                        <button
                            id="printMemo"
                            type="button"
                            class="block text-center px-2 py-1
                                   bg-gradient-to-r from-green-400 to-green-600
                                   rounded-md shadow-md hover:shadow-lg
                                   hover:scale-105 duration-150 transition-all
                                   font-bold text-md text-white"
                        >
                            <i class="mdi mdi-printer"></i>
                            Print Memo
                        </button>

                    </div>

                @endrole


                {{-- ====================================================
                    TABLE
                ===================================================== --}}
                <div class="overflow-x-auto">

                    <table
                        id="customsfiles"
                        class="table is-narrow w-full"
                    >

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>
                                    Agent Name In Customs File
                                </th>

                                <th>
                                    B/E No
                                </th>

                                <th>
                                    Fees
                                </th>

                                <th>
                                    Type
                                </th>


                                {{-- Checker does not see these --}}
                                @unlessrole('checker')

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Year
                                    </th>


                                    {{-- Payunpay does not see Action --}}
                                    @unlessrole('payunpay')

                                        <th>
                                            Action
                                        </th>

                                    @endunlessrole

                                @endunlessrole

                            </tr>

                        </thead>

                        <tbody>
                            {{-- Yajra DataTables loads rows here --}}
                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- ============================================================
            PAYUNPAY PRINT TEMPLATE
        ============================================================= --}}
        @role('payunpay')

            <div
                class="printWraper print:block card p-6"
                style="display:none;"
            >

                <style>

                    .printWraper table td {
                        border: 1px solid #000;
                        padding: 8px;
                        text-align: left;
                    }

                    .printWraper table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                        font-size: 14px;
                    }

                </style>


                <h2 class="text-center text-2xl font-bold">
                    Benapole Customs C&F Agents Association
                </h2>


                <div>

                    Agent Name:
                    <span class="agentName text-lg font-semibold mb-4"></span>

                    <br>


                    <table>

                        <tbody>

                            <tr>

                                <td>
                                    Import Files
                                </td>

                                <td class="im_count">
                                    0
                                </td>

                                <td class="imfees">
                                    600
                                </td>

                                <td class="im_imfees">
                                    0
                                </td>

                                <td class="totalfees" rowspan="2">
                                    0
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Export Files
                                </td>

                                <td class="ex_count">
                                    0
                                </td>

                                <td class="exfees">
                                    500
                                </td>

                                <td class="ex_exfees">
                                    0
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        @endrole


    </div>


    {{-- ================================================================
        SCRIPTS
    ================================================================= --}}

    <x-slot name="script">

        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>

        <script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.js"></script>

        <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.dataTables.js"></script>

        <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.print.min.js"></script>


        <script>

            document.addEventListener('DOMContentLoaded', function () {

                /*
                |--------------------------------------------------------------------------
                | DataTable
                |--------------------------------------------------------------------------
                */

                const table = new DataTable('#customsfiles', {

                    processing: true,

                    serverSide: true,

                    ajax: {
                        url: "{{ route('customfiles.index') }}",
                        type: "GET"
                    },

                    pageLength: 100,

                    lengthMenu: [
                        [25, 50, 100, 250,500],
                        [25, 50, 100, 250,500]
                    ],

                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'be_number',
                            name: 'be_number'
                        },

                        {
                            data: 'fees',
                            name: 'fees'
                        },

                        {
                            data: 'type',
                            name: 'type'
                        }


                        @unlessrole('checker')

                            ,

                            {
                                data: 'status_column',
                                name: 'status',
                                orderable: true,
                                searchable: true
                            },

                            {
                                data: 'year',
                                name: 'year'
                            }


                            @unlessrole('payunpay')

                                ,

                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
                                    searchable: false
                                }

                            @endunlessrole

                        @endunlessrole

                    ],


                    order: [
                        [0, 'asc']
                    ],


                    layout: {

                        topStart: {
                            buttons: [
                                'print'
                            ]
                        },

                        bottom: 'paging',

                        bottomStart: 'info',

                        bottomEnd: null

                    }

                });


                /*
                |--------------------------------------------------------------------------
                | Clear Memo Session
                |--------------------------------------------------------------------------
                */

                const clearMemoButton =
                    document.getElementById('clearMemoSession');


                if (clearMemoButton) {

                    clearMemoButton.addEventListener('click', function () {

                        clearMemoSession();

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | Print Memo
                |--------------------------------------------------------------------------
                */

                const printMemoButton =
                    document.getElementById('printMemo');


                if (printMemoButton) {

                    printMemoButton.addEventListener('click', function () {

                        const agentName =
                            sessionStorage.getItem('agent_name');


                        if (!agentName) {

                            alert('No agent data available to print');

                            return;

                        }


                        const imCount =
                            parseInt(
                                sessionStorage.getItem('im_count') || 0
                            );


                        const exCount =
                            parseInt(
                                sessionStorage.getItem('ex_count') || 0
                            );


                        if (imCount === 0 && exCount === 0) {

                            alert('No files have been marked as paid yet');

                            return;

                        }


                        const imFees = imCount * 600;

                        const exFees = exCount * 500;

                        const totalFees = imFees + exFees;


                        document.querySelector('.printWraper').style.display =
                            'block';


                        document.querySelector('.agentName').textContent =
                            agentName;


                        document.querySelector('.im_count').textContent =
                            imCount;


                        document.querySelector('.ex_count').textContent =
                            exCount;


                        document.querySelector('.im_imfees').textContent =
                            imFees;


                        document.querySelector('.ex_exfees').textContent =
                            exFees;


                        document.querySelector('.totalfees').textContent =
                            totalFees;


                        window.removeEventListener(
                            'afterprint',
                            handleAfterPrint
                        );


                        window.addEventListener(
                            'afterprint',
                            handleAfterPrint
                        );


                        window.print();

                    });

                }


                /*
                |--------------------------------------------------------------------------
                | Clear Memo Session
                |--------------------------------------------------------------------------
                */

                function clearMemoSession() {

                    sessionStorage.removeItem('agent_id');

                    sessionStorage.removeItem('agent_name');

                    sessionStorage.removeItem('im_count');

                    sessionStorage.removeItem('ex_count');


                    const agentName =
                        document.querySelector('.agentName');

                    const imCount =
                        document.querySelector('.im_count');

                    const exCount =
                        document.querySelector('.ex_count');

                    const imFees =
                        document.querySelector('.im_imfees');

                    const exFees =
                        document.querySelector('.ex_exfees');

                    const totalFees =
                        document.querySelector('.totalfees');


                    if (agentName) agentName.textContent = '';

                    if (imCount) imCount.textContent = '0';

                    if (exCount) exCount.textContent = '0';

                    if (imFees) imFees.textContent = '0';

                    if (exFees) exFees.textContent = '0';

                    if (totalFees) totalFees.textContent = '0';

                }


                /*
                |--------------------------------------------------------------------------
                | After Print
                |--------------------------------------------------------------------------
                */

                function handleAfterPrint() {

                    clearMemoSession();

                    window.removeEventListener(
                        'afterprint',
                        handleAfterPrint
                    );

                }


            });


            /*
            |--------------------------------------------------------------------------
            | Toggle Status
            |--------------------------------------------------------------------------
            */

            function toggleStatus(id) {

                const button =
                    document.querySelector(
                        `button[data-id="${id}"]`
                    );


                if (!button) {

                    return;

                }


                if (button.textContent.trim() === 'Paid') {

                    alert(
                        'Cannot change status from Paid to Unpaid'
                    );

                    return;

                }


                if (
                    !confirm(
                        'Are you sure you want to mark this file as Paid?'
                    )
                ) {

                    return;

                }


                fetch(
                    `/customfiles/${id}/toggle-status`,
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).getAttribute('content')
                        }
                    }
                )

                .then(response => response.json())

                .then(data => {

                    if (!data.success) {

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update button
                    |--------------------------------------------------------------------------
                    */

                    button.textContent = data.status;


                    button.classList.toggle(
                        'text-red-400',
                        data.status === 'Unpaid'
                    );


                    button.classList.toggle(
                        'text-green-600',
                        data.status === 'Paid'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Agent change detection
                    |--------------------------------------------------------------------------
                    */

                    if (
                        sessionStorage.getItem('agent_id') !== null &&
                        sessionStorage.getItem('agent_id') != data.agent_id
                    ) {

                        sessionStorage.setItem(
                            'im_count',
                            0
                        );

                        sessionStorage.setItem(
                            'ex_count',
                            0
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Store Agent
                    |--------------------------------------------------------------------------
                    */

                    sessionStorage.setItem(
                        'agent_id',
                        data.agent_id
                    );


                    sessionStorage.setItem(
                        'agent_name',
                        data.agent_name
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Existing Counts
                    |--------------------------------------------------------------------------
                    */

                    let imCount =
                        parseInt(
                            sessionStorage.getItem('im_count') || 0
                        );


                    let exCount =
                        parseInt(
                            sessionStorage.getItem('ex_count') || 0
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | Increment
                    |--------------------------------------------------------------------------
                    */

                    if (data.type === 'IM') {

                        imCount++;

                        sessionStorage.setItem(
                            'im_count',
                            imCount
                        );

                    }


                    if (data.type === 'EX') {

                        exCount++;

                        sessionStorage.setItem(
                            'ex_count',
                            exCount
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update Print Template
                    |--------------------------------------------------------------------------
                    */

                    const agentName =
                        document.querySelector('.agentName');

                    const imCountElement =
                        document.querySelector('.im_count');

                    const exCountElement =
                        document.querySelector('.ex_count');


                    if (agentName) {

                        agentName.textContent =
                            data.agent_name;

                    }


                    if (imCountElement) {

                        imCountElement.textContent =
                            imCount;

                    }


                    if (exCountElement) {

                        exCountElement.textContent =
                            exCount;

                    }

                })

                .catch(error => {

                    console.error(
                        'Error:',
                        error
                    );

                    alert(
                        'Error updating status. Please try again.'
                    );

                });

            }

        </script>

    </x-slot>

</x-app-layout>

<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Due CF {{ date('Y') -1 }}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        <style>
            .ui-autocomplete {
                background-color: #fff;
                border: 1px solid #ccc;
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
            }

            .ui-menu-item {
                padding: 5px 10px;
                cursor: pointer;
            }
        </style>
        {{-- Datatable css --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.dataTables.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        {{-- Form --}}
        <div class="card mx-auto">
            <div class="p-6">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl">Due CF {{ date('Y') -1 }}</h2>
                </div>

                <form id="customFileCreateForm" action="{{route('customfiles.store')}}" method="POST">
                    @csrf
                    <div class="flex justify-between items-center gap-6">
                        <div>
                            <label for="agentain" class="block mb-2">Agent Name</label>
                            <input type="text" class="form-input" id="agentain" name="agentain" required @role('extra') autofocus @endrole value="{{$lastagent ?? ''}}">
                        </div> <!-- end -->
                        <div>
                            <label for="be_number" class="block mb-2">B/E Number</label>
                            <input type="text" class="form-input" id="be_number" name="be_number" placeholder="B/E Number" required>
                        </div> <!-- end -->

                        <div>
                            <label for="type" class="block mb-2">Type</label>
                            <select name="type" id="type" class="form-input" required>
                                <option value="IM">IM (Import)</option>
                                <option value="EX">EX (Export)</option>
                            </select>
                        </div> <!-- end -->

                        <div>
                            <label for="date" class="block mb-2">Date</label>
                            <input type="text" class="form-input skipme" id="date" name="date" placeholder="DD/MM/YYYY" required value="{{ date('d/m/Y') }}">
                        </div> <!-- end -->

                        <div>
                            <label for="year" class="block mb-2">Year</label>
                            <input type="text" class="form-input" id="year" name="year" value="{{ date('Y') -1 }}" >
                        </div> <!-- end -->

                        <div class="self-end flex justify-end">
                            <input type="submit" value="Submit" class="font-mont px-10 py-4 bg-cyan-600 text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 hover:scale-110"
                            id="baccountSaveBtn">
                        </div><!-- end -->
                    </div>
                </form>
            </div>
        </div>

        {{-- Custom Files List --}}
        <div class="card">
            <div class="p-6">
                {{-- Table start here --}}
                <table id="customsfiles" class="table is-narrow">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Agent Name In Customs File</th>
                            <th>B/E No</th>
                            <th>Fees</th>
                            <th>Type</th>
                            @unlessrole('checker')
                            <th>Status</th>
                            @unlessrole('payunpay')
                            <th>Year</th>
                            <th>Action</th>
                            @endunlessrole
                            @endunlessrole
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($customFiles as $file)
                        <tr>
                            <th>{{ $loop->index+1 }}</th>
                            <td>{{$file->name}}</td>
                            <td>{{$file->be_number}}</td>
                            <td>{{$file->fees}}</td>
                            <td>{{$file->type}}</td>
                            @unlessrole('checker')
                            <td>
                                <button
                                    onclick="toggleStatus({{ $file->id }})"
                                    class="status-btn cursor-pointer hover:opacity-75 transition-opacity {{ $file->status == 'Unpaid' ? 'text-red-400' : 'text-green-600' }}"
                                    data-id="{{ $file->id }}"
                                >
                                    {{ $file->status }}
                                </button>
                            </td>
                            <td>{{$file->year}}</td>
                            @unlessrole('payunpay')
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
                            @endunlessrole
                            @endunlessrole
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <x-slot name="script">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <!-- Datatable script-->
        <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {

                // Initialize DataTable
                new DataTable('#customsfiles', {
                    // paginate: false,
                    pageLength: 100,
                    layout: {
                        topStart: {
                            buttons: ['print']
                        },
                        // topStart: 'info',
                        bottom: 'paging',
                        bottomStart: 'info',
                        bottomEnd: null,
                    }
                });


                let enterCount = 0; // Track Enter key presses
                let enterTimer;

                // Autocomplete for Agent
                $('#agentain').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: '/ainautocomplete',
                            data: { query: request.term },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 2, // Start searching after 2 characters
                    autoFocus: true, // Highlight the first suggestion
                });


                // Attach a keydown event listener to all input fields
                $('input').on('keydown', function(e) {
                    // Check if the Tab key is pressed (keyCode 9)
                    if (e.keyCode === 9) {
                    // Prevent the default tab behavior
                    e.preventDefault();

                    // Get all input fields in the form
                    let inputs = $('form').find('input');
                    let currentIndex = inputs.index(this); // Get the index of the current input
                    let nextIndex = currentIndex + 1;

                    // Loop through the remaining fields to find the next input without the class 'skipme'
                    while (nextIndex < inputs.length) {
                        let nextInput = inputs[nextIndex];
                        if (!$(nextInput).hasClass('skipme')) {
                        nextInput.focus(); // Focus on the next input without the class 'skipme'
                        break;
                        }
                        nextIndex++;
                    }
                    }
                });

                // Focus and select the input field
                $('#name').focus().select();



                $("#customFileCreateForm").on("keydown", function (e) {
                    if (e.key === "Enter") {
                        if ($(e.target).is('textarea')) return; // Allow enter in textareas

                        e.preventDefault(); // Prevent default form submission
                        enterCount++;

                        // Check if Enter was pressed twice within 300ms
                        clearTimeout(enterTimer);
                        enterTimer = setTimeout(function () {
                            if (enterCount === 1) {
                                // Single Enter press: Focus next or submit
                                // For now, let's keep it simple and just submit if double enter is not needed
                            } else if (enterCount === 2) {
                                $('#customFileCreateForm').submit();
                            }
                            enterCount = 0; // Reset counter
                        }, 500);
                    }
                });

            });

            function submitAndPrint() {
                $('#printable').val('1');
                $('#customFileCreateForm').submit();
            }

            function toggleStatus(id) {
                const button = document.querySelector(`button[data-id="${id}"]`);
                if (button.textContent.trim() === 'Paid') {
                    alert('Cannot change status from Paid to Unpaid');
                    return;
                }

                if (!confirm('Are you sure you want to mark this file as Paid?')) {
                    return;
                }
                fetch(`/customfiles/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const button = document.querySelector(`button[data-id="${id}"]`);
                        button.textContent = data.status;
                        button.classList.toggle('text-red-400', data.status === 'Unpaid');
                        button.classList.toggle('text-green-600', data.status === 'Paid');



                        // Current session agent_id is same as the data.agent_id
                        // Check if the agent_id in sessionStorage is different from the one in data
                        // If the agent_id is different, reset the counters and store the new agent information
                        if (sessionStorage.getItem('agent_id') !== null && sessionStorage.getItem('agent_id') != data.agent_id) {

                            // Reset counters if the agent_id changed
                            sessionStorage.setItem('im_count', 0);
                            sessionStorage.setItem('ex_count', 0);
                        }


                        // Store agent information
                        sessionStorage.setItem('agent_id', data.agent_id);
                        sessionStorage.setItem('agent_name', data.agent_name);



                        // Get existing counts or initialize to 0
                        let imCount = parseInt(sessionStorage.getItem('im_count') || 0);
                        let exCount = parseInt(sessionStorage.getItem('ex_count') || 0);


                        // Increment the appropriate counter based on file type
                        if (data.type === 'IM') {
                            imCount += 1;
                            sessionStorage.setItem('im_count', imCount);
                        } else if (data.type === 'EX') {
                            exCount += 1;
                            sessionStorage.setItem('ex_count', exCount);
                        }

                        // Update the display in the print template
                        document.querySelector('.agentName').textContent = data.agent_name;
                        document.querySelector('.im_count').textContent = imCount;
                        document.querySelector('.ex_count').textContent = exCount;
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating status. Please try again.');
                });
            }

        </script>
    </x-slot>

</x-app-layout>

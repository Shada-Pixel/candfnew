<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">{{$agent->name}}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
        {{-- Datatable css --}}
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        <div class="card">

            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-bb h-2.5 rounded-full" style="width: {{$completionPercentage.'%'}}"></div>
            </div>

            <div class="p-6">

                <div class="flex justify-between  items-center gap-6 mb-6">
                    <p class="text-xl">{{$agent->name}}</p>

                    <div class="flex gap-4">
                        <a href="{{route('agents.edit',$agent->id)}}">
                            <button class="font-mont mt-2 px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Add Donation</button>
                        </a>
                        <a href="{{route('agents.edit',$agent->id)}}">
                            <button class="font-mont mt-2 px-4 py-2 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 " id="">Edit</button>
                        </a>
                    </div>
                </div>
                <p class="">Ain No: {{$agent->ain_no ?? ''}}</p>
                <p class="">Owner / Manager : {{$agent->owners_name ?? ''}}</p>
                <p class="">Designation: {{$agent->destination ?? ''}}</p>
                <p class="">Office Address: {!!$agent->office_address ?? ''!!}</p>
                <p class="">Phone: {{$agent->phone ?? ''}}</p>
                <p class="">Email: {{$agent->email ?? ''}}</p>
                <p class="">House: {{$agent->house ?? ''}}</p>
                <p class="">Note: {{$agent->note ?? ''}}</p>

                <div class="text-center">
                    <h3 class="text-2xl font-Medium">Donation</h3>
                    <p>Treatment: 3, Education: 0, Marrige: 1</p>
                </div>

                <table id="donationtable" class="display stripe text-xs sm:text-base" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Perpose</th>
                            <th>Ammount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>21-10-2012</td>
                            <td>25% Treatment</td>
                            <td>50000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>21-10-2012</td>
                            <td>25% 30 Year</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>21-10-2012</td>
                            <td>Treatment</td>
                            <td>20000</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>21-10-2012</td>
                            <td>Treatment</td>
                            <td>20000</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>21-10-2012</td>
                            <td>Education</td>
                            <td>10000</td>
                        </tr>

                    </tbody>
                </table>

            </div>



        </div> <!-- end card -->



    </div>


    <x-slot name="script">
        <!-- Datatable script-->
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>

            var datatablelist = $('#donationtable').DataTable();


        </script>
    </x-slot>
</x-app-layout>




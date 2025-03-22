<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Edit {{$agent->name}} Project</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">
        {{-- Form --}}
        <div class="card flex-grow">
            <div class="p-6">
                <h2 class="mb-4 text-xl">New Agent</h2>

                <form action="{{route('agents.update', $agent->id)}}" class="" id="agentCreateForm" enctype="multipart/form-data" method="post">

                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-3 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="ain_no" class="block mb-2">AIN No</label>
                            <input type="text" class="form-input" id="ain_no" name="ain_no" required placeholder="AIN Number" value="{{$agent->ain_no}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="name" class="block mb-2">Agency Name</label>
                            <input type="text" class="form-input" id="name" name="name" placeholder="Agent Name" required value="{{$agent->name}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="bangla_name" class="block mb-2">Bangla Name</label>
                            <input type="text" class="form-input" id="bangla_name" name="bangla_name" placeholder="Bangla Name" {{ $agent->bangla_name ? $agent->bangla_name:''}}>
                        </div> <!-- end -->

                        <div class="">
                            <label for="license_no" class="block mb-2">License No</label>
                            <input type="text" class="form-input" id="license_no" name="license_no" placeholder="License No" value="{{$agent->license_no}}">
                        </div> <!-- end -->
                        <div class="">
                            <label for="license_issue_date" class="block mb-2">Issue Date</label>
                            <input type="date" class="form-input" id="license_issue_date" name="license_issue_date" value="{{$agent->license_issue_date}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="membership_no" class="block mb-2">Membership No</label>
                            <input type="text" class="form-input" id="membership_no" name="membership_no" placeholder="Membership No" value="{{$agent->membership_no ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="agency_logo" class="block mb-2">Agency Logo</label>
                            <input type="file" class="form-input pt-[3px] pb-[2px]" id="agency_logo" name="agency_logo">
                        </div> <!-- end -->




                        <div class="">
                            <label for="office_address" class="block mb-2">Office Address</label>
                            <input type="text" class="form-input" id="office_address" name="office_address" placeholder="Office Adderss" value="{{$agent->office_address}}">
                        </div> <!-- end -->

                        <div class="col-span-3 lg:col-span-4">
                            <p>Owner's Information <hr></p>
                        </div>

                        <div class="">
                            <label for="owners_name" class="block mb-2">Owner / Manager Name</label>
                            <input type="text" class="form-input" id="owners_name" name="owners_name" placeholder="Owner Name" >
                        </div> <!-- end -->

                        <div class="">
                            <label for="owners_gender" class="block mb-2">Owner Gender</label>
                            <select name="owners_gender" id="owners_gender" class="form-select text-gray-900" >
                                <option value="" >Selece One . .</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div> <!-- end -->


                        <div class="">
                            <label for="photo" class="block mb-2">Owner Photo</label>
                            <input type="file" class="form-input pt-[3px] pb-[2px]" id="photo" name="photo">
                        </div> <!-- end -->


                        <div class="">
                            <label for="owners_designation" class="block mb-2">Owner Designation</label>
                            <select name="owners_designation" id="owners_designation" class="form-select text-gray-900">
                                <option value="" >Selece One . .</option>
                                <option value="Propitor">Propitor</option>
                                <option value="Managing Director">Managing Director</option>
                                <option value="Managing Partner">Managing Partner</option>
                                <option value="Chairman">Chairman</option>
                                <option value="Partner">Partner</option>
                                <option value="Director">Director</option>
                            </select>
                        </div> <!-- end -->




                        <div class="">
                            <label for="phone" class="block mb-2">Phone Number</label>
                            <input type="text" class="form-input" id="phone" name="phone" required value="{{$agent->phone}}">
                        </div> <!-- end -->


                        <div class="">
                            <label for="email" class="block mb-2">Email</label>
                            <input type="email" class="form-input" id="email" name="email" required 
                                value="{{$agent->email}}">
                        </div> <!-- end -->


                        <div class="">
                            <label for="house" class="block mb-2">Station / House</label>
                            <input type="text" class="form-input" id="house" name="house" required value="Benapole"
                                value="{{$agent->house}}">
                        </div> <!-- end -->

                        <div class="col-span-3 lg:col-span-4">
                            <p>Others Information <hr></p>
                        </div>

                        <div class="">
                            <label for="parmanent_address" class="block mb-2">Parmanent Address</label>
                            <input type="text" class="form-input" id="parmanent_address" name="parmanent_address" placeholder="Parmanent Adderss">
                        </div> <!-- end -->


                        <div class="col-span-2 lg:col-span-3">
                            <label for="note" class="block mb-2">Note</label>
                            <textarea  class="form-input" name="note" id="note" cols="30" rows="1" placeholder="Note"></textarea>
                        </div> <!-- end -->

                        <div class="col-span-3 lg:col-span-4 ">
                            <button type="submit"
                                class="font-mont mt-2 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300"
                                id="baccountSaveBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="script">
    </x-slot>
</x-app-layout>




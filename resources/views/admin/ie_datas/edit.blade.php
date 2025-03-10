<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Edit {{$ie_data->name}}</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        <div class="card">
            <div class="p-6">

                <form action="{{route('ie_datas.update', $ie_data->id)}}" class="" id="ieCreateForm" enctype="multipart/form-data" method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="bin_no" class="block mb-2">BIN No</label>
                            <input type="text" class="form-input" id="bin_no" name="bin_no" required value="{{$ie_data->bin_no ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="name" class="block mb-2">Importer / Exporter Name</label>
                            <input type="text" class="form-input" id="name" name="name" required value="{{$ie_data->name ?? ''}}">
                        </div> <!-- end -->


                        <div class="">
                            <label class="block mb-2 after:content-['*'] after:text-red-500">Importer / Exporter</label>
                            <div class="flex gap-6">
                                <div class="flex items-center gap-4">
                                    <input type="radio" id="contactChoice1" name="ie" value="Importer"  @if ($ie_data->ie == 'Importer')
                                    checked
                                    @endif>
                                    <label for="contactChoice1">Exporter</label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <input type="radio" id="contactChoice2" name="ie" value="Exporter" @if ($ie_data->ie == 'Exporter')
                                    checked
                                    @endif>
                                    <label for="contactChoice2">Exporter</label>
                                </div>
                            </div>
                        </div> <!-- end -->






                        <div class="">
                            <label for="owners_name" class="block mb-2">Owner / Manager Name</label>
                            <input type="text" class="form-input" id="owners_name" name="owners_name" value="{{$ie_data->owners_name ?? ''}}">
                        </div> <!-- end -->


                        <div>
                            <label class="block text-gray-600 mb-2" for="photo">Photo</label>
                            <input type="file" id="photo" class="form-input border" name="photo">
                        </div> <!-- end -->


                        <div class="">
                            <label for="destination" class="block mb-2">Designation</label>
                            <input type="text" class="form-input" id="destination" name="destination" value="{{$ie_data->destination ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="office_address" class="block mb-2">Agent / Office Address</label>
                            <input type="text" class="form-input" id="office_address" name="office_address" value="{{$ie_data->office_address ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="phone" class="block mb-2">Phone Number</label>
                            <input type="text" class="form-input" id="phone" name="phone" value="{{$ie_data->phone ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="email" class="block mb-2">Email</label>
                            <input type="email" class="form-input" id="email" name="email" value="{{$ie_data->email ?? ''}}">
                        </div> <!-- end -->

                        <div class="">
                            <label for="house" class="block mb-2">House</label>
                            <input type="text" class="form-input" id="house" name="house" value="{{$ie_data->house ?? ''}}">
                        </div> <!-- end -->

                        <div class="col-span-2">
                            <label for="note" class="block mb-2">Note</label>
                            <textarea  class="form-input" name="note" id="note" cols="30" rows="5" placeholder="Note"></textarea>
                        </div> <!-- end -->

                        <div class=" ">
                            <button type="submit"
                                class="font-mont mt-2 px-10 py-4 bg-black text-white font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 relative after:absolute after:content-['SURE!'] after:flex after:justify-center after:items-center after:text-white after:w-full after:h-full after:z-10 after:top-full after:left-0 after:bg-seagreen overflow-hidden hover:after:top-0 after:transition-all after:duration-300"
                                id="baccountSaveBtn">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div> <!-- end card -->



    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                $("form #name").on('blur', () => {
                    const slug = slugify($("form #name").val());
                    $("form #slug").val(slug);
                });
            });
        </script>
    </x-slot>
</x-app-layout>




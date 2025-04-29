<footer class="">
    <div class="bg-gray-100 pt-24">
        <div class="container px-4 text-nblue sm:grid md:grid-cols-4 sm:grid-cols-2 mx-auto">
            <div class="p-5">
                <div class="py-2.5 flex flex-col gap-4">
                    <a href="/" >
                        <div class="flex gap-2 items-center">
                            <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px]">
                            <p class="text:nblue text-2xl uppercase font-bold leading-none">Benapole<br/>C&F Association</p>
                        </div>
                    </a>
                    <p>Benapole customs C&F agents association is the bigest organization in benapole area. It is head office of all C&F agent office in benapole area. Which reg no: 842 by GDL Khulna</p>

                    <p class="mt-4">Benapole land port is the bigest land port in south asia.</p>
                    <a class="text-center capitalize px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 rounded-md shadow-md hover:shadow-lg hover:scale-110 duration-150 transition-all  font-bold text-lg text-white" href="{{route('contact')}}">Get A Free Query</a>
                </div>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Resources</div>
                <a class="my-3 block" href="{{route('aboutus')}}">About Us </a>
                <a class="my-3 block" href="https://cnfbpl.com:2096" target="_blank">Web Mail</a>
                <a class="my-3 block" href="{{route('weblinks')}}" target="_blank">Web Links</a>
                <a class="my-3 block" href="{{route('photoalbum')}}" target="_blank">Photo Album</a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Support</div>
                <a class="my-3 block" href="/#">Help Center </a><a
                    class="my-3 block" href="/#">Privacy Policy </a><a
                    class="my-3 block" href="/#">Conditions </a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Contact us</div>
                <p class="my-3 block" >Association Road, Infront of Private Stand, Benapole Bazar, Jashore, Bangladesh.</p>
                <p class="my-3 block" ><i class="mdi mdi-phone mr-2"></i> 04228-75778, 76152, 76153</p>
                <p class="my-3 block" ><i class="mdi mdi-email-outline mr-2"></i> info@cnfbpl.com, associationbpl@cnfbpl.com, associationbpl@gmail.com</p>

                <div class="font-bold text-sm uppercase text-bb mt-5">
                    <a href=""><i class="mdi mdi-facebook-box"></i></a>
                    <a href=""><i class="mdi mdi-twitter-box"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 pt-2">
        <div class="flex pb-5 px-3 m-auto pt-5 border-t text-gray-800 text-sm flex-col
          max-w-7xl items-center">
            <div class="my-5 flex justify-center items-center"><span>© Copyright {{ date('Y') }}. All Rights Reserved. Developed by</span> <a href="https://shadapixel.com" class="inline-block hover:scale-110 transition-all" target="_blank"><img src="{{asset('shadapixel.png')}}" alt="" srcset="" class="h-5 ml-2"></a></div>
        </div>
    </div>

</footer>

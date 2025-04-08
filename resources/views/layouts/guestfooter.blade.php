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
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id, aspernatur dolorum natus recusandae odit eos consectetur, aliquid fugit veritatis asperiores architecto. Beatae nostrum quam exercitationem.</p>
                    <a class="text-center capitalize px-4 py-2 bg-gradient-to-r from-violet-400 to-purple-300 rounded-md shadow-md hover:shadow-lg hover:scale-110 duration-150 transition-all  font-bold text-lg text-white" href="{{route('contact')}}">Get A Free Query</a>
                </div>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Resources</div>
                <a class="my-3 block" href="/#">Documentation <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Tutorials <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Support <span class="text-teal-600 text-xs p-1">New</span></a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Support</div>
                <a class="my-3 block" href="/#">Help Center <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Privacy Policy <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Conditions <span class="text-teal-600 text-xs p-1"></span></a>
            </div>
            <div class="p-5">
                <div class="text-sm uppercase text-bb font-bold">Contact us</div>
                <a class="my-3 block" href="/#">XXX XXXX, Floor 4 San Francisco, CA
                    <span class="text-teal-600 text-xs p-1"></span></a><a class="my-3 block" href="/#">contact@company.com
                    <span class="text-teal-600 text-xs p-1"></span></a>
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

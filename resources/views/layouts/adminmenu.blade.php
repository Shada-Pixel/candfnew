<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="{{route('dashboard')}}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <div class="flex gap-2 items-center logo-lg">
                <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px] ">
                <p class="dark:text-white text-2xl uppercase font-bold leading-none">C&F<br/> Chada</p>
            </div>
            <div class="flex gap-2 items-center logo-sm">
                <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px] ">
            </div>
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <div class="flex gap-2 items-center logo-lg">
                <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px] ">
                <p class="dark:text-nblue text-2xl uppercase font-bold leading-none">C&F<br/> Chada</p>
            </div>
            <div class="flex gap-2 items-center logo-sm">
                <img src="{{asset('bcnf.png')}}" alt="" srcset="" class="h-[50px] ">
            </div>
        </div>
    </a>



    <!--- Menu -->
    <div data-simplebar="">
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-item">
                <a href="{{route('home')}}" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-eye"></i></span>
                    <span class="menu-text"> Site </span>
                </a>
            </li>


            {{-- Agent --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-account-star-outline"></i></span>
                    <span class="menu-text"> Agents </span>
                    <span class="menu-arrow"></span>
                </a>


                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('agents.index')}}" class="menu-link">
                            <span class="menu-text">All Agents</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('agents.create')}}" class="menu-link">
                            <span class="menu-text">New Agents</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('agents.index')}}" class="menu-link">
                            <span class="menu-text">Donations</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('agents.trash')}}" class="menu-link">
                            <span class="menu-text">Trash</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Importer/Exporter --}}
            <li class="menu-item">
                <a href="{{route('ie_datas.index')}}" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-account-switch-outline"></i></span>
                    <span class="menu-text"> Importer/Exporter </span>
                </a>
            </li>
            {{-- File Datas --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-file-document-outline"></i></span>
                    <span class="menu-text"> File Datas </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('file_datas.create')}}" class="menu-link">
                            <span class="menu-text">Receive File</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('baccounts.index')}}" class="menu-link">
                            <span class="menu-text">Operated File</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('transactions.index')}}" class="menu-link">
                            <span class="menu-text">Transactions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('reports.financial.monthly')}}" class="menu-link">
                            <span class="menu-text">Monthly Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Green --}}
            {{-- <li class="menu-item">
                <a href="{{route('home')}}" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-file-cloud-outline"></i></span>
                    <span class="menu-text"> Green Files </span>
                </a>
            </li> --}}
            {{-- Finance --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-bank-outline"></i></span>
                    <span class="menu-text"> Finance </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('banks.index')}}" class="menu-link">
                            <span class="menu-text">Banks</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('baccounts.index')}}" class="menu-link">
                            <span class="menu-text">Bank Accounts</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('transactions.index')}}" class="menu-link">
                            <span class="menu-text">Transactions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('reports.financial.monthly')}}" class="menu-link">
                            <span class="menu-text">Monthly Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-briefcase-variant-outline"></i></span>
                    <span class="menu-text"> Projects </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('projects.index')}}" class="menu-link">
                            <span class="menu-text">All</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('projects.create')}}" class="menu-link">
                            <span class="menu-text">Add New</span>
                        </a>
                    </li>

                </ul>
            </li> --}}


            {{-- <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-email-outline"></i></span>
                    <span class="menu-text"> Contact Query </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('queries.index')}}" class="menu-link">
                            <span class="menu-text">Inbox</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="email-templates.html" class="menu-link">
                            <span class="menu-text">Email Templates</span>
                        </a>
                    </li>
                </ul>
            </li> --}}


            {{-- User --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-account-supervisor-outline"></i></span>
                    <span class="menu-text"> Users </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('users.index')}}" class="menu-link">
                            <span class="menu-text">All User</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('users.create')}}" class="menu-link">
                            <span class="menu-text">New User</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-text">Add Salary</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('users.index')}}" class="menu-link">
                            <span class="menu-text">Trash</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Repots --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-cards-outline"></i></span>
                    <span class="menu-text">Reports</span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Receiver Report</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Delivery Report (IM)</span>
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Delivery Report (EX)</span>
                        </a>
                    </li> --}}
                    {{-- <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Daily Summary Report</span>
                        </a>
                    </li> --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Daily Report</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Operator Report</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Data Entry Report</span>
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Assessment Report Per Day</span>
                        </a>
                    </li> --}}
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Work Report Per Day</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Monthly Ope Report</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Role Permission --}}
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-account-lock-open-outline"></i></span>
                    <span class="menu-text"> Role & Permission </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('roles.index')}}" class="menu-link">
                            <span class="menu-text">All Role</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('roles.create')}}" class="menu-link">
                            <span class="menu-text">New Role</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('permissions.index')}}" class="menu-link">
                            <span class="menu-text">Permissions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <hr>
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mdi mdi-developer-board"></i></span>
                    <span class="menu-text"> Development </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('cache.route')}}" class="menu-link">
                            <span class="menu-text">Cache Route</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('cache.config')}}" class="menu-link">
                            <span class="menu-text">Cache Config</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('cache.clear')}}" class="menu-link">
                            <span class="menu-text">Cache Clear</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('cache.view')}}" class="menu-link">
                            <span class="menu-text">View Clear</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('optimize.clear')}}" class="menu-link">
                            <span class="menu-text">Optimize Clear</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

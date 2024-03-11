<x-app-layout>
    @section('title')
    Computers
    @endsection
    <style>
        /* width */
        ::-webkit-scrollbar {
          width: 10px;
          height: 10px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
          box-shadow: inset 0 0 2px grey; 
          border-radius: 10px;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #4B5563; 
          border-radius: 10px;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: rgb(95, 95, 110); 
        }
    /* ::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    } */

    #thl::before{
        content: '';
        position: absolute;
        top: 0;
        left: -8px;
        width: 8px;
        height: 32px;
        background-color: rgb(75 85 99 / var(--tw-bg-opacity));
    }

    #thr::before{
        content: '';
        position: absolute;
        top: 0;
        right: -8px;
        width: 8px;
        height: 32px;
        background-color: rgb(75 85 99 / var(--tw-bg-opacity));
    }
    

    </style>

    <div style="height: calc(100vh - 65px);" class="py-10 px-80 text-gray-200 w-screen overflow-x-auto">
        <h1 class="mb-5 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">COMPUTERS</h1>
        <form action="{{ $Action == 'add' ? route('computer.store') : route('computer.update'); }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="itemID" value="{{ $ComputerID }}">

            <div class="mt-3">
                <label for="user" class="block text-sm font-medium text-white">User</label>
                <input required type="text" autocomplete="off" value="{{ $user }}" id="user" name="user" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-3">
                <label for="ip_add" class="block text-sm font-medium text-white">IP Address</label>
                <input required type="text" autocomplete="off" value="{{ $ip_add }}" id="ip_add" name="ip_add" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
            </div>

            <label for="type" class="mt-3 block text-sm font-medium text-white">Type</label>
            <select id="type" name="type" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                @if ($type == 'DESKTOP' || $Action != 'edit')
                    <option value="DESKTOP">DESKTOP</option>
                @else
                    <option value="LAPTOP">LAPTOP</option>
                @endif

                {{-- <option {{ $type == 'DESKTOP' ? 'selected' : ''; }} value="DESKTOP">DESKTOP</option>
                @if ($Action != 'add')
                    <option {{ $type == 'LAPTOP' ? 'selected' : ''; }} value="LAPTOP">LAPTOP</option>
                @endif --}}
            </select>

            <label for="status" class="mt-3 block text-sm font-medium text-white">Status</label>
            <select id="status" name="status" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                <option {{ $status == 'WORKING' ? 'selected' : ''; }} value="WORKING">WORKING</option>
                <option {{ $status == 'DEFECTIVE' ? 'selected' : ''; }} value="DEFECTIVE">DEFECTIVE</option>
            </select>

            <label for="site" class="mt-3 block text-sm font-medium text-white">Site</label>
            <select id="site" name="site" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                @foreach ($sites as $site)
                    <option {{ $siteEdit == $site->id ? 'selected' : ''; }} value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>

            <h1 class="my-5 font-extrabold leading-none text-2xl text-blue-500 tracking-wide">SPECS</h1>

            @php
                $ramArrayID = array();
                $ramArrayName = array();
                for($x = 0; $x < 4; $x++){
                    if(isset($selrams[$x]->id)){
                        $thisRamID = $selrams[$x]->id;
                        $thisRamName = $selrams[$x]->code;
                    }else{
                        $thisRamID = '';
                        $thisRamName = 'Select RAM '.($x+1);
                    }
                    array_push($ramArrayID, $thisRamID);
                    array_push($ramArrayName, $thisRamName);
                }
                
                $storeArrayID = array();
                $storeArrayName = array();
                for($x = 0; $x < 4; $x++){
                    if(isset($selstors[$x]->id)){
                        $thisStoreID = $selstors[$x]->id;
                        $thisStoreName = $selstors[$x]->code;
                    }else{
                        $thisStoreID = '';
                        $thisStoreName = 'Select Storage '.($x+1);
                    }
                    array_push($storeArrayID, $thisStoreID);
                    array_push($storeArrayName, $thisStoreName);
                }
                
                $otherArrayID = array();
                $otherArrayName = array();
                for($x = 0; $x < 5; $x++){
                    if(isset($selothers[$x]->id)){
                        $thisOtherID = $selothers[$x]->id;
                        $thisOtherName = $selothers[$x]->code;
                    }else{
                        $thisOtherID = '';
                        $thisOtherName = 'Select Others '.($x+1);
                    }
                    array_push($otherArrayID, $thisOtherID);
                    array_push($otherArrayName, $thisOtherName);
                }
            @endphp





            {{-- SPECS --}}
                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Laptop</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($sellaptops[0]->code) ? $sellaptops[0]->code : 'Select Laptop' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($laptops as $laptop)
                                    <li data-id="{{ $laptop->id }}" data-code="{{ $laptop->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $laptop->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="laptop" value="{{ isset($sellaptops[0]->id) ? $sellaptops[0]->id : '' }}">
                    </div>
                </div>


                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Motherboard</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selmobos[0]->code) ? $selmobos[0]->code : 'Select Motherboard' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($mobos as $mobo)
                                    <li data-id="{{ $mobo->id }}" data-code="{{ $mobo->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $mobo->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="mobo" value="{{ isset($selmobos[0]->id) ? $selmobos[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Processor</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selprocs[0]->code) ? $selprocs[0]->code : 'Select Processor' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($procs as $proc)
                                    <li data-id="{{ $proc->id }}" data-code="{{ $proc->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $proc->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="proc" value="{{ isset($selprocs[0]->id) ? $selprocs[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">RAM 1</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $ramArrayName[0] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($rams as $ram)
                                    <li data-id="{{ $ram->id }}" data-code="{{ $ram->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $ram->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="ram1" value="{{ $ramArrayID[0] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">RAM 2</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $ramArrayName[1] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($rams as $ram)
                                    <li data-id="{{ $ram->id }}" data-code="{{ $ram->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $ram->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="ram2" value="{{ $ramArrayID[1] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">RAM 3</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $ramArrayName[2] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($rams as $ram)
                                    <li data-id="{{ $ram->id }}" data-code="{{ $ram->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $ram->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="ram3" value="{{ $ramArrayID[2] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">RAM 4</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $ramArrayName[3] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($rams as $ram)
                                    <li data-id="{{ $ram->id }}" data-code="{{ $ram->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $ram->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="ram4" value="{{ $ramArrayID[3] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Storage 1</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $storeArrayName[0] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($stors as $stor)
                                    <li data-id="{{ $stor->id }}" data-code="{{ $stor->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $stor->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="stor1" value="{{ $storeArrayID[0] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Storage 2</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $storeArrayName[1] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($stors as $stor)
                                    <li data-id="{{ $stor->id }}" data-code="{{ $stor->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $stor->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="stor2" value="{{ $storeArrayID[1] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Storage 3</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $storeArrayName[2] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($stors as $stor)
                                    <li data-id="{{ $stor->id }}" data-code="{{ $stor->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $stor->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="stor3" value="{{ $storeArrayID[2] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Storage 4</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $storeArrayName[3] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($stors as $stor)
                                    <li data-id="{{ $stor->id }}" data-code="{{ $stor->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $stor->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="stor4" value="{{ $storeArrayID[3] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Graphics Card</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selgpus[0]->code) ? $selgpus[0]->code : 'Select Graphics Card' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($gpus as $gpu)
                                    <li data-id="{{ $gpu->id }}" data-code="{{ $gpu->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $gpu->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="gpu" value="{{ isset($selgpus[0]->id) ? $selgpus[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Power Supply</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selpsus[0]->code) ? $selpsus[0]->code : 'Select Power Supply' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($psus as $psu)
                                    <li data-id="{{ $psu->id }}" data-code="{{ $psu->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $psu->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="psu" value="{{ isset($selpsus[0]->id) ? $selpsus[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Operating System</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($seloss[0]->code) ? $seloss[0]->code : 'Select Power Supply' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($oss as $os)
                                    <li data-id="{{ $os->id }}" data-code="{{ $os->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $os->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="os" value="{{ isset($seloss[0]->id) ? $seloss[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Monitor</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selmonitors[0]->code) ? $selmonitors[0]->code : 'Select Monitor' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($monitors as $monitor)
                                    <li data-id="{{ $monitor->id }}" data-code="{{ $monitor->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $monitor->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="monitor" value="{{ isset($selmonitors[0]->id) ? $selmonitors[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Mouse</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selmouses[0]->code) ? $selmouses[0]->code : 'Select Mouse' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($mouses as $mouse)
                                    <li data-id="{{ $mouse->id }}" data-code="{{ $mouse->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $mouse->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="mouse" value="{{ isset($selmouses[0]->id) ? $selmouses[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Keyboard</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($selkbs[0]->code) ? $selkbs[0]->code : 'Select Keyboard' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($kbs as $kb)
                                    <li data-id="{{ $kb->id }}" data-code="{{ $kb->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $kb->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="kb" value="{{ isset($selkbs[0]->id) ? $selkbs[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">LAN Card</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ isset($sellans[0]->code) ? $sellans[0]->code : 'Select LAN Card' }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($lans as $lan)
                                    <li data-id="{{ $lan->id }}" data-code="{{ $lan->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $lan->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="lan" value="{{ isset($sellans[0]->id) ? $sellans[0]->id : '' }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Others 1</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $otherArrayName[0] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($others as $other)
                                    <li data-id="{{ $other->id }}" data-code="{{ $other->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $other->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="other1" value="{{ $otherArrayID[0] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Others 2</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $otherArrayName[1] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($others as $other)
                                    <li data-id="{{ $other->id }}" data-code="{{ $other->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $other->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="other2" value="{{ $otherArrayID[1] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Others 3</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $otherArrayName[2] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($others as $other)
                                    <li data-id="{{ $other->id }}" data-code="{{ $other->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $other->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="other3" value="{{ $otherArrayID[2] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Others 4</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $otherArrayName[3] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($others as $other)
                                    <li data-id="{{ $other->id }}" data-code="{{ $other->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $other->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="other4" value="{{ $otherArrayID[3] }}">
                    </div>
                </div>

                <div>
                    <label for="brand" class="mt-3 block text-sm font-medium text-white">Others 5</label>
                    <div class="wrapper w-full relative">
                        <div class="select-btn flex items-center justify-between rounded-md bg-gray-700 p-2 h-9 cursor-pointer">
                            <span>{{ $otherArrayName[4] }}</span>
                            <i class="uil uil-angle-down text-2xl transition-transform duration-300"></i>
                        </div>
                        <div class="content bg-gray-700 mt-1 rounded-md p-3 hidden absolute w-full z-50 border border-gray-500">
                            <div class="search relative">
                                <i class="uil uil-search absolute left-3 leading-9 text-gray-500"></i>
                                <input type="text" class="selectSearch w-full leading-9 text-gray-700 rounded-md pl-9 outline-none h-9" placeholder="Search">
                            </div>
                            <ul class="listOption options mt-2 max-h-64 overflow-y-auto">
                                <li data-id="" data-code="None" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">None</li>
                                @foreach ($others as $other)
                                    <li data-id="{{ $other->id }}" data-code="{{ $other->code }}" class="h-9 cursor-pointer hover:bg-gray-800 rounded-md flex items-center pl-3 leading-9">{{ $other->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="other5" value="{{ $otherArrayID[4] }}">
                    </div>
                </div>
            {{-- SPECS END --}}

            <div class="mt-5">
                <button type="submit" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('item.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){

            $('.select-btn').click(function(e){
                $('.content').not($(this).closest('.wrapper').find('.content')).addClass('hidden');
                $(this).closest('.wrapper').find('.content').toggleClass('hidden');
                $(this).closest('.wrapper').find('.uil-angle-down').toggleClass('-rotate-180');
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }

            $('.content').click(function(e){
                e.stopPropagation();
            });
            
            $(".selectSearch").on("input", function() {
                var value = $(this).val().toLowerCase();
                searchFilter(value);
            });

            $(".listOption li").click(function(){
                var id = $(this).data('id');
                var code = $(this).data('code');
                $(this).closest('.wrapper').find('input').val(id);
                $(this).closest('.wrapper').find('.select-btn span').html(code);
                $('.content').addClass('hidden');
                $('.selectSearch').val('');
                var value = $(".selectSearch").val().toLowerCase();
                searchFilter(value);
            });

            $(document).click(function() {
                $('.content').addClass('hidden');
                $('.uil-angle-down').removeClass('-rotate-180');
            });
        });
    </script>
</x-app-layout>

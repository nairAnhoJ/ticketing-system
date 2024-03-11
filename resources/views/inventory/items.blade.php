<x-app-layout>
    @section('title')
    Items
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

    {{-- STATUS CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="statusConfirmation" data-modal-target="statusModal" data-modal-toggle="statusModal" class="hidden text-white bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700" type="button"></button>
        
        <!-- Main modal -->
        <div id="statusModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('item.status') }}" method="POST" id="statusForm" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between px-6 py-4 border-b rounded-t border-gray-600">
                        <h3 id="changeStatusHeader" class="text-xl font-semibold text-yellow-300">
                            Mark as Used
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="statusModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="statusID" name="statusID" value="">
                        <input type="hidden" id="thisStatus" name="thisStatus" value="">
                        <div id="divModalBody">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center py-3 px-5 space-x-2 border-t rounded-b border-gray-600">
                        <button type="submit" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700">Submit</button>
                        <button data-modal-hide="statusModal" type="button" class="rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- STATUS CONFIRMATION MODAL END --}}

    {{-- DEFECTIVE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="defectiveConfirmation" data-modal-target="defectiveModal" data-modal-toggle="defectiveModal" class="hidden text-white bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700" type="button"></button>
        
        <!-- Main modal -->
        <div id="defectiveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('item.defective') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between px-6 py-4 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-yellow-300">
                            Warning
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="defectiveModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="defectiveID" name="defectiveID" value="">
                        <p class="text-base leading-relaxed text-white">
                            Are you sure you want to mark this item as defective?
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center py-3 px-5 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="defectiveModal" type="submit" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700">Yes</button>
                        <button data-modal-hide="defectiveModal" type="button" class="rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DEFECTIVE CONFIRMATION MODAL END --}}

    {{-- DELETE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="deleteConfirmation" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700" type="button"></button>
        
        <!-- Main modal -->
        <div id="deleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('item.delete') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-yellow-300">
                            Warning
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="deleteModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="deleteID" name="deleteID" value="">
                        <p class="text-base leading-relaxed text-white">
                            Are you sure you want to permanently delete this item?
                        </p>
                        <p class="text-gray-300">Item Code: <span id="deleteDesc" class="font-semibold"></span></p>
                        {{-- <p class="text-gray-300">Serial Number: <span id="deleteSN" class="font-semibold"></span></p> --}}
                        
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="deleteModal" type="submit" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700">Yes</button>
                        <button data-modal-hide="deleteModal" type="button" class="rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DELETE CONFIRMATION MODAL END --}}

    {{-- VIEW ITEM MODAL --}}
        <!-- ========================================================= Modal toggle ========================================================= -->
        <button id="viewItem" class="hidden text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700" type="button" data-modal-toggle="itemModal"></button>
        
        <!-- ========================================================= Main modal ========================================================= -->
        <div id="itemModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-5xl md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700 text-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-2xl font-semibold text-white leading-5 tracking-wide">
                            <span id="code"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="itemModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4">
                        <div class="grid grid-cols-5 gap-y-3 text-white">
                            <div>Item Type: </div>
                            <div id="type" class="col-span-4 font-semibold"></div>
                            <div>Description: </div>
                            <div id="desc" class="col-span-4 font-semibold"></div>
                            <div>Remarks: </div>
                            <div id="remarks" class="col-span-4 font-semibold"></div>
                            <div>Serial Number: </div>
                            <div id="serial_no" class="col-span-4 font-semibold"></div>
                            <div>Status: </div>
                            <div id="status" class="col-span-4 font-semibold"></div>
                            <div>Site: </div>
                            <div id="site" class="col-span-4 font-semibold"></div>
                            <div>Date Delivered: </div>
                            <div id="date_delivered" class="col-span-4 font-semibold"></div>
                            <div id="invoiceLabel" class="self-center">Invoice</div>
                            <div id="invoiceForm" class="col-span-4 font-semibold">
                                <input type="hidden" id="itemID" name="itemID">
                                <button type="button" data-modal-toggle="viewInvoice" class="text-white font-medium rounded-lg text-sm px-5 py-1.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">View</button>
                                <a id="invoiceDownloadButton" href="" class="text-white font-medium rounded-lg text-sm px-5 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Download</a>
                            </div>
                            <hr class="col-span-5 mt-3">
                            <div id="userDescTitle" class="col-span-5 text-xl text-blue-500 font-bold mt-3">User Description</div>
                            <div class="mt-1">User: </div>
                            <div id="itemUser" class="col-span-4 font-semibold"></div>
                            <div class="mt-1">Department: </div>
                            <div id="itemDept" class="col-span-4 font-semibold"></div>
                            <div class="mt-1">Remarks: </div>
                            <div id="itemRemarks" class="col-span-4 font-semibold"></div>
                            <div id="dateDescTitle" class="mt-1">Date Issued: </div>
                            <div id="itemDate" class="col-span-4 font-semibold"></div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t rounded-b border-gray-600">
                        <div id="divStatus">
                        </div>
                        <button id="btnDefective" data-modal-toggle="itemModal" type="button" class="w-44 tracking-wider mr-3 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-red-700 text-gray-100 border-red-500 hover:text-white hover:bg-red-600">Mark as Defective</button>
                        <button id="btnCancel" data-modal-toggle="itemModal" type="button" class="w-44 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW ITEM MODAL END --}}

    {{-- VIEW INVOICE MODAL --}}
        <!-- ========================================================= Main modal ========================================================= -->
        <div id="viewInvoice" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div style="height: calc(100vh - 20px);" class="relative w-4/5">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700 text-sm h-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-2xl font-semibold text-white leading-5 tracking-wide">
                            <span id="code2"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="viewInvoice">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div style="height: calc(100% - 130px);" class="p-4">
                        <img id="itemInvoice" class="h-full mx-auto" src=""/>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t rounded-b border-gray-600">
                        <button data-modal-toggle="viewInvoice" type="button" class="rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW INVOICE MODAL END --}}

    <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
        <div class="grid grid-cols-3 mb-3">
            <div class="flex items-center">
                <h1 class="font-extrabold leading-none text-3xl text-blue-500 tracking-wide">ITEMS</h1>
            </div>
            <div class="justify-self-end col-span-2">
                <a href="{{ route('disposal.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-8 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">For Disposal</a>
                <a href="{{ route('return.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Return Item/s</a>
                <a href="{{ route('defectiveIndex.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Defective Items</a>
            </div>
        </div>

        {{-- CONTROLS --}}
        <div class="grid grid-cols-2 mb-1 h-10">
            <div class="h-8">
                <a href="{{ route('item.add') }}" type="button" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Add Item</a>
            </div>
            <div class="flex gap-x-3 h-8">
                <div class="w-1/3">
                    {{-- <select id="countries" class="border text-sm rounded-lg block px-2.5 pt-1 pb-0 w-full h-full bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500">
                        <option selected value="">All Item Type</option>
                        @foreach ($types as $type)
                            <option value="{{$type->name}}">{{ ucfirst(strtolower($type->name)) }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="flex items-center w-2/3">
                    <form method="GET" action="" id="searchForm" class="w-full">
                        <label for="searchInput" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="searchInput" class="block w-full px-4 py-2.5 pl-10 text-sm text-gray-100 border border-gray-600 rounded-lg bg-gray-700 focus:ring-blue-500 focus:border-blue-500" placeholder="SEARCH" value="{{ $search }}" autocomplete="off">
                            <button id="clearButton" type="button" class=" absolute right-20 bottom-1">
                                <i class="uil uil-times text-2xl"></i>
                            </button>
                            <button id="searchButton" type="button" style="bottom: 5px; right: 5px;" type="submit" class="text-white absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- TABLE --}}
        <div style="max-height: calc(100% - 126px);" class="overflow-x-auto relative shadow-md rounded-t-lg">
            <table class="min-w-full text-sm text-left text-gray-400">
                <thead class="relative top-0 text-xs uppercase bg-gray-600 text-gray-400 border-x-8 border-gray-600">
                    <tr class="bg-gray-600 sticky top-0">
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            ITEM CODE
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            TYPE
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DESCRIPTION
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            SERIAL NUMBER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DATE RECIEVED
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            STATUS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            COMPUTER NAME
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            SITE
                        </th>
                        <th id="thr" scope="col" class="sticky top-0 py-2 text-center">
                            ACTION
                        </th>
                    </tr>
                </thead>
                <tbody id="itemTableBody" style="max-height: calc(100% - 126px);">
                    @php
                        $x = 1;
                    @endphp
                    @foreach ($items as $item)
                        <tr class="bg-gray-800 border-gray-700 hover:bg-gray-700 cursor-pointer">
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <span data-id="{{ $item->id }}" data-code="{{ $item->code }}" data-type="{{ $item->type }}" data-desc="{{ $item->brand.' '.$item->description }}" data-status="{{ $item->status }}" data-i_remarks="{{ $item->i_remarks }}" data-serial_no="{{ $item->serial_no }}" data-invoice_no="{{ $item->invoice_no }}" data-site="{{ $item->site }}" data-date_delivered="{{ $item->date_purchased }}" data-com="{{ $item->comp }}" data-i_user="{{ $item->i_user }}" data-i_dept="{{ $item->dept_name }}" data-i_date_issued="{{ $item->i_date_issued }}" data-prev_user="{{ $item->prev_user }}" data-prev_user_dept="{{ $item->prev_user_dept }}" data-date_returned="{{ $item->date_returned }}" data-return_remarks="{{ $item->return_remarks }}">
                                    {{ $item->code }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->type }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->brand.' '.$item->description }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->serial_no }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->date_purchased }}
                            </td>
                            <td class="py-3 px-6 text-center font-medium tracking-wide whitespace-nowrap {{ ($item->status == 'SPARE') ? 'text-emerald-400' : 'text-red-400'; }}">
                                {{ $item->status }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->comp }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->site }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <a href="{{ url('/inventory/items/edit/'.$item->id ) }}" class="editButton font-medium text-blue-500 hover:underline">Edit</a> | 
                                <a type="button" data-id="{{ $item->id }}" data-code="{{ $item->code }}" class="deleteButton font-medium text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
            <div class="grid md:grid-cols-2 mt-3 px-3">
                @php
                    $prev = $page - 1;
                    $next = $page + 1;
                    $from = ($prev * 100) + 1;
                    $to = $page * 100;
                    if($to > $itemCount){
                        $to = $itemCount;
                    }if($itemCount == 0){
                        $from = 0;
                    }
                @endphp
                <div class="justify-self-center md:justify-self-start self-center">
                    <span class="text-sm text-gray-400">
                        Showing <span class="font-semibold text-gray-400">{{ $from }}</span> to <span class="font-semibold text-gray-400">{{ $to }}</span> of <span class="font-semibold text-gray-400">{{ $itemCount }}</span> Items
                    </span>
                </div>

                <div class="justify-self-center md:justify-self-end">
                    <nav aria-label="Page navigation example" class="h-8 mb-0.5 shadow-xl">
                        <ul class="inline-flex items-center -space-x-px">
                            <li>
                                <a href="{{ ($search == '') ? url('/inventory/items/'.$prev) : url('/inventory/items/'.$prev.'/'.$search);  }}"  class="{{ ($page == 1) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                                    <i class="uil uil-arrow-left text-2xl"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li>
                                <p class="block w-20 h-9 leading-9 text-center z-10 text-gray-400 bg-gray-700">Page {{ $page }}</p>
                            </li>
                            <li>
                                <a href="{{ ($search == '') ? url('/inventory/items/'.$next) : url('/inventory/items/'.$next.'/'.$search); }}" class="{{ ($to == $itemCount) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                                    <i class="uil uil-arrow-right text-2xl"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        {{-- PAGINATION END --}}



    </div>

    <script>
        $(document).ready(function(){
            $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                    $("#itemTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('.editButton').click(function(e){
                e.stopPropagation();
            });

            $('.deleteButton').click(function(e){
                var code = $(this).data('code');
                var id = $(this).data('id');
                $('#deleteID').val(id);
                $('#deleteDesc').html(code);
                $('#deleteConfirmation').click();
                e.stopPropagation();
            });

            $('#itemTableBody tr').click(function() {
                var id = $(this).find("span").data('id');
                $('#itemID').val(id);

                var code = $(this).find("span").data('code');
                $('#code').html(code);
                $('#code2').html(code);

                var type = $(this).find("span").data('type');
                $('#type').html(type);

                var desc = $(this).find("span").data('desc');
                $('#desc').html(desc);

                var serial_no = $(this).find("span").data('serial_no');
                $('#serial_no').html(serial_no);

                var site = $(this).find("span").data('site');
                $('#site').html(site);

                var status = $(this).find("span").data('status');
                var com = $(this).find("span").data('com');
                $('#status').html(status);
                $('#updateStatus').val(status);
                if(status == 'SPARE'){
                    $('#divStatus').html(`
                        <button id="btnStatus" data-status="${status}" type="button" class="w-44 tracking-wider mr-3 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-blue-700 text-gray-100 border-blue-600 hover:text-white hover:bg-blue-600">Mark as Used</button>
                    `);

                    $('#userDescTitle').html('Previous User Description');
                    $('#dateDescTitle').html('Date Returned:');

                    var prev_user = $(this).find("span").data('prev_user');
                    if(prev_user != ''){
                        $('#itemUser').html(prev_user);
                    }else{
                        $('#itemUser').html('N/A');
                    }

                    var prev_user_dept = $(this).find("span").data('prev_user_dept');
                    $('#itemDept').html(prev_user_dept);

                    var return_remarks = $(this).find("span").data('return_remarks');
                    $('#itemRemarks').html(return_remarks);

                    var date_returned = $(this).find("span").data('date_returned');
                    $('#itemDate').html(date_returned);

                }else if(status == 'USED'){
                    $('#divStatus').html(`
                        <button id="btnEditDetails" data-status="${status}" type="button" class="tracking-wider mr-2 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-blue-700 text-gray-100 border-blue-600 hover:text-white hover:bg-blue-600">Edit Details</button>
                        <a href="/inventory/items/issuance-form/${id}" target='_blank' class="tracking-wider mr-3 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-blue-700 text-gray-100 border-blue-600 hover:text-white hover:bg-blue-600">Print Issuance Form</a>
                    `);
                    // <button id="btnStatus" data-status="${status}" type="button" class="w-44 tracking-wider mr-3 rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-blue-700 text-gray-100 border-blue-600 hover:text-white hover:bg-blue-600">Mark as Spare</button>

                    $('#userDescTitle').html('User Description');
                    $('#dateDescTitle').html('Date Issued:');

                    var i_user = $(this).find("span").data('i_user');
                    if(i_user != ''){
                        $('#itemUser').html(i_user);
                    }else{
                        $('#itemUser').html('N/A');
                    }

                    var i_dept = $(this).find("span").data('i_dept');
                    $('#itemDept').html(i_dept);

                    var i_remarks = $(this).find("span").data('i_remarks');
                    $('#itemRemarks').html(i_remarks);

                    var i_date_issued = $(this).find("span").data('i_date_issued');
                    $('#itemDate').html(i_date_issued);

                }else{
                    $('#divStatus').html(``);
                }

                var date_delivered = $(this).find("span").data('date_delivered');
                $('#date_delivered').html(date_delivered);

                var invoice_no = $(this).find("span").data('invoice_no');
                var path = `{{ asset('storage/${invoice_no}') }}`;
                $('#itemInvoice').prop('src', path);


                var src = `{{ url('/inventory/items/invoice-download/${id}') }}`;
                $('#invoiceDownloadButton').prop('href', src);

                $('#viewItem').click();
            });

            $('#btnDefective').click(function(){
                var id = $('#itemID').val();
                $('#defectiveID').val(id);

                $('#defectiveConfirmation').click();
            });

            jQuery(document).on("click", "#btnStatus", function(){
                var id = $('#itemID').val();
                var status = $(this).data('status');
                $('#statusID').val(id);
                $('#thisStatus').val(status);
                if(status == 'SPARE'){
                    $('#changeStatusHeader').html('Mark as Used');
                    $('#divModalBody').html(`
                        <label for="user" class="block mt-2 text-sm font-medium text-white">User</label>
                        <input required type="text" id="user" name="user" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

                        <label for="department" class="mt-2 block text-sm font-medium text-white">Department</label>
                        <select required id="department" name="department" autocomplete="off" class="border text-sm rounded-lg focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>

                        <label for="cost" class="block mt-2 text-sm font-medium text-white">Cost</label>
                        <input required type="text" id="cost" name="cost" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

                        <label for="color" class="block mt-2 text-sm font-medium text-white">Color</label>
                        <input required type="text" id="color" name="color" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

                        <label for="status" class="mt-2 block text-sm font-medium text-white">Status</label>
                        <select required id="status" name="status" autocomplete="off" class="border text-sm rounded-lg focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                                <option value="BRAND NEW">Brand New</option>
                                <option value="OLD UNIT">Old Unit</option>
                        </select>

                        <label for="remarks" class="block mt-2 text-sm font-medium text-white">Remarks</label>
                        <input required type="text" id="remarks" name="remarks" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">
                
                        <label for="date_issued" class="block text-sm font-medium text-white">Date Issued</label>
                        <div class="relative">
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input datepicker datepicker-autohide type="text" id="date_issued" name="date_issued" value="{{ date('m-d-Y') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:border-blue-500 block w-full pl-10 p-2.5" required>
                            </div>
                        </div>
                    `);
                }else if(status == 'USED'){
                    $('#changeStatusHeader').html('Mark as Spare');
                    $('#divModalBody').html(`
                        <p class="text-base leading-relaxed text-white">
                            Are you sure you want to mark this item as spare?
                        </p>
                    `);
                }

                $('#btnCancel').click();
                $('#statusConfirmation').click();
            });

            jQuery(document).on("click", "#btnEditDetails", function(){
                var id = $('#itemID').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('issuance.edit') }}",
                    method:"POST",
                    data:{
                        id: id,
                        _token: _token
                    },
                    success:function(result){
                        $('#divModalBody').html(result);
                        $('#changeStatusHeader').html('Edit Issuance Details');
                        $('#statusID').val(id);
                        $('#btnCancel').click();
                        $('#statusConfirmation').click();
                        $('#statusForm').prop('action', `{{ route('issuance.update') }}`);
                    }
                });
            });


            $('#searchButton').click(function(){
                var search = $('#searchInput').val();
                if(search != ""){
                    $('#searchForm').prop('action', `{{ url('/inventory/items/1/${search}') }}`);
                }else{
                    $('#searchForm').prop('action', `{{ url('/inventory/items/1') }}`);
                }
                $('#searchForm').submit();
            });
            $('#searchInput').on('keydown', function(event) {
                if (event.keyCode === 13) {
                    $('#searchButton').click();
                    event.preventDefault();
                }
            });
            $('#clearButton').click(function(){
                $('#searchInput').val('');
            });

        });
    </script>
</x-app-layout>

<x-app-layout>
    @section('title')
    Phone / SIM
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

    {{-- REISSUE MODAL --}}
        <!-- Main modal -->
        <div id="reissueModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('phoneSim.reissue') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between px-6 py-4 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-yellow-300">
                            Re-Issue
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="reissueModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="reissueID" name="reissueID" value="">
                        <p class="text-base leading-relaxed text-white">
                            <div class="mt-5">
                                <label for="iUser" class="block text-sm font-medium text-white">User</label>
                                <input required type="text" value="" id="iUser" name="user" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                            </div>

                            <div class="mt-5">
                                <label for="iDept" class="mt-5 block text-sm font-medium text-white">Department</label>
                                <select id="iDept" name="department" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5">
                                <label for="iSite" class="block text-sm font-medium text-white">Site</label>
                                <select required id="iSite" name="site" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5">
                                <label for="iDate" class="block text-sm font-medium text-white">Date Issued</label>
                                <div class="relative">
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-autohide type="text" id="iDate" name="date_issued" value="date('m-d-Y') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="iRemarks" class="block text-sm font-medium text-white">Remarks</label>
                                <input required type="text" value="" id="iRemarks" name="remarks" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                            </div>
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center py-3 px-5 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="reissueModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">SUBMIT</button>
                        <button data-modal-hide="reissueModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- REISSUE MODAL END --}}

    {{-- DEFECTIVE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="defectiveConfirmation" data-modal-target="defectiveModal" data-modal-toggle="defectiveModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
        
        <!-- Main modal -->
        <div id="defectiveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('phoneSim.defective') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
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
                        <button data-modal-hide="defectiveModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                        <button data-modal-hide="defectiveModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DEFECTIVE CONFIRMATION MODAL END --}}

    {{-- DELETE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="deleteConfirmation" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
        
        <!-- Main modal -->
        <div id="deleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('phoneSim.delete') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
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
                            Are you sure you want to delete this item?
                        </p>
                        <p class="text-gray-300">Item Description: <span id="deleteDesc" class="font-semibold"></span></p>
                        <p class="text-gray-300">Serial Number: <span id="deleteSN" class="font-semibold"></span></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="deleteModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                        <button data-modal-hide="deleteModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DELETE CONFIRMATION MODAL END --}}

    {{-- VIEW ITEM MODAL --}}
        <!-- ========================================================= Modal toggle ========================================================= -->
        <button id="viewItem" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="itemModal"></button>
        
        <!-- ========================================================= Main modal ========================================================= -->
        <div id="itemModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full py-4 px-40 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700 text-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-2xl font-semibold text-white leading-5 tracking-wide">
                            <span id="item"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="itemModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4">
                        <div class="grid grid-cols-5 gap-y-3 text-white">
                            <input type="hidden" id="itemID" name="itemID">
                            <div>User: </div>
                            <div id="user" class="col-span-4 font-semibold"></div>
                            <div>Department: </div>
                            <div id="dept" class="col-span-4 font-semibold"></div>
                            <div>Description: </div>
                            <div id="desc" class="col-span-4 font-semibold"></div>
                            <div>Serial Number: </div>
                            <div id="serial_no" class="col-span-4 font-semibold"></div>
                            <div>Status: </div>
                            <div id="status" class="col-span-4 font-semibold"></div>
                            <div>Site: </div>
                            <div id="site" class="col-span-4 font-semibold"></div>
                            <div>Date Issued: </div>
                            <div id="date_issued" class="col-span-4 font-semibold"></div>
                            <div>Date Delivered: </div>
                            <div id="date_del" class="col-span-4 font-semibold"></div>
                            {{-- <div id="invoiceLabel" class="self-center">Invoice</div>
                            <div id="invoiceForm" class="col-span-4 font-semibold">
                                <button type="button" data-modal-toggle="viewInvoice" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">View</button>
                                <a id="invoiceDownloadButton" href="" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Download</a>
                            </div> --}}
                        </div>
                        <hr class="my-5">
                        <!-- User History -->
                            <div class="text-base leading-relaxed text-white mb-3 max-h-[calc(100vh-600px)] overflow-y-auto">
                                <h1 class="text-gray-300 font-bold text-xl">USER HISTORY</h1>
                                <table class="w-full mt-3">
                                    <thead>
                                        <tr class="text-left border-b border-gray-500 bg-gray-500">
                                            <th>
                                                DATE ISSUED
                                            </th>
                                            <th>
                                                USER
                                            </th>
                                            <th>
                                                DEPARTMENT
                                            </th>
                                            <th>
                                                SITE
                                            </th>
                                            <th>
                                                REMARKS
                                            </th>
                                            <th>
                                                RECEIVED BY
                                            </th>
                                            <th>
                                                DATE RETURNED
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="userHistory">
                                    </tbody>
                                </table>
                            </div>
                        <!-- User History -->
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t rounded-b border-gray-600">
                        <button id="reissueButton" type="button" data-modal-hide="itemModal" data-modal-target="reissueModal" data-modal-toggle="reissueModal" class="tracking-wider mr-3 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-emerald-700 text-gray-100 border-emerald-500 hover:text-white hover:bg-emerald-600 focus:ring-emerald-600">Re-Issue</button>
                        <a href="#" target="_blank" id="btnIssuance" data-modal-toggle="itemModal" type="button" class="tracking-wider mr-3 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-blue-700 text-gray-100 border-blue-500 hover:text-white hover:bg-blue-600 focus:ring-blue-600">Print Issuance Form</a>
                        <button id="btnDefective" data-modal-toggle="itemModal" type="button" class="tracking-wider mr-3 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-red-700 text-gray-100 border-red-500 hover:text-white hover:bg-red-600 focus:ring-red-600">Mark as Defective</button>
                        <button data-modal-toggle="itemModal" type="button" class="tracking-wider focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- VIEW ITEM MODAL END --}}

    {{-- VIEW INVOICE MODAL --}}
        <!-- ========================================================= Main modal ========================================================= -->
        {{-- <div id="viewInvoice" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div style="height: calc(100vh - 20px);" class="relative w-4/5">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700 text-sm h-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-2xl font-semibold text-white leading-5 tracking-wide">
                            <span id="item2"></span>
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
                        <button data-modal-toggle="viewInvoice" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- VIEW INVOICE MODAL END --}}

    <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
        <div class="grid grid-cols-2 mb-2">
            <div class="flex items-center">
                <h1 class="font-extrabold leading-none text-3xl text-blue-500 tracking-wide">PHONE / SIM CARD</h1>
            </div>
            <div class="justify-self-end">
                <a href="{{ route('defectivePhone.index') }}" class="h-full text-white focus:ring-4 font-medium rounded-lg text-sm px-10 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Defective Phone / SIM Card</a>
                <a href="{{ route('phoneSim.report.index') }}" class="h-full text-white focus:ring-4 font-medium rounded-lg text-sm px-10 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Report</a>
            </div>
        </div>

        {{-- CONTROLS --}}
        <div class="grid grid-cols-2 mb-0 h-10">
            <div class="h-8">
                <a href="{{ route('phoneSim.add') }}" type="button" class="h-full text-white focus:ring-4 font-medium rounded-lg text-sm px-10 pt-2 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Add Item</a>
            </div>
            <div class="flex gap-x-3 h-8">
                <div class="w-1/3">
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
                        <th id="thr" scope="col" class="sticky top-0 py-2 text-center">
                            ACTION
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            ITEM
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            USER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DEPARTMENT
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DESCRIPTION
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            SERIAL / SIM NO
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            REMARKS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            SITE
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            STATUS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DATE ISSUED
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DATE DELIVERED
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
                                <a href="{{ url('/inventory/phone-sim/edit/'.$item->id ) }}" class="editButton font-medium text-blue-500 hover:underline">Edit</a> | 
                                <a type="button" data-id="{{ $item->id }}" data-desc="{{ $item->desc }}" data-serial_no="{{ $item->serial_no }}" class="deleteButton font-medium text-red-500 hover:underline">Delete</a>
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <span data-id="{{ $item->id }}" data-item="{{ $item->item }}" data-user="{{ $item->user }}" data-desc="{{ $item->desc }}" data-serial_no="{{ $item->serial_no }}" data-remarks="{{ $item->remarks }}" data-site="{{ $item->site_name }}" data-status="{{ $item->status }}" data-date_del="{{ $item->date_del }}" data-date_issued="{{ $item->date_issued }}">
                                    {{ $item->item }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->user }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->dept }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->desc }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->serial_no }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->remarks }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->site_name }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->status }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->date_issued }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->date_del }}
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
                                <a href="{{ ($search == '') ? url('/inventory/phone-sim/'.$prev) : url('/inventory/phone-sim/'.$prev.'/'.$search);  }}"  class="{{ ($page == 1) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                                    <i class="uil uil-arrow-left text-2xl"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li>
                                <p class="block w-20 h-9 leading-9 text-center z-10 text-gray-400 bg-gray-700">Page {{ $page }}</p>
                            </li>
                            <li>
                                <a href="{{ ($search == '') ? url('/inventory/phone-sim/'.$next) : url('/inventory/phone-sim/'.$next.'/'.$search); }}" class="{{ ($to == $itemCount) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
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
            $('#searchButton').click(function(){
                var search = $('#searchInput').val();
                if(search != ""){
                    $('#searchForm').prop('action', `{{ url('/inventory/phone-sim/1/${search}') }}`);
                }else{
                    $('#searchForm').prop('action', `{{ url('/inventory/phone-sim/1') }}`);
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

            $('.editButton').click(function(e){
                e.stopPropagation();
            });

            $('.deleteButton').click(function(e){
                var desc = $(this).data('desc');
                var sn = $(this).data('serial_no');
                var id = $(this).data('id');
                $('#deleteID').val(id);
                $('#deleteDesc').html(desc);
                $('#deleteSN').html(sn);
                $('#deleteConfirmation').click();
                e.stopPropagation();
            });

            $('#itemTableBody tr').click(function() {
                var id = $(this).find("span").data('id');
                $('#itemID').val(id);
                $('#reissueID').val(id);
                $('#btnIssuance').attr('href', `/inventory/phone-sim/issuance-form/${id}`);


            var _token = $('input[name="_token"]').val();
            
            $.ajax({
                url: "{{ route('phoneSim.view') }}",
                method: "POST",
                dataType: 'json',
                data: {
                    id: id,
                    _token: _token
                },
                success:function(result){
                    $('#item').html(result.item);
                    $('#item2').html(result.item);

                    $('#user').html(result.user);
                    $('#dept').html(result.dept);
                    $('#desc').html(result.desc);
                    $('#serial_no').html(result.serial_no);
                    $('#site').html(result.site);
                    $('#status').html(result.status);
                    if(result.status != 'RETURNED'){
                        $('#reissueButton').addClass('hidden');
                    }else{
                        $('#reissueButton').removeClass('hidden');
                    }
                    $('#date_del').html(result.date_del);
                    $('#date_issued').html(result.date_issued);

                    $('#userHistory').html(result.his);

                    $('#viewItem').click();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            })


                // var item = $(this).find("span").data('item');
                // $('#item').html(item);
                // $('#item2').html(item);

                // var user = $(this).find("span").data('user');
                // $('#user').html(user);

                // var desc = $(this).find("span").data('desc');
                // $('#desc').html(desc);

                // var serial_no = $(this).find("span").data('serial_no');
                // $('#serial_no').html(serial_no);

                // var site = $(this).find("span").data('site');
                // $('#site').html(site);

                // var status = $(this).find("span").data('status');
                // $('#status').html(status);
                // if(status != 'RETURNED'){
                //     $('#reissueButton').addClass('hidden');
                // }else{
                //     $('#reissueButton').removeClass('hidden');
                // }

                // var date_del = $(this).find("span").data('date_del');
                // $('#date_del').html(date_del);

                // var date_issued = $(this).find("span").data('date_issued');
                // $('#date_issued').html(date_issued);

                // var invoice = $(this).find("span").data('invoice');
                // var path = `{{ asset('storage/${invoice}') }}`;
                // $('#itemInvoice').prop('src', path);

                // var src = `{{ url('/inventory/phone-sim/invoice-download/${id}') }}`;
                // $('#invoiceDownloadButton').prop('href', src);

                // $('#viewItem').click();
            });

            $('#btnDefective').click(function(){
                var id = $('#itemID').val();
                $('#defectiveID').val(id);

                $('#defectiveConfirmation').click();
            });
        });
    </script>
</x-app-layout>
 
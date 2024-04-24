<x-app-layout>
    @section('meta')
    {{-- <meta name="refresh_timer" http-equiv="Refresh" content="300"> --}}
    @endsection
    @section('title')
        HR Ticketing
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

        .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div id="loadingScreen"></div>

    <div style="height: calc(100vh - 65px);" class="w-screen p-3 text-gray-200">
        <div class="grid grid-cols-2 items-center mb-1.5">
            <h1 class="text-3xl font-extrabold leading-none tracking-wide text-blue-500">TICKETING</h1>
            
            @if (auth()->user()->dept_id == $deptInCharge)
            <a href="{{ route('ticket.reports') }}" type="button" class="justify-self-end w-48 text-white text-center focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Ticket Report</a>
            @endif
        </div>

        <!-- ====================================================== Modal toggle ====================================================== -->
        <button id="viewTicket" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="ticketModal">
        </button>
        
        <!-- ========================================================= Main modal ========================================================= -->
        <div id="ticketModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-4xl md:h-auto">
                <!-- Modal content -->
                <form id="statusUpdateForm" enctype="multipart/form-data" action="{{ route('ticket.update') }}" method="POST" class="relative text-sm bg-gray-700 rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b border-gray-600 rounded-t">
                        <h3 class="text-2xl font-semibold leading-5 tracking-wide text-white">
                            @csrf
                            <input type="hidden" id="ticketID" name="ticketID">
                            <input type="hidden" id="ticketStatus" name="ticketStatus">
                            <input type="hidden" id="isCancel" name="isCancel" value="0">
                            <input type="hidden" id="isUpdate" name="isUpdate" value="0">
                            <span id="ticketNumber"></span>
                            <br>
                            <span id="ticketRequester" class="text-sm"></span><span class="mx-2 text-sm">|</span><span id="ticketDepartment" class="text-sm"></span><span class="mx-2 text-sm">|</span><span id="ticketDate" class="text-sm"></span><span class="mx-2 text-sm">|</span><span id="ticketStatus2" class="text-sm"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="ticketModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-3">
                        <p id="ticketSubject" class="mb-2 text-xl font-semibold leading-relaxed text-gray-300"></p>
                        <div id="ticketDesc" class="mb-2 text-base leading-relaxed text-gray-300 whitespace-pre-line"></div>
                        <div>
                            <button id="AttachedFileButton" data-modal-toggle="AttachedFileModal" type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">View Attached File</button>
                            <button id="SAPButton" type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">View SAP Business Partner</button>
                        </div>
                        <div id="ticketUpdateInput"></div>
                        @if (auth()->user()->dept_id == $deptInCharge)
                            <div id="ticketResolutionInput"></div>
                        {{-- @else --}}
                        @endif
                            {{-- <div id="ticketUpdate"></div>
                        @endif --}}

                        {{-- @if (auth()->user()->dept_id != $deptInCharge) --}}
                            {{-- <div id="ticketUpdateDiv"></div> --}}
                        {{-- @endif --}}

                        <div id="ticketResolutionDiv"></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t border-gray-600 rounded-b">
                        <div id="updateButtonDiv"></div>
                        @if (auth()->user()->dept_id == $deptInCharge)
                            <button data-modal-toggle="ticketModal" type="submit" id="ticketButton" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 mr-3 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"></button>
                        @endif
                        <div id="cancelButtonDiv"></div>
                        <button data-modal-toggle="ticketModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- ====================================================== Attached File modal ====================================================== -->
        <div id="AttachedFileModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-6xl md:h-auto">
                <!-- Modal content -->
                <div class="relative text-sm bg-gray-700 rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b border-gray-600 rounded-t">
                        <h3 class="text-2xl font-semibold tracking-wide text-white">
                            <span id="aticketNumber"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="AttachedFileModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-3 space-y-3">
                        <div style="height: calc(100vh - 200px);">
                            <img id="ticketAttachment" class="h-full mx-auto" src=""/>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 space-x-3 border-t border-gray-600 rounded-b">
                        <button data-modal-toggle="AttachedFileModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ========================================================= SAP modal ========================================================= -->
        <button id="viewSAP" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="SAPModal">
        </button>

        <div id="SAPModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-6xl md:h-auto">
                <!-- Modal content -->
                <div class="relative text-sm bg-gray-700 rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b border-gray-600 rounded-t">
                        <h3 class="text-2xl font-semibold tracking-wide text-white">
                            <span id="sticketNumber"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="SAPModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <div>
                            <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-wide text-blue-500">SAP BUSINESS PARTNER</h1>
                            
                            <div class="grid content-center w-full grid-cols-9 gap-2">
                                <div class="py-px text-sm leading-7">Type of Request</div>
                                <div class="col-span-2">
                                    <input type="text" id="request" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Remarks</div>
                                <div class="col-span-5">
                                    <input type="text" id="remarks" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>



                
                                <div class="col-span-9 my-1">
                                    <div class="w-full h-px border-b border-b-gray-500"></div>
                                </div>
                                
                                <div class="py-px text-sm leading-7">BP Code</div>
                                <div class="col-span-2">
                                    <input type="text" id="code" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">WTax Code</div>
                                <div class="col-span-2">
                                    <input type="text" id="wtax_code" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">AR In-Charge</div>
                                <div class="col-span-2">
                                    <input type="text" id="AR_inCharge" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                
                


                
                                <div class="py-px text-sm leading-7">BP Type</div>
                                <div class="col-span-2">
                                    <input type="text" id="type" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">On Hold</div>
                                <div class="col-span-2">
                                    <input type="text" id="isOnHold" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">AR Email</div>
                                <div class="col-span-2">
                                    <input type="text" id="AR_email" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                
                
                
                                <div class="py-px text-sm leading-7">Customer Name</div>
                                <div class="col-span-2">
                                    <input type="text" id="name" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">SOA Auto Email</div>
                                <div class="col-span-2">
                                    <input type="text" id="isAutoEmail" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Payment Terms</div>
                                <div class="col-span-2">
                                    <input type="text" id="payment_terms" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                
                
                
                                <div class="py-px text-sm leading-7">Billing Address</div>
                                <div class="col-span-2">
                                    <input type="text" id="billing_address" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Business Style</div>
                                <div class="col-span-5">
                                    <input type="text" id="style" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" readonly>
                                </div>
                
                
                
                                <div class="py-px text-sm leading-7">Shipping Address</div>
                                <div class="col-span-2">
                                    <input type="text" id="shipping_address" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Name</div>
                                <div class="">
                                    <input type="text" id="contact_name1" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact No</div>
                                <div class="">
                                    <input type="text" id="contact_no1" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Email</div>
                                <div class="">
                                    <input type="text" id="contact_email1" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                
                
                
                                <div class="py-px text-sm leading-7">TIN</div>
                                <div class="col-span-2">
                                    <input type="text" id="tin" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Name</div>
                                <div class="">
                                    <input type="text" id="contact_name2" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact No</div>
                                <div class="">
                                    <input type="text" id="contact_no2" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Email</div>
                                <div class="">
                                    <input type="text" id="contact_email2" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                
                
                
                                <div class="py-px text-sm leading-7">Sales Employee</div>
                                <div class="col-span-2">
                                    <input type="text" id="sales_employee" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Name</div>
                                <div class="">
                                    <input type="text" id="contact_name3" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact No</div>
                                <div class="">
                                    <input type="text" id="contact_no3" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                                <div class="py-px text-sm leading-7 justify-self-end">Contact Email</div>
                                <div class="">
                                    <input type="text" id="contact_email3" class="border text-sm rounded-lg block w-full px-2.5 py-1 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 space-x-3 border-t border-gray-600 rounded-b">
                        <button data-modal-toggle="SAPModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- CONTROLS --}}
        <div class="grid h-10 grid-cols-3 mb-0">
            <div class="h-8 col-span-2">
                {{-- @if ($userDept != 'IT') --}}
                @if (auth()->user()->dept_id != $deptInCharge)
                    <a href="{{ route('ticket.create') }}" type="button" class="w-40 mb-2 mr-2 text-sm font-medium leading-8 text-center text-white bg-blue-600 rounded-lg focus:ring-4 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Create Ticket</a>
                    {{-- <a href="{{ route('sap.index') }}" type="button" class="w-40 mb-2 mr-2 text-sm font-medium leading-8 text-center text-white bg-blue-600 rounded-lg focus:ring-4 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">SAP BP</a> --}}
                @else
                    {{-- <a href="{{ route('ticket.createForIT') }}" type="button" class="w-40 mb-2 mr-2 text-sm font-medium leading-8 text-center text-white bg-blue-600 rounded-lg focus:ring-4 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Create Ticket</a> --}}
                @endif
            </div>
            <div class="flex h-8">
                {{-- <div class="flex w-1/3">
                    <label for="status" class="self-center mr-3">Status: </label>
                    <select id="status" class="block border text-sm rounded-lg px-2.5 pt-1 pb-0 w-full h-full bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <option selected value="all">All</option>
                        <option value="proc">Pending</option>
                        <option value="mobo">Ongoing</option>
                        <option value="ram">Done</option>
                    </select>
                </div> --}}
                <div class="items-center w-full">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full h-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="tableSearch" autocomplete="off" class="h-full border text-sm rounded-lg block w-full pl-10 p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search" required>
                    </div>
                </div>
            </div>
        </div>

        
            {{-- TABLE --}}
        <div style="max-height: calc(100% - 85px);" class="relative overflow-x-auto rounded-t-lg shadow-md">
            <table class="min-w-full text-sm text-left text-gray-400">
                <thead class="relative top-0 text-xs text-gray-400 uppercase bg-gray-600 border-gray-600 border-x-8">
                    <tr class="sticky top-0 bg-gray-600">
                        <th id="thl" scope="col" class="sticky top-0 py-2 text-center">
                            TICKET #
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            REQUESTER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DEPARTMENT
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DATE CREATED
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            STATUS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            NATURE OF PROBLEM
                        </th>
                        <th scope="col" class="sticky top-0 max-w-xs py-2 text-center">
                            SUBJECT
                        </th>
                        {{-- <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            ASSIGNED TO
                        </th> --}}
                    </tr>
                </thead>
                <tbody id="ticketTableBody" style="max-height: calc(100% - 126px);">
                @foreach ($tickets as $ticket)
                    <tr class="bg-gray-800 border-gray-700 hover:bg-gray-700 cursor-pointer {{ (strtotime($ticket->created_at) > strtotime("-1 day")) ? 'text-green-500' : '' }}">
                        <th scope="row" class="px-6 py-3 font-medium text-center text-white">
                            <span data-id="{{ $ticket->id }}" data-ticket_no="{{ $ticket->ticket_no }}" data-is_SAP="{{ $ticket->is_SAP }}" data-user="{{ $ticket->requestor->name }}" data-dept="{{ $ticket->departmentRow->name }}" data-date="{{ date("M d, Y h:i A", strtotime($ticket->created_at)) }}" data-subject="{{ $ticket->subject }}" data-desc="{{ $ticket->description }}" data-status="{{ $ticket->status }}" data-src="{{ $ticket->attachment }}" data-reso="{{ $ticket->resolution }}" data-update="{{ $ticket->update }}">
                                {{ $ticket->ticket_no }}
                            </span>
                        </th>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $ticket->requestor['name'] }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $ticket->departmentRow['name'] }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ date("M d, Y h:i A", strtotime($ticket->created_at)) }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <span class="
                                @php
                                    $status = $ticket->status;
                                    if($status == 'PENDING'){
                                        echo 'text-red-500';
                                    }elseif($status == 'ONGOING'){
                                        echo 'text-amber-300';
                                    }elseif($status == 'DONE'){
                                        echo 'text-teal-500';
                                    }elseif($status == 'CANCELLED'){
                                        echo 'text-neutral-300';
                                    }
                                @endphp
                            ">
                                @php
                                    echo $status;
                                @endphp
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $ticket->category['name'] }}
                        </td>
                        <td class="max-w-xs px-6 py-3 overflow-hidden text-center whitespace-nowrap">
                            {{ $ticket->subject }}
                        </td>
                        {{-- <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $ticket->assigned['name'] }}
                        </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

  <script>
    $(document).ready(function(){

        
        var delayTime = 90000;
        var timeoutID;
        function refreshPage() {
            location.reload();
        }
        function resetTimeout() {
            clearTimeout(timeoutID);
            timeoutID = setTimeout(refreshPage, delayTime);
        }
        $(document).on('mousemove keydown', resetTimeout);
        resetTimeout();



        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#ticketTableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        if($('#ticketButton').length){
            $('#ticketButton').click(function(){
                $('#loadingScreen').html(`<div wire:loading class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-800 opacity-75">
                    <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
                    <h2 class="text-xl font-semibold text-center text-white">Processing...</h2>
                    <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
                </div>`);
            });
        }

        $('#ticketTableBody tr').click(function() {
            var id = $(this).find("span").data('id');
            $('#ticketID').val(id);

            var ticket_no = $(this).find("span").data('ticket_no');
            $('#ticketNumber').html(ticket_no);
            $('#aticketNumber').html(ticket_no);
            $('#sticketNumber').html(ticket_no);

            var req = $(this).find("span").data('user');
            $('#ticketRequester').html(req);

            var dept = $(this).find("span").data('dept');
            $('#ticketDepartment').html(dept);
            
            var date = $(this).find("span").data('date');
            $('#ticketDate').html(date);
            
            var subject = $(this).find("span").data('subject');
            $('#ticketSubject').html(subject);
            
            var desc = $(this).find("span").data('desc');
            $('#ticketDesc').html(desc);
            
            var src = $(this).find("span").data('src');
            if(src != ""){
                var nsrc = `{{ asset('storage/${src}') }}`;
                $('#ticketAttachment').prop('src', nsrc);
                $('#AttachedFileButton').removeClass('hidden');
            }else{
                $('#AttachedFileButton').addClass('hidden');
            }
            
            var status = $(this).find("span").data('status');
            var update = $(this).find("span").data('update');
            $('#ticketStatus').val(status);
            $('#ticketStatus2').html(status);
            if(status == 'PENDING'){
                if($('#ticketButton').length){
                    $('#ticketButton').removeClass('hidden');
                    $('#ticketButton').html('Mark as ONGOING');
                }
                $('#updateButtonDiv').html('');
                $('#cancelButtonDiv').html(`<button id="cancelButton" type="button" data-modal-toggle="ticketModal" type="button" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border border-red-600 bg-red-600 hover:bg-red-700 focus:ring-red-900">Cancel Ticket</button>`);
                $('#ticketUpdateInput').html('');
                $('#ticketResolutionInput').html('');
                $('#ticketUpdateDiv').html('');
                $('#ticketResolutionDiv').html('');
                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-red-500');
                $('#ticketStatus2').removeClass('text-neutral-300');
                $('#ticketUpdateDiv').addClass('hidden');
            }else if(status == 'ONGOING'){
                if($('#ticketButton').length){
                    $('#ticketButton').removeClass('hidden');
                    $('#ticketButton').html('Mark as DONE');
                }
                if(update == ''){
                    $('#ticketUpdateDiv').html('');
                }else{
                    $('#ticketUpdateDiv').html(`<hr class="my-5">
                                                <label for="ticketResolution" class="block text-base font-medium text-white">Update</label>
                                                <textarea disabled style="resize: none;" rows=10 cols=50 maxlength=1000 class="block p-2.5 w-full max-h- text-sm rounded-lg bg-gray-700 border-gray-700 placeholder-gray-400 text-white">${update}</textarea>`);
                }
                $('#ticketResolutionDiv').html('');
                $('#updateButtonDiv').html(`<button id="updateButton" type="button" data-modal-toggle="ticketModal" type="button" class="focus:outline-none text-neutral-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border border-yellow-500 bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-900">Update Ticket</button>`);
                $('#cancelButtonDiv').html(`<button id="cancelButton" type="button" data-modal-toggle="ticketModal" type="button"               class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border border-red-600 bg-red-600 hover:bg-red-700 focus:ring-red-900">Cancel Ticket</button>`);
                $('#ticketUpdateInput').html(`<hr class="my-5">
                                                <label for="ticketUpdate" class="block mb-2 text-base font-medium text-white">Update</label>
                                                <textarea style="resize: none;" id="ticketUpdate" name="ticketUpdate" rows=4 cols=50 maxlength=1000 class="taAutoHeight block p-2.5 w-full text-sm rounded-lg border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">${update}</textarea>`);
                $('#ticketResolutionInput').html(`
                                                <label for="ticketResolution" class="block mt-5 mb-2 text-base font-medium text-white">Resolution <span class="text-red-500 text-sm">*Required upon completion</span></label>
                                                <textarea required style="resize: none;" id="ticketResolution" name="ticketResolution" rows=4 cols=50 maxlength=1000 class="taAutoHeight block p-2.5 w-full text-sm rounded-lg border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"></textarea>`);
                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-neutral-300');
                $('#ticketUpdateDiv').removeClass('hidden');
            }else if(status == 'DONE'){
                var reso = $(this).find("span").data('reso');
                if($('#ticketButton').length){
                    $('#ticketButton').addClass('hidden');
                }
                $('#ticketUpdateInput').html('');
                $('#ticketResolutionInput').html('');
                $('#updateButtonDiv').html('');
                $('#cancelButtonDiv').html('');
                if(update == ''){
                    $('#ticketUpdateDiv').html('');
                }else{
                    $('#ticketUpdateDiv').html(`<hr class="my-5">
                                                <label for="doneTicketUpdate" class="block text-base font-medium text-white">Update</label>
                                                <textarea disabled style="max-height: 150px; resize: none;" id="doneTicketUpdate" class="taAutoHeight w-full text-base leading-relaxed text-gray-300 bg-gray-700">${update}</textarea>`);
                }
                $('#ticketResolutionDiv').html(`<hr class="my-5">
                                                <label for="ticketResolution" class="block mb-2 text-base font-medium text-white">Resolution</label>
                                                <textarea disabled style="max-height: 150px; resize: none;" id="ticketResolution" class="taAutoHeight w-full text-base leading-relaxed text-gray-300 bg-gray-700">${reso}</textarea>`);
                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').addClass('text-teal-500');
                $('#ticketStatus2').removeClass('text-neutral-300');
                $('#ticketUpdateDiv').removeClass('hidden');
            }else if(status == 'CANCELLED'){
                if($('#ticketButton').length){
                    $('#ticketButton').addClass('hidden');
                }
                $('#ticketUpdateInput').html('');
                $('#updateButtonDiv').html('');
                $('#ticketResolutionInput').html('');
                $('#cancelButtonDiv').html('');
                if(update == ''){
                    $('#ticketUpdateDiv').html('');
                }else{
                    $('#ticketUpdateDiv').html(`<hr class="my-5">
                                                <label for="doneTicketUpdate" class="block text-base font-medium text-white">Update</label>
                                                <textarea disabled style="resize: none;" cols=50 maxlength=1000 id="ticketResolution" class="block p-2.5 w-full text-sm rounded-lg bg-gray-700 border-gray-700 placeholder-gray-400 text-white">${update}</textarea>`);
                }
                $('#ticketResolutionDiv').html('');
                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-neutral-300');
                $('#ticketUpdateDiv').removeClass('hidden');
            }
            
            var is_SAP = $(this).find("span").data('is_sap');
            
            if(is_SAP != "0"){
                $('#SAPButton').removeClass('hidden');
            }else{
                $('#SAPButton').addClass('hidden');
            }

            // $("meta[name='refresh_timer']").remove();
            $('meta[http-equiv="refresh"]').attr('content', '');
            $('#viewTicket').click();

            var ticketResolution = $('.taAutoHeight');
            ticketResolution.css('height', 'auto');
            ticketResolution.css('height', ticketResolution.prop('scrollHeight') + 'px');
        });

        $('#SAPButton').click(function(){
            var ticketID = $('#ticketID').val();
            var _token = $('input[name="_token"]').val();
            
            $.ajax({
                url: "{{ route('sap.details') }}",
                method: "POST",
                dataType: 'json',
                data: {
                    ticketID: ticketID,
                    _token: _token
                },
                success:function(result){
                    $('#request').val(result.request);
                    $('#remarks').val(result.description);
                    $('#type').val(result.type);
                    $('#code').val(result.code);
                    $('#wtax_code').val(result.wtax_code);
                    $('#AR_inCharge').val(result.AR_inCharge);
                    $('#isOnHold').val(result.isOnHold);
                    $('#AR_email').val(result.AR_email);
                    $('#name').val(result.name);
                    $('#isAutoEmail').val(result.isAutoEmail);
                    $('#payment_terms').val(result.payment_terms);
                    $('#billing_address').val(result.billing_address);
                    $('#style').val(result.style);
                    $('#shipping_address').val(result.shipping_address);
                    $('#contact_name1').val(result.contact_name1);
                    $('#contact_no1').val(result.contact_no1);
                    $('#contact_email1').val(result.contact_email1);
                    $('#tin').val(result.tin);
                    $('#contact_name2').val(result.contact_name2);
                    $('#contact_no2').val(result.contact_no2);
                    $('#contact_email2').val(result.contact_email2);
                    $('#sales_employee').val(result.sales_employee);
                    $('#contact_name3').val(result.contact_name3);
                    $('#contact_no3').val(result.contact_no3);
                    $('#contact_email3').val(result.contact_email3);
                    $('#viewSAP').click();
                }
            })
        });

        jQuery(document).on( "click", "#cancelButton", function(){
            $('#isCancel').val('1');
            $('#isUpdate').val('0');
            $('#statusUpdateForm').submit();
        });

        jQuery(document).on( "click", "#updateButton", function(){
            $('#isUpdate').val('1');
            $('#isCancel').val('0');
            $('#statusUpdateForm').submit();
        });
    });
  </script>
</x-app-layout>

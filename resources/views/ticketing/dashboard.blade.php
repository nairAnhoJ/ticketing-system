<x-app-layout>
    @section('meta')
    {{-- <meta name="refresh_timer" http-equiv="Refresh" content="300"> --}}
    @endsection
    @section('title')
    {{ $deptInCharge->department->name }} Ticketing System
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
        <div class="flex items-center justify-between mb-1.5">
            <h1 class="text-3xl font-extrabold leading-none tracking-wide text-blue-500">{{ $deptInChargeRow->department->name }} TICKETING</h1>
            
            {{-- <div class="text-white text-center text-3xl font-bold mb-5">
                HR TICKETING SYSTEM
            </div> --}}

            @if (auth()->user()->dept_id == $deptInCharge)
                <a href="{{ route('ticket.reports') }}" type="button" class="justify-self-end w-48 text-white text-center focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Ticket Report</a>
            @else
                <div class="w-48"></div>
            @endif
        </div>
        
        <!--  View Ticket Modal  -->
            <button id="viewTicket" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="ticketModal">
            </button>

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
                        <!-- Modal header -->
                        <!-- Modal body -->
                            <div class="p-3">
                                <p id="ticketSubject" class="mb-2 text-xl font-semibold leading-relaxed text-gray-300"></p>
                                <div id="ticketDesc" class="mb-2 text-base leading-relaxed text-gray-300 whitespace-pre-line"></div>
                                {{-- Attachment Buttons --}}
                                    <div>
                                        <button id="AttachedFileButton" data-modal-toggle="AttachedFileModal" type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">
                                            View Attached File
                                        </button>
                                        {{-- Resolution Attached File --}}
                                            <button id="ResolutionAttachedFileButton" type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">
                                                View/Download Attached File
                                            </button>
                                            <a id="ResolutionAttachedFileDownload" href="" download class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">
                                                View/Download Attached File
                                            </a>
                                        {{-- Resolution Attached File --}}
                                        <button id="SAPButton" type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-3 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">
                                            View SAP Business Partner
                                        </button>
                                    </div>
                                {{-- Attachment Buttons --}}
                                <div id="ticketUpdateDiv">
                                    <hr class="my-5">
                                    <label for="ticketUpdateTextArea" class="block text-base font-medium text-white">Update</label>
                                    <textarea disabled id="ticketUpdateTextArea" style="resize: none;" rows=4 cols=50 maxlength=1000 class="UpdateDivAutoHeight block max-h-[200px] p-2.5 w-full text-sm rounded-lg bg-gray-700 border-gray-700 placeholder-gray-400 text-white">${update}</textarea>
                                </div>
                                <div id="ticketUpdateInputDiv" class="flex gap-x-3">
                                    <input type="text" id="ticketUpdateInput" name="ticketUpdate" class="w-full first-letter:block p-2.5 text-sm rounded-lg bg-gray-700 border border-gray-300 placeholder-gray-400 text-white" placeholder="Update here..." autocomplete="off">
                                    <div id="updateButtonDiv" class=" whitespace-nowrap">
                                        <button id="updateButton" type="button" data-modal-toggle="ticketModal" type="button" class="focus:outline-none text-neutral-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border border-yellow-500 bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-900">Update Ticket</button>
                                    </div>
                                </div>
                                @if (auth()->user()->dept_id == $deptInCharge)
                                    <div id="ticketResolutionInputDiv">
                                        <label class="block mt-5 mb-2 text-base font-medium text-white">
                                            Resolution <span class="text-red-500 text-sm">*Required upon completion</span>
                                        </label>
                                        <textarea style="resize: none;" id="ticketResolutionInput" name="ticketResolution" rows=4 cols=50 maxlength=1000 class="block p-2.5 w-full text-sm rounded-lg border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        <div class="mt-5">
                                            <label for="attachment" class="block text-sm font-medium text-white">Upload Attachment</label>
                                            <div class="col-span-5">
                                                <input id="attachment" name="attachment" class="block w-full h-10 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" accept=".jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .xls, .xlsx">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div id="ticketResolutionDiv">
                                    <hr class="my-5">
                                    <label for="ticketResolution" class="block mb-2 text-base font-medium text-white">Resolution</label>
                                    <textarea disabled style="max-height: 150px; resize: none;" id="ticketResolution" class="ResolutionAutoHeight w-full text-base leading-relaxed text-gray-300 bg-gray-700"></textarea>
                                </div>
                            </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-3 border-t border-gray-600 rounded-b">
                            @if (auth()->user()->dept_id == $deptInCharge)
                                <button data-modal-toggle="ticketModal" type="submit" id="ticketButton" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 mr-3 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"></button>
                            @endif
                            <div id="cancelButtonDiv">
                                <button id="cancelButton" type="button" data-modal-toggle="ticketModal" type="button" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border border-red-600 bg-red-600 hover:bg-red-700 focus:ring-red-900">Cancel Ticket</button>
                            </div>
                            <button data-modal-toggle="ticketModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        <!--  View Ticket Modal  -->
        
        <!--  Attached File modal  -->
            <div id="AttachedFileModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-6xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative text-sm bg-gray-700 rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b border-gray-600 rounded-t">
                            <h3 class="text-2xl font-semibold tracking-wide text-white">
                                <span class="aticketNumber"></span>
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
        <!--  Attached File modal  -->
        
        <!--  Resolution Attached File modal  -->
            <button id="OpenResolutionAttachedFileModal" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="ResolutionAttachedFileModal">
            </button>

            <div id="ResolutionAttachedFileModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-6xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative text-sm bg-gray-700 rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b border-gray-600 rounded-t">
                            <h3 class="text-2xl font-semibold tracking-wide text-white">
                                <span class="aticketNumber"></span>
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="ResolutionAttachedFileModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-3 space-y-3">
                            <div style="height: calc(100vh - 200px);">
                                <img id="ticketResolutionAttachment" class="h-full mx-auto" src=""/>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-3 space-x-3 border-t border-gray-600 rounded-b">
                            <button data-modal-toggle="ResolutionAttachedFileModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!--  Resolution Attached File modal  -->
        
        <!--  SAP modal  -->
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
        <!--  SAP modal  -->


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
        {{-- CONTROLS --}}

        
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
                                NATURE OF PROBLEM
                            </th>
                            <th scope="col" class="sticky top-0 max-w-xs py-2 text-center">
                                SUBJECT
                            </th>
                            <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                                STATUS
                            </th>
                            <th scope="col" class="sticky top-0 py-2 text-center">
                                DATE/TIME CREATED
                            </th>
                            @if (auth()->user()->dept_id == $deptInCharge)
                                <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                                    ELAPSED TIME
                                </th>
                            @endif
                            <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                                ASSIGNED TO
                            </th>
                        </tr>
                    </thead>
                    <tbody id="ticketTableBody" style="max-height: calc(100% - 126px);">
                        @foreach ($tickets as $ticket)
                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-700 cursor-pointer
                                @php
                                    $sla = $ticket->category->sla;
                                    $status = $ticket->status;
                                    if(strtotime($ticket->created_at) > strtotime("-1 day")){
                                        echo 'text-green-500';
                                    }else if(strtotime($ticket->created_at) < strtotime("-1 day") && strtotime($ticket->created_at) > strtotime("-".$sla." day")){
                                        echo 'text-yellow-500';
                                    }else if($status == 'PENDING' || $status == 'ONGOING'){
                                        echo 'text-red-500';
                                    }
                                @endphp
                            {{ (strtotime($ticket->created_at) > strtotime("-1 day")) ? 'text-green-500' : '' }}">
                                <th scope="row" class="px-6 py-3 font-medium text-center text-white">
                                    <span 
                                        data-id="{{ $ticket->id }}" 
                                        data-ticket_no="{{ $ticket->ticket_no }}" 
                                        data-is_SAP="{{ $ticket->is_SAP }}" 
                                        data-user_id="{{ $ticket->user_id }}" 
                                        data-user="{{ $ticket->requestor->name }}" 
                                        data-dept="{{ $ticket->departmentRow->name }}" 
                                        data-date="{{ date("M d, Y h:i A", strtotime($ticket->created_at)) }}" 
                                        data-subject="{{ $ticket->subject }}" 
                                        data-desc="{{ $ticket->description }}" 
                                        data-status="{{ $status }}" 
                                        data-src="{{ $ticket->attachment }}" 
                                        data-resolution_attachment="{{ $ticket->resolution_attachment }}" 
                                        data-reso="{{ $ticket->resolution }}" 
                                        data-update="{{ $ticket->update }}">
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
                                    {{ $ticket->category['name'] }}
                                </td>
                                <td class="max-w-xs px-6 py-3 overflow-hidden text-center whitespace-nowrap">
                                    {{ $ticket->subject }}
                                </td>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    <span class="
                                        @php
                                            if($status == 'PENDING'){
                                                $currentDateTime = new DateTime();
                                                echo 'text-red-500';
                                            }elseif($status == 'ONGOING'){
                                                $currentDateTime = new DateTime();
                                                echo 'text-amber-300';
                                            }elseif($status == 'DONE'){
                                                $currentDateTime = new DateTime($ticket->end_date_time);
                                                echo 'text-teal-500';
                                            }elseif($status == 'CANCELLED'){
                                                echo 'text-neutral-300';
                                            }
                                            $createdDateTime = new DateTime($ticket->created_at);
                                            $interval = $createdDateTime->diff($currentDateTime);
                                            $months = $interval->m;
                                            $days = $interval->d;
                                            $hours = $interval->h;
                                            $minutes = $interval->i;
                                        @endphp
                                    ">
                                        @php
                                            echo $status;
                                        @endphp
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    {{ date("M d, Y h:i A", strtotime($ticket->created_at)) }}
                                </td>
                                @if (auth()->user()->dept_id == $deptInCharge)
                                    <td class="px-6 py-3 text-center whitespace-nowrap">
                                        @if ($status == 'ONGOING' || $status == 'PENDING' || $status == 'DONE')
                                            @php
                                                $labelMonth = ' Months ';
                                                $labelDay = ' Days ';
                                                $labelHour = ' Hours ';
                                                $labelMinutes = ' Minutes ';
                                                if($months == 1){
                                                    $labelMonth = ' Month ';
                                                }
                                                if ($days == 1) {
                                                    $labelDay = ' Day ';
                                                }
                                                if ($hours == 1) {
                                                    $labelHour = ' Hour ';
                                                }
                                                if ($minutes == 1) {
                                                    $labelMinutes = ' Minute ';
                                                }
                                            @endphp
                                            @if ($months != 0)
                                                {{ $months . $labelMonth . $days . $labelDay . $hours . $labelHour . $minutes . $labelMinutes }}
                                            @elseif ($days != 0)
                                                {{ $days . $labelDay . $hours . $labelHour . $minutes . $labelMinutes }}
                                            @elseif($hours != 0)
                                                {{ $hours . $labelHour . $minutes . $labelMinutes }}
                                            @else
                                                {{ $minutes . $labelMinutes }}
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    {{ $ticket->assigned['name'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- TABLE --}}
    </div>

  <script>
    $(document).ready(function(){
        var myID = {{ auth()->user()->id }};
        var myDept = {{ auth()->user()->dept_id }};
        var deptInCharge = {{ $deptInCharge }};
        var resolution_attachment = '';
        var resolution_file_extension = '';
        
        // Reload Page
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
        // Reload Page


        // Ticket Search
            $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#ticketTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        // Ticket Search

        // Update Ticket Button
            if($('#ticketButton').length){
                $('#ticketButton').click(function(){
                    $('#loadingScreen').html(`<div wire:loading class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-800 opacity-75">
                        <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
                        <h2 class="text-xl font-semibold text-center text-white">Processing...</h2>
                        <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
                    </div>`);
                });
            }
        // Update Ticket Button

        $('#ticketTableBody tr').click(function() {
            // Ticket Variables
                var id = $(this).find("span").data('id');
                var user_id = $(this).find("span").data('user_id');
                var ticket_no = $(this).find("span").data('ticket_no');
                var req = $(this).find("span").data('user');
                var dept = $(this).find("span").data('dept');
                var date = $(this).find("span").data('date');
                var subject = $(this).find("span").data('subject');
                var desc = $(this).find("span").data('desc');
                var status = $(this).find("span").data('status');
                var update = $(this).find("span").data('update');
                var src = $(this).find("span").data('src');
                resolution_attachment = $(this).find("span").data('resolution_attachment');
                var reso = $(this).find("span").data('reso');
                var is_SAP = $(this).find("span").data('is_sap');
            // Ticket Variables

            // Modal Display
                $('#ticketID').val(id);
                $('#ticketNumber').html(ticket_no); 
                $('.aticketNumber').html(ticket_no);
                $('#sticketNumber').html(ticket_no);
                $('#ticketRequester').html(req);
                $('#ticketDepartment').html(dept);
                $('#ticketDate').html(date);
                $('#ticketSubject').html(subject);
                $('#ticketDesc').html(desc);
                $('#ticketStatus').val(status);
                $('#ticketStatus2').html(status);
            // Modal Display
            
            // Attachment
                if(src != ""){
                    var nsrc = `{{ asset('${src}') }}`;
                    $('#ticketAttachment').prop('src', nsrc);
                    $('#AttachedFileButton').removeClass('hidden');
                }else{
                    $('#AttachedFileButton').addClass('hidden');
                }
                
                if(resolution_attachment != ""){
                    var raSrc = `{{ asset('${resolution_attachment}') }}`;
                    resolution_file_extension = raSrc.split('.').pop();
                    if(resolution_file_extension == "jpg" || resolution_file_extension == "jpeg" || resolution_file_extension == "png"){
                        $('#ticketResolutionAttachment').prop('src', raSrc);
                        $('#ResolutionAttachedFileDownload').addClass('hidden');
                        $('#ResolutionAttachedFileButton').removeClass('hidden');
                    }else{
                        $('#ResolutionAttachedFileDownload').prop('href', raSrc);
                        $('#ResolutionAttachedFileDownload').removeClass('hidden');
                        $('#ResolutionAttachedFileButton').addClass('hidden');
                    }
                }else{
                    $('#ResolutionAttachedFileButton').addClass('hidden');
                    $('#ResolutionAttachedFileDownload').addClass('hidden');
                }
            // Attachment
            

            if(status == 'PENDING'){
                // DIVS 
                    // Update
                        $('#ticketUpdateTextArea').val('');
                        $('#ticketUpdateDiv').addClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolutionDiv').addClass('hidden');
                    // Resolution
                // DIVS

                // INPUTS
                    // Update
                        $('#ticketUpdateInputDiv').addClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolutionInputDiv').addClass('hidden');
                    // Resolution
                // INPUTS

                // BUTTONS
                    if($('#ticketButton').length){
                        $('#ticketButton').removeClass('hidden');
                        $('#ticketButton').html('Mark as ONGOING');
                    }
                    $('#cancelButtonDiv').removeClass('hidden');
                // BUTTONS

                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-red-500');
                $('#ticketStatus2').removeClass('text-neutral-300');
            }else if(status == 'ONGOING'){
                // DIVS 
                    // Update
                        $('#ticketUpdateTextArea').val(update);
                        $('#ticketUpdateDiv').removeClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolution').val(reso);
                        $('#ticketResolutionDiv').addClass('hidden');
                    // Resolution
                // DIVS

                // INPUTS
                    if(myID == user_id || myDept == deptInCharge){
                        $('#ticketUpdateInputDiv').removeClass('hidden');
                    }else{
                        $('#ticketUpdateInputDiv').addClass('hidden');
                    }
                    // Resolution
                        $('#ticketResolutionInputDiv').removeClass('hidden');
                    // Resolution
                // INPUTS

                // BUTTONS
                    if($('#ticketButton').length){
                        $('#ticketButton').removeClass('hidden');
                        $('#ticketButton').html('Mark as DONE');
                    }
                    $('#cancelButtonDiv').removeClass('hidden');
                // BUTTONS
                
                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-neutral-300');
            }else if(status == 'DONE'){
                // DIVS 
                    // Update
                        $('#ticketUpdateTextArea').val(update);
                        $('#ticketUpdateDiv').removeClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolution').val(reso);
                        $('#ticketResolutionDiv').removeClass('hidden');
                    // Resolution
                // DIVS

                // INPUTS
                    // Update
                        $('#ticketUpdateInputDiv').addClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolutionInputDiv').addClass('hidden');
                    // Resolution
                // INPUTS

                // BUTTONS
                    if($('#ticketButton').length){
                        $('#ticketButton').addClass('hidden');
                    }
                    $('#cancelButtonDiv').addClass('hidden');
                // BUTTONS

                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').addClass('text-teal-500');
                $('#ticketStatus2').removeClass('text-neutral-300');
            }else if(status == 'CANCELLED'){
                // DIVS 
                    // Update
                        $('#ticketUpdateTextArea').val(update);
                        $('#ticketUpdateDiv').removeClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolution').val(reso);
                        $('#ticketResolutionDiv').addClass('hidden');
                    // Resolution
                // DIVS

                // INPUTS
                    // Update
                        $('#ticketUpdateInputDiv').addClass('hidden');
                    // Update
                    // Resolution
                        $('#ticketResolutionInputDiv').addClass('hidden');
                    // Resolution
                // INPUTS

                // BUTTONS
                    if($('#ticketButton').length){
                        $('#ticketButton').addClass('hidden');
                    }
                    $('#cancelButtonDiv').addClass('hidden');
                // BUTTONS

                $('#ticketStatus2').removeClass('text-red-500');
                $('#ticketStatus2').removeClass('text-amber-300');
                $('#ticketStatus2').removeClass('text-teal-500');
                $('#ticketStatus2').addClass('text-neutral-300');
            }
            
            // SAP
                if(is_SAP != "0"){
                    $('#SAPButton').removeClass('hidden');
                }else{
                    $('#SAPButton').addClass('hidden');
                }
            // SAP

            $('meta[http-equiv="refresh"]').attr('content', '');
            $('#viewTicket').click();

            // Auto Height Textarea
                var UpdateDivAutoHeight = $('.UpdateDivAutoHeight');
                UpdateDivAutoHeight.css('height', 'auto');
                UpdateDivAutoHeight.css('height', UpdateDivAutoHeight.prop('scrollHeight') + 'px');
                
                var ResolutionAutoHeight = $('.ResolutionAutoHeight');
                ResolutionAutoHeight.css('height', 'auto');
                ResolutionAutoHeight.css('height', ResolutionAutoHeight.prop('scrollHeight') + 'px');
            // Auto Height Textarea
        });

        // View SAP
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
        // View SAP

        jQuery(document).on( "click", "#cancelButton", function(){
            $('#loadingScreen').html(`<div wire:loading class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-800 opacity-75">
                <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
                <h2 class="text-xl font-semibold text-center text-white">Processing...</h2>
                <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
            </div>`);
            $('#isCancel').val('1');
            $('#isUpdate').val('0');
            $('#statusUpdateForm').submit();
        });

        jQuery(document).on( "click", "#updateButton", function(){
            $('#loadingScreen').html(`<div wire:loading class="fixed top-0 bottom-0 left-0 right-0 z-50 flex flex-col items-center justify-center w-full h-screen overflow-hidden bg-gray-800 opacity-75">
                <div class="w-12 h-12 mb-4 ease-linear border-4 border-t-4 border-gray-200 rounded-full loader"></div>
                <h2 class="text-xl font-semibold text-center text-white">Processing...</h2>
                <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
            </div>`);
            $('#isUpdate').val('1');
            $('#isCancel').val('0');
            $('#statusUpdateForm').submit();
        });

        $('#ResolutionAttachedFileButton').click(function(){
            console.log(resolution_file_extension);
            if(resolution_file_extension == "jpg" || resolution_file_extension == "jpeg" || resolution_file_extension == "png"){
                $('#OpenResolutionAttachedFileModal').click();
            }
        });
    });
  </script>
</x-app-layout>

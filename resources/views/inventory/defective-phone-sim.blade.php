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

    {{-- DEFECTIVE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="defectiveConfirmation" data-modal-target="defectiveModal" data-modal-toggle="defectiveModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
        
        <!-- Main modal -->
        <div id="defectiveModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('defectivePhone.restore') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
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
                            Are you sure you want to restore this item?
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
                            Are you sure you want to permanently delete this item?
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
        <div id="itemModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-4xl md:h-auto">
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
                            <div>Description: </div>
                            <div id="desc" class="col-span-4 font-semibold"></div>
                            <div>Serial Number: </div>
                            <div id="serial_no" class="col-span-4 font-semibold"></div>
                            <div>Status: </div>
                            <div id="status" class="col-span-4 font-semibold"></div>
                            <div>Site: </div>
                            <div id="site" class="col-span-4 font-semibold"></div>
                            <div>Date Delivered: </div>
                            <div id="date_del" class="col-span-4 font-semibold"></div>
                            {{-- <div id="invoiceLabel" class="self-center">Invoice</div>
                            <div id="invoiceForm" class="col-span-4 font-semibold">
                                <button type="button" data-modal-toggle="viewInvoice" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">View</button>
                                <a id="invoiceDownloadButton" href="" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-1.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Download</a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t rounded-b border-gray-600">
                        <button id="btnDefective" data-modal-toggle="itemModal" type="button" class="tracking-wider mr-3 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-emerald-800 text-gray-100 border-emerald-700 hover:text-white hover:bg-emerald-700 focus:ring-emerald-700">Restore</button>
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
        <h1 class="mb-1 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">DEFECTIVE PHONE / SIM CARD</h1>

        {{-- CONTROLS --}}
        <div class="mb-0 h-10">
            <div class="flex gap-x-3 h-8">
                <div class="flex items-center w-1/3">
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
        <div style="max-height: calc(100% - 126px);" class="overflow-x-auto relative shadow-md rounded-t-lg">
            <table class="min-w-full text-sm text-left text-gray-400">
                <thead class="relative top-0 text-xs uppercase bg-gray-600 text-gray-400 border-x-8 border-gray-600">
                    <tr class="bg-gray-600 sticky top-0">
                        <th id="thl" scope="col" class="sticky top-0 py-2 text-center">
                            #
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            ITEM
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            USER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DESCRIPTION
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            SERIAL NUMBER
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
                            DATE DELIVERED
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
                            <th scope="row" class="py-3 px-6 font-medium text-white text-center">
                                <span data-id="{{ $item->id }}" data-item="{{ $item->item }}" data-user="{{ $item->user }}" data-desc="{{ $item->desc }}" data-serial_no="{{ $item->serial_no }}" data-remarks="{{ $item->remarks }}" data-site="{{ $item->site_name }}" data-status="{{ $item->status }}" data-date_del="{{ $item->date_del }}">
                                    {{ $x++ }}
                                </span>
                            </th>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->item }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $item->user }}
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
                                {{ $item->date_del }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{-- <a href="{{ url('/inventory/phone-sim/edit/'.$item->id ) }}" class="editButton font-medium text-blue-500 hover:underline">Edit</a> |  --}}
                                <a type="button" data-id="{{ $item->id }}" data-desc="{{ $item->desc }}" data-serial_no="{{ $item->serial_no }}" class="deleteButton font-medium text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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

                var item = $(this).find("span").data('item');
                $('#item').html(item);
                $('#item2').html(item);

                var desc = $(this).find("span").data('desc');
                $('#desc').html(desc);

                var serial_no = $(this).find("span").data('serial_no');
                $('#serial_no').html(serial_no);

                var site = $(this).find("span").data('site');
                $('#site').html(site);

                var status = $(this).find("span").data('status');
                $('#status').html(status);

                var date_del = $(this).find("span").data('date_del');
                $('#date_del').html(date_del);

                // var invoice = $(this).find("span").data('invoice');
                // var path = `{{ asset('storage/${invoice}') }}`;
                // $('#itemInvoice').prop('src', path);

                // var src = `{{ url('/inventory/phone-sim/invoice-download/${id}') }}`;
                // $('#invoiceDownloadButton').prop('href', src);

                $('#viewItem').click();
            });

            $('#btnDefective').click(function(){
                var id = $('#itemID').val();
                $('#defectiveID').val(id);

                $('#defectiveConfirmation').click();
            });
        });
    </script>
</x-app-layout>
 
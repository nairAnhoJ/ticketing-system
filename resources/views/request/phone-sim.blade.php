<x-app-layout>
    @section('title')
    Phone SIM Request
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

    <!-- Modal toggle -->
    <button id="deleteConfirmation" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
    
    <!-- Main modal -->
    <div id="deleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <form action="{{ route('reqPhoneSim.delete') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
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
                    <p class="text-base leading-relaxed text-gray-400">
                        Are you sure you want to delete the request with PR Number of <span id="deletePRN"></span>?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                    <button data-modal-hide="deleteModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                    <button data-modal-hide="deleteModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
        <h1 class="mb-1 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">PHONE SIM REQUEST</h1>

        <!-- ========================================================= Modal toggle ========================================================= -->
        <button id="viewReq" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="itemModal">
        </button>
        
        <!-- ========================================================= Main modal ========================================================= -->
        <div id="itemModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-4xl md:h-auto">
                <!-- Modal content -->
                <form enctype="multipart/form-data" action="{{ route('reqPhoneSim.statusUpdate') }}" method="POST" class="relative rounded-lg shadow bg-gray-700 text-sm">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-2xl font-semibold text-white leading-5 tracking-wide">
                            @csrf
                            <input type="hidden" id="reqID" name="reqID">
                            <span id="PRNumber"></span>
                            <br>
                            <span id="req_by" class="text-sm"></span><span class="text-sm mx-2">|</span><span id="status" class="text-sm"></span>
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="itemModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4">
                        <div class="grid grid-cols-5 gap-y-3">
                            <div>Item: </div>
                            <div id="item" class="col-span-4 font-semibold"></div>
                            <div>Description: </div>
                            <div id="desc" class="col-span-4 font-semibold"></div>
                            <div>Remarks: </div>
                            <div id="remarks" class="col-span-4 font-semibold"></div>
                            <div>Site: </div>
                            <div id="site" class="col-span-4 font-semibold"></div>
                            <div>Date Requested: </div>
                            <div id="date_requested" class="col-span-4 font-semibold"></div>
                            <div>Date Delivered: </div>
                            <div id="date_delivered" class="col-span-4 font-semibold"></div>
                            <div id="updateStatusLabel" class="self-center">Update Status: </div>
                            <div id="updateStatusDiv" class="col-span-4 font-semibold">
                                <select id="updateStatus" name="updateStatus" class="disabled:opacity-50 disabled:pointer-events-none tracking-wider border text-sm rounded-lg block px-2.5 py-2 w-40 h-full bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                    <option selected value="REQUESTED">REQUESTED</option>
                                    <option value="DELIVERED">DELIVERED</option>
                                    <option value="DECLINED">DECLINED</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-3 border-t rounded-b border-gray-600">
                        <div id="updateButtonDiv"></div>
                        <button data-modal-toggle="itemModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Close</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- CONTROLS --}}
        <div class="grid grid-cols-2 mb-0 h-10">
            <div class="h-8">
                <a href="{{ route('reqPhoneSim.add') }}" type="button" class="h-full text-white focus:ring-4 font-medium rounded-lg text-sm px-10 pt-2 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">New Item Request</a>
            </div>
            <div class="flex gap-x-3 h-8">
                <div class="w-1/3">
                </div>
                <div class="flex items-center w-2/3">
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
                            PR NUMBER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            ITEM
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DESCRIPTION
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            REMARKS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            REQUESTER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            SITE
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            STATUS
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DATE REQUESTED
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            DATE DELIVERED
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center whitespace-nowrap">
                            ACTION
                        </th>
                    </tr>
                </thead>
                <tbody id="itemReqTableBody" style="max-height: calc(100% - 126px);">
                    @php
                        $x = 1;
                    @endphp
                    @foreach ($reqs as $req)
                        <tr class="bg-gray-800 border-gray-700 hover:bg-gray-700 cursor-pointer">
                            <th scope="row" class="py-3 px-6 font-medium text-white text-center">
                                <span data-id="{{ $req->id }}" data-pr_no="{{ $req->pr_no }}" data-item="{{ $req->item }}" data-desc="{{ $req->description }}" data-remarks="{{ $req->remarks }}" data-req_by="{{ $req->req_by }}" data-site="{{ $req->site }}" data-status="{{ $req->status }}" data-date_req="{{ $req->date_req }}" data-date_del="{{ $req->date_del }}">
                                    {{ $req->pr_no }}
                                </span>
                            </th>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->item }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->description }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->remarks }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->req_by }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->site }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <span class="
                                    @php
                                        $status = $req->status;
                                        if($status == 'DECLINED'){
                                            echo 'text-red-500';
                                        }elseif($status == 'REQUESTED'){
                                            echo 'text-amber-300';
                                        }elseif($status == 'DELIVERED'){
                                            echo 'text-teal-500';
                                        }
                                    @endphp
                                ">
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->date_req }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                {{ $req->date_del }}
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                @if ($status == 'REQUESTED')
                                    <a href="{{ url('/request/phone-sim/edit/'.$req->id ) }}" class="editButton font-medium text-blue-500 hover:underline">Edit</a> | <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-id="{{ $req->id }}" data-pr_no="{{ $req->pr_no }}"  class="deleteButton font-medium text-red-500 hover:underline">Delete</button>
                                @endif
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
                    $("#itemReqTableBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('.editButton').click(function(e){
                e.stopPropagation();
            });

            $('.deleteButton').click(function(e){
                var id = $(this).data('id');
                var deletePRN = $(this).data('pr_no');
                $('#deleteID').val(id);
                $('#deletePRN').html(deletePRN);
                e.stopPropagation();
            });

            $('#itemReqTableBody tr').click(function() {
                var id = $(this).find("span").data('id');
                $('#reqID').val(id);

                var pr_no = $(this).find("span").data('pr_no');
                $('#PRNumber').html(pr_no);

                var item = $(this).find("span").data('item');
                $('#item').html(item);

                var desc = $(this).find("span").data('desc');
                $('#desc').html(desc);

                var remarks = $(this).find("span").data('remarks');
                $('#remarks').html(remarks);

                var req_by = $(this).find("span").data('req_by');
                $('#req_by').html(req_by);

                var site = $(this).find("span").data('site');
                $('#site').html(site);

                var status = $(this).find("span").data('status');
                $('#status').html(status);
                $('#updateStatus').val(status);

                if(status == 'DECLINED'){
                    $('#status').removeClass('text-amber-300');
                    $('#status').removeClass('text-teal-500');
                    $('#status').addClass('text-red-500');
                    $('#updateButtonDiv').html(``);
                    $('#updateStatus').prop('disabled', true);
                    $('#updateStatusLabel').addClass('opacity-50');
                }else if(status == 'REQUESTED'){
                    $('#status').removeClass('text-red-500');
                    $('#status').removeClass('text-teal-500');
                    $('#status').addClass('text-amber-300');
                    $('#updateButtonDiv').html(`<button disabled data-modal-toggle="itemModal" type="submit" id="updateButton" class="disabled:opacity-50 disabled:pointer-events-none text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 mr-3 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Update</button>`);
                    $('#updateStatus').prop('disabled', false);
                    $('#updateStatusLabel').removeClass('opacity-50');
                }else if(status == 'DELIVERED'){
                    $('#status').removeClass('text-red-500');
                    $('#status').removeClass('text-amber-300');
                    $('#status').addClass('text-teal-500');
                    $('#updateButtonDiv').html(``);
                    $('#updateStatus').prop('disabled', true);
                    $('#updateStatusLabel').addClass('opacity-50');
                }

                var date_requested = $(this).find("span").data('date_req');
                $('#date_requested').html(date_requested);

                var date_delivered = $(this).find("span").data('date_del');
                $('#date_delivered').html(date_delivered);

                $('#viewReq').click();
            });

            jQuery(document).on("change", "#updateStatus", function(){
                var status = $(this).val();
                if(status == 'DECLINED'){
                    $('#updateButton').prop('disabled', false);
                }else if(status == 'REQUESTED'){
                    $('#updateButton').prop('disabled', true);
                }else if(status == 'DELIVERED'){
                    $('#updateButton').prop('disabled', false);
                }
            });
        });
    </script>
</x-app-layout>

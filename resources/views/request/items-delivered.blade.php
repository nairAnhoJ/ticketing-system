<x-app-layout>
    @section('title')
    Item Request
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

    {{-- NOTIFICATION --}}
    <div id="notifDiv" class="absolute left-1/2 -translate-x-1/2 pt-6">
    </div>

    
    <!-- Modal toggle -->
    <button id="backOrderConfirmation" data-modal-target="backOrderModal" data-modal-toggle="backOrderModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
    
    <!-- Main modal -->
    <div id="backOrderModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                    <h3 class="text-xl font-semibold text-yellow-300">
                        Warning
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="backOrderModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-6 py-4 space-y-6">
                    <p class="text-base leading-relaxed text-gray-400">
                        Are you sure you only recieved  <span id="snCount"></span> item/s instead of {{ $req[0]->quantity }}?
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                    <button id="BackOrderConfirm" data-modal-hide="backOrderModal" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                    <button data-modal-hide="backOrderModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        </div>
    </div>
  

    <div style="height: calc(100vh - 65px);" class="py-10 px-60 text-gray-200 w-screen overflow-x-auto">
        <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">ITEM REQUEST</h1>
        <form action="{{ route('reqItem.statusDelivered') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="reqID" value="{{ $id }}">

            <div class="mt-3">
                <input type="hidden" name="type_id" value="{{ $req[0]->type_id }}">
                <label class="block text-sm font-normal text-white">Item Type</label>
                <h1 class="ml-3 font-semibold text-lg">{{ $req[0]->type }}</h1>
            </div>

            <div class="mt-3">
                <input type="hidden" name="brand" value="{{ $req[0]->brand }}">
                <input type="hidden" name="description" value="{{ $req[0]->description }}">
                <label class="block text-sm font-normal text-white">Description</label>
                <h1 class="ml-3 font-semibold text-lg">{{ $req[0]->brand.' '.$req[0]->description }}</h1>
            </div>

            <div class="mt-3">
                <input type="hidden" id="quantity" name="quantity" value="{{ $req[0]->quantity }}">
                <label class="block text-sm font-normal text-white">Quantity</label>
                <h1 class="ml-3 font-semibold text-lg">{{ $req[0]->quantity }}</h1>
            </div>

            <div class="mt-3">
                <label for="type" class="block text-sm font-medium text-white">Serial Number
                    @if ($req[0]->quantity > 1)
                        <span class="text-xs ml-3 text-gray-400 tracking-wide">*Please use semicolon(;) to separate the Serial Numbers</span>
                    @endif
                </label>
                <input required type="text" autocomplete="off" value="{{ old('serial_no') }}" id="serial_no" name="serial_no" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-3">
                <label for="date_del" class="block text-sm font-medium text-white">Date Delivered</label>
                <div class="relative">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" id="date_del" name="date_del" value="{{ date('m/d/Y') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-white" for="invoice">Invoice</label>
                <input required class="block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400" id="invoice" name="invoice" type="file" accept="image/png, image/jpeg">
            </div>

            <div class="mt-5">
                <button id="submitConfirmed" type="submit" class="hidden w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800"></button>
                <button id="submitButton" type="button" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('reqItem.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#submitButton').on('click', function(){
                var quantity = $('#quantity').val();
                var sn = $('#serial_no').val();
                var nssn = sn.replace(/ /g,'');
                var nsn = nssn.split(";");
                var nnsn = nsn.filter(function(value) {
                    return value !== "" && value !== null;
                });
                console.log(quantity);
                console.log(nnsn);
                if(nnsn.length > quantity){
                    $('#notifDiv').html(`<div id="errorNotif" class="flex items-center w-80 max-w-sm p-4 mb-4 rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                                            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-red-800 text-red-200">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Error icon</span>
                                            </div>
                                            <div class="ml-3 text-sm font-normal text-red-400 tracking-wide">Invalid Serial Numbers.</div>
                                            <button id="closeNotif" type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                                                <span class="sr-only">Close</span>
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </div>`);
                }else if(nnsn.length < quantity){
                    $('#snCount').html(nnsn.length);
                    $('#backOrderConfirmation').click();
                }else{
                    $('#submitConfirmed').click();
                }
            });

            jQuery(document).on("click", "#closeNotif", function(){
                $('#errorNotif').addClass('hidden');
            });

            jQuery(document).on("click", "#BackOrderConfirm", function(){
                $('#submitConfirmed').click();
            });
        });
    </script>
</x-app-layout>

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

    <div style="height: calc(100vh - 65px);" class="py-10 px-80 text-gray-200 w-screen overflow-x-auto">
        <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">ITEM REQUEST</h1>
        <form action="{{ $Action == 'add' ? route('reqItem.store') : route('reqItem.update'); }}" method="POST">
            @csrf
            <input type="hidden" name="itemID" value="{{ $ItemID }}">

            <div class="mt-2">
                <label for="pr_no" class="block text-sm font-medium text-white">PR Number</label>
                <input required type="text" value="{{ $PRNo }}" id="pr_no" name="pr_no" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <label for="type" class="mt-5 block text-sm font-medium text-white">Select Item Type <span class="text-xs ml-3 text-gray-400">*if storage, please specify in the description below.</span></label>
            <select required id="type" name="type" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                @foreach ($types as $type)
                    <option {{ $ItemType == $type->id ? 'selected' : ''; }} value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            <div class="mt-5">
                <label for="brand" class="block text-sm font-medium text-white">Brand</label>
                <input required type="text" autocomplete="off" value="{{ $Brand }}" id="brand" name="brand" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <input required type="text" value="{{ $Description }}" id="description" name="description" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="remarks" class="block text-sm font-medium text-white">Remarks</label>
                <input required type="text" value="{{ $Remarks }}" id="remarks" name="remarks" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="quantity" class="block text-sm font-medium text-white">Quantity</label>
                <input required type="text" value="{{ $Quantity }}" id="quantity" name="quantity" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="req_by" class="block text-sm font-medium text-white">Requested By</label>
                <input required type="text" value="{{ $Req_by }}" id="req_by" name="req_by" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <label for="site" class="mt-5 block text-sm font-medium text-white">Branch / Site</label>
            <select required id="site" name="site" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                @foreach ($sites as $site)
                    <option {{ $Site == $site->id ? 'selected' : ''; }} value="{{ $site->id }}">{{ $site->name }}</option>
                @endforeach
            </select>

            <label for="status" class="{{ $Action == 'edit' ? 'opacity-50' : ''; }} mt-5 block text-sm font-medium text-white">Status</label>
            <select {{ $Action == 'edit' ? 'disabled' : ''; }} required id="status" name="status" class="disabled:opacity-50 disabled:pointer-events-none border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                <option value="REQUESTED">Requested</option>
                <option value="DELIVERED">Delivered</option>
                <option value="DECLINED">Declined</option>
            </select>

            <div class="mt-5">
                <label for="date_req" class="block text-sm font-medium text-white">Date Requested</label>
                <div class="relative">

                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" id="date_req" name="date_req" value="{{ $DateRequested }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="date_del" id="lbl_date_del" class="opacity-50 block text-sm font-medium text-white">Date Delivered</label>
                <div class="relative">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input disabled datepicker datepicker-autohide type="text" id="date_del" name="date_del" value="{{ $DateDelivered }}" class="disabled:opacity-50 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('reqItem.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#quantity').on('keypress', function(key) {
                if(key.charCode < 48 || key.charCode > 57) return false;
            });

            $('#status').on('change', function () {
                var status = $('#status').val();
                if(status == 'REQUESTED'){
                    $('#date_del').prop('disabled',true);
                    $('#lbl_date_del').addClass('opacity-50');
                }else if(status == 'DELIVERED'){
                    $('#date_del').prop('disabled',false);
                    $('#lbl_date_del').removeClass('opacity-50');
                }else if(status == 'DECLINED'){
                    $('#date_del').prop('disabled',true);
                    $('#lbl_date_del').addClass('opacity-50');
                }
            });
        });
    </script>
</x-app-layout>

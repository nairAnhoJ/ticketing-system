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

    <div style="height: calc(100vh - 65px);" class="py-10 px-80 text-gray-200 w-screen overflow-x-auto">
        <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">PHONE / SIM CARD</h1>
        <form action="{{ $Action == 'add' ? route('phoneSim.store') : route('phoneSim.update'); }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="itemID" value="{{ $ItemID }}">

            <label for="item" class="mt-5 block text-sm font-medium text-white">Select Item Type</label>
            <select id="item" name="item" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                <option {{ $Item == 'PHONE' ? 'selected' : ''; }} value="PHONE">Phone</option>
                <option {{ $Item == 'SIM CARD' ? 'selected' : ''; }} value="SIM CARD">SIM Card</option>
            </select>

            <div class="mt-5">
                <label for="user" class="block text-sm font-medium text-white">User</label>
                <input required type="text" value="{{ $User }}" id="user" name="user" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <label for="department" class="mt-5 block text-sm font-medium text-white">Department</label>
            <select id="department" name="department" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                <option value="1">N/A</option>
                @foreach ($departments as $dept)
                    <option {{ $Department == $dept->id ? 'selected' : ''; }} value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>

            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <input required type="text" value="{{ $Description }}" id="description" name="description" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="serial_no" class="block text-sm font-medium text-white">Serial / SIM Card Number</label>
                <input required type="text" value="{{ $SerialNo }}" id="serial_no" name="serial_no" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="cost" class="block text-sm font-medium text-white">Cost (₱)</label>
                <input required type="text" value="{{ $Cost }}" id="cost" name="cost" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="color" class="block text-sm font-medium text-white">Color</label>
                <input required type="text" value="{{ $Color }}" id="color" name="color" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="remarks" class="block text-sm font-medium text-white">Remarks</label>
                <input required type="text" value="{{ $Remarks }}" id="remarks" name="remarks" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="site" class="block text-sm font-medium text-white">Site</label>
                <select required id="site" name="site" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                    @foreach ($sites as $site)
                        <option {{ $Site == $site->id ? 'selected' : ''; }} value="{{ $site->id }}">{{ $site->name }}</option>
                    @endforeach
                </select>
                {{-- <input required type="text" value="{{ $Site }}" id="site" name="site" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white"> --}}
            </div>

            <label for="status" class="mt-5 block text-sm font-medium text-white">Status</label>
            <select id="status" name="status" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                <option {{ $Status == 'NEW' ? 'selected' : ''; }} value="NEW">Brand New</option>
                <option {{ $Status == 'OLD' ? 'selected' : ''; }} value="OLD">Old Unit</option>
            </select>

            {{-- <div class="mt-5">
                <label for="status" class="block text-sm font-medium text-white">Status</label>
                <input required type="text" value="{{ $Status }}" id="status" name="status" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div> --}}

            <div class="mt-5">
                <label for="date_issued" class="block text-sm font-medium text-white">Date Issued</label>
                <div class="relative">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" id="date_issued" name="date_issued" value="{{ $DateIssued == 'N/A' ? '' : date('m-d-Y') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="date_del" class="block text-sm font-medium text-white">Date Delivered</label>
                <div class="relative">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" id="date_del" name="date_del" value="{{ $DateDelivered }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            {{-- <div class="mt-3">
                <label class="block text-sm font-medium text-white" for="invoice">Invoice</label>
                <input {{ $Action == 'add' ? 'required' : ''; }} class="block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400" id="invoice" name="invoice" type="file" accept="image/png, image/jpeg">
            </div> --}}

            <div class="mt-5">
                <button type="submit" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('phoneSim.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>

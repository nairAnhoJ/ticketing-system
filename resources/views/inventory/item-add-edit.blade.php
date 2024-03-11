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

    <div style="height: calc(100vh - 65px);" class="py-10 px-80 text-gray-200 w-screen overflow-x-auto">
        <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">ITEMS</h1>
        <form action="{{ $Action == 'add' ? route('item.store') : route('item.update'); }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="itemID" value="{{ $ItemID }}">

            <label for="type" class="mt-2 block text-sm font-medium text-white">Select Item Type <span class="text-xs ml-3 text-gray-400">*if storage, please specify in the description below.</span></label>
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
                <label for="serial_no" class="block text-sm font-medium text-white">Serial Number</label>
                <input required type="text" value="{{ $SerialNo }}" id="serial_no" name="serial_no" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <input required type="text" value="{{ $Description }}" id="description" name="description" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="date_purchased" class="block text-sm font-medium text-white">Date Delivered</label>
                <div class="relative">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" id="date_purchased" name="date_purchased" value="{{ $DatePurchased }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <label for="invoice" class="block text-sm font-medium text-white">Invoice</label>
                <input required class="block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400" id="invoice" name="invoice" type="file" accept="image/png, image/jpeg">
                {{-- <input {{ $Action == 'add' ? 'required' : ''; }} class="block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400" id="invoice" name="invoice" type="file" accept="image/png, image/jpeg"> --}}
            </div>

            <div class="mt-5">
                <button type="submit" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('item.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>

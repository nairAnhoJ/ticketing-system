<x-app-layout>
    @section('title')
    Items For Disposal
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
    </style>



    {{-- DISPOSE CONFIRMATION MODAL --}}
        <!-- Main modal -->
        <div id="disposeModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('disposal.disposed') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-yellow-300">
                            Warning
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="disposeModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="deleteID" name="deleteID" value="">
                        <p class="text-base leading-relaxed text-white">
                            Are you sure you want to permanently mark as dispose all items here?
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="disposeModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                        <button data-modal-hide="disposeModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- DISPOSE CONFIRMATION MODAL END --}}







    {{-- REMOVE CONFIRMATION MODAL --}}
        <!-- Modal toggle -->
        <button id="deleteConfirmation" data-modal-target="removeModal" data-modal-toggle="removeModal" class="hidden text-white bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-700 focus:ring-blue-800" type="button"></button>
        
        <!-- Main modal -->
        <div id="removeModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <form action="{{ route('disposal.remove') }}" method="POST" enctype="multipart/form-data" class="relative rounded-lg shadow bg-gray-700">
                    @csrf
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-yellow-300">
                            Warning
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="removeModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="px-6 py-4">
                        <input type="hidden" id="removeID" name="removeID" value="">
                        <p class="text-base leading-relaxed text-white">
                            Are you sure you want to remove this from items for disposal?
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                        <button data-modal-hide="removeModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Yes</button>
                        <button data-modal-hide="removeModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    {{-- REMOVE CONFIRMATION MODAL END --}}








    <div class="p-3 text-gray-200 w-screen">
        <div class="grid grid-cols-2 mb-2">
            <div class="flex items-center">
                <h1 class="font-extrabold leading-none text-3xl text-blue-500 tracking-wide">ITEMS FOR DISPOSAL</h1>
            </div>
            <div class="justify-self-end">
                <a href="{{ route('disposal.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-8 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Items For Disposal</a>
            </div>
        </div>
        <div>
            {{-- CONTROLS --}}
                <div class="mb-3">
                    <div class="md:grid md:grid-cols-2">
                        <div class="flex">
                            {{-- <form action="{{ route('disposal.print') }}" method="POST" target='_blank'>
                                @csrf
                                <button type="submit" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2.5 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Print List</button>
                            </form>
                            <a type="button" data-modal-target="disposeModal" data-modal-toggle="disposeModal" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2.5 mr-2 bg-red-600 hover:bg-red-700 focus:outline-none">Dispose All Items</a> --}}
                        </div>
                        <div class="justify-self-end w-full xl:w-4/5">
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
            {{-- CONTROLS END --}}



            {{-- TABLE --}}
                <div class="hidden md:block">
                    <div id="inventoryTable" class="overflow-auto w-full shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Item Code
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                        Serial Number
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="bg-gray-800 border-b border-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-400 whitespace-nowrap">
                                            {{ $item->code }}
                                        </th>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $item->brand.' '.$item->description }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            {{ $item->serial_no }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{-- TABLE END --}}

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
                                    <a href="{{ ($search == '') ? url('/inventory/items/disposed/'.$prev) : url('/inventory/items/disposed/'.$prev.'/'.$search);  }}"  class="{{ ($page == 1) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                                        <i class="uil uil-arrow-left text-2xl"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li>
                                    <p class="block w-20 h-9 leading-9 text-center z-10 text-gray-400 bg-gray-700">Page {{ $page }}</p>
                                </li>
                                <li>
                                    <a href="{{ ($search == '') ? url('/inventory/items/disposed/'.$next) : url('/inventory/items/disposed/'.$next.'/'.$search); }}" class="{{ ($to == $itemCount) ? 'pointer-events-none' : ''; }} block w-9 h-9 pt-0.5 text-center text-gray-400 bg-gray-700 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
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
    </div>

    <script>
        $(document).ready(function(){
            $('#searchButton').click(function(){
                var search = $('#searchInput').val();
                if(search != ""){
                    $('#searchForm').prop('action', `{{ url('/inventory/items/disposed/1/${search}') }}`);
                }else{
                    $('#searchForm').prop('action', `{{ url('/inventory/items/disposed/1') }}`);
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
            $('.notifButton').click(function(){
                $('.notif').addClass('hidden');
            });
            $('.deleteButton').click(function(){
                var slug = $(this).data('slug');
                $('.deleteConfirm').prop('href', `{{ url('/inventory/delete/${slug}') }}`);
            });
            $('.contentDiv').click(function(){
                $('.notif').addClass('hidden');
            });
            $('.navDiv').click(function(){
                $('.notif').addClass('hidden');
            });
            
            $('#navButton').click(function(){
                    $('#topNav').addClass('absolute');
                    $('#topNav').removeClass('sticky');
                    $('#topNav').removeClass('z-50');
                    $('#contentDiv').addClass('pt-14');
                });
            $(document).mouseup(function(e) {
                var container = $(".navDiv");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('#topNav').removeClass('absolute');
                    $('#topNav').addClass('sticky');
                    $('#topNav').addClass('z-50');
                $('#contentDiv').removeClass('pt-14');
                }
            });

            $('.removeButton').click(function(){
                var id = $(this).data('id');
                $('#removeID').val(id);
            });
        });
    </script>
</x-app-layout>

<x-app-layout>
    @section('title')
    Return Items
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

    <div class="p-3 text-gray-200 w-screen">
        <div class="grid grid-cols-2 mb-2">
            <div class="flex items-center">
                <h1 class="font-extrabold leading-none text-3xl text-blue-500 tracking-wide">RETURN ITEMS</h1>
            </div>
            {{-- <div class="justify-self-end">
                <a href="{{ route('defectiveIndex.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2 mr-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Return Item/s</a>
                <a href="{{ route('defectiveIndex.index') }}" class="h-full text-white font-medium rounded-lg text-sm px-10 py-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Defective Items</a>
            </div> --}}
        </div>
        <form id="returnForm" method="POST" action="{{ route('return.update') }}" class="mt-10">
            <div class="grid grid-cols-8 gap-x-10 content-center">
                @csrf
                <input type="hidden" id="count" name="count" value="1">

                <div class="flex items-center">
                    <span>Name:</span>
                </div>
                <div class="col-span-3">
                    <div>
                        <input type="text" id="name" name="name" class="block w-full p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <span>Department:</span>
                </div>
                <div class="col-span-3">
                    <div>
                        <select id="dept" name="dept" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center mt-4">
                    <span>Location:</span>
                </div>
                <div class="col-span-3 mt-4">
                    <div>
                        <select id="site" name="site" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center mt-4">
                    <span>Date Returned:</span>
                </div>
                <div class="col-span-3 mt-4">
                    <div class="relative">
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" id="date_returned" name="date_returned" value="{{ date('m-d-Y') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-7 px-5">
                <h1 class="font-bold text-2xl tracking-wider text-gray-200">ITEMS</h1>
                <div class="flex items-center">
                    <button type="button" id="addItem" data-max="{{ $itemCount }}"><i class="uil uil-plus-circle text-blue-500 text-4xl"></i></button><span class="text-sm ml-0.5">Add Item</span>
                </div>
            </div>

            <div id="itemDiv" class="px-5 grid grid-cols-3 gap-x-5">
                <div class="flex flex-col relative optionDiv my-3">
                    <label for="item1" class="block text-sm font-semibold text-white">ITEM 1 <span class="text-red-500">*</span></label>
                    <input type="text" id="item1" class="inputOption block w-full p-2.5 text-white border border-gray-600 rounded-lg bg-gray-700 sm:text-sm" required autocomplete="off">
                    <input type="hidden" id="inputitem1" name="item1" class="inputitem">
                    <div class="listOption hidden absolute top-[62px] w-full rounded-lg border-x border-b border-gray-600 overflow-y-auto max-h-[30vh] bg-gray-700 text-white z-[99] shadow-xl">
                        <ul>
                            @foreach ($items as $item)
                                <li data-id="{{ $item->id }}" class="p-2 first:border-0 border-t border-gray-600 hover:bg-gray-600 cursor-pointer">{{ $item->code.' - '.$item->brand.' '.$item->description }}</li>
                            @endforeach
                            @foreach ($phones as $phone)
                                <li data-id="PHONE{{ $phone->id }}" class="p-2 first:border-0 border-t border-gray-600 hover:bg-gray-600 cursor-pointer">{{ $phone->serial_no }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>





                {{-- <div class="mt-3">
                    <label for="item1" class="block text-sm font-medium text-white">ITEM 1</label>
                    <select id="item1" name="item1" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->code.' - '.$item->brand.' '.$item->description }}</option>
                        @endforeach
                        @foreach ($phones as $phone)
                            <option value="PHONE{{ $phone->id }}">{{ $phone->serial_no }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mt-3 col-span-2">
                    <label for="remarks1" class="block text-sm font-medium text-white">Remarks</label>
                    <input type="text" id="remarks1" name="remarks1" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="mt-3 px-5">
                <button id="printButton" type="button" class="w-32 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Print</button>
                <button id="saveButton" type="button" class="w-32 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 ml-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Save & Exit</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            var counter = 2;
            $('#addItem').click(function(){
                var max = $(this).data('max');
                if(counter <= max){
                    $('#itemDiv').append(`

                        <div class="flex flex-col relative optionDiv my-3">
                            <label for="item${counter}" class="block text-sm font-semibold text-white">ITEM ${counter}</label>
                            <input type="text" id="item${counter}" class="inputOption block w-full p-2.5 text-white border border-gray-600 rounded-lg bg-gray-700 sm:text-sm" required autocomplete="off">
                            <input type="hidden" id="inputitem${counter}" name="item${counter}" class="inputitem">
                            <div class="listOption hidden absolute top-[62px] w-full rounded-lg border-x border-b border-gray-600 overflow-y-auto max-h-[30vh] bg-gray-700 text-white z-[99] shadow-xl">
                                <ul>
                                    @foreach ($items as $item)
                                        <li data-id="{{ $item->id }}" class="p-2 first:border-0 border-t border-gray-600 hover:bg-gray-600 cursor-pointer">{{ $item->code.' - '.$item->brand.' '.$item->description }}</li>
                                    @endforeach
                                    @foreach ($phones as $phone)
                                        <li data-id="PHONE{{ $phone->id }}" class="p-2 first:border-0 border-t border-gray-600 hover:bg-gray-600 cursor-pointer">{{ $phone->serial_no }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mt-3 col-span-2">
                            <label for="remarks${counter}" class="block text-sm font-medium text-white">Remarks</label>
                            <input type="text" id="remarks${counter}" name="remarks${counter}" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    `);
                    $('#count').val(counter++);
                }
            });













            jQuery(document).on( "click", ".inputOption", function(e){
                $('.content').not($(this).closest('.optionDiv').find('.listOption')).addClass('hidden');
                $(this).closest('.optionDiv').find('.listOption').toggleClass('hidden');
                var value = $(this).val().toLowerCase();
                searchFilter(value);
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }
            
            jQuery(document).on( "keydown", ".inputOption", function(e){
                var value = $(this).val().toLowerCase();
                searchFilter(value);

                if (event.keyCode === 9) {
                    $('.listOption').addClass('hidden');
                }
            });

            jQuery(document).on( "click", ".listOption li", function(){
                var name = $(this).html();
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $(this).closest('.optionDiv').find('.inputOption').val(name);
                $(this).closest('.optionDiv').find('.inputitem').val(id);
                // $(this).closest('.inputitem').val(id);
                $('.listOption').addClass('hidden');
            });














            $('#printButton').click(function(){
                $('#returnForm').prop('action', `{{ route('return.print') }}`);
                $('#returnForm').prop('target', '_blank');
                $('#returnForm').submit();
            });

            $('#saveButton').click(function(){
                $('#returnForm').prop('action', `{{ route('return.update') }}`);
                $('#returnForm').submit();
            });
        });
    </script>
</x-app-layout>

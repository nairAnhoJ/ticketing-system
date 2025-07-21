<x-app-layout>
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
    </style>

    <div style="height: calc(100vh - 65px);" class="w-screen py-10 overflow-x-auto text-gray-200 px-80">
        <h1 class="mb-3 text-3xl font-extrabold leading-none tracking-wide text-blue-500">CREATE NEW TICKET</h1>
        <form action="{{ route('ticket.storeForIT') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nature" class="block text-sm font-medium text-white">Nature of Problem</label>
            <select required id="nature" name="nature" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>


            <div>
                <label for="brand" class="block mt-3 text-sm font-medium text-white">User</label>
                <div class="relative w-full wrapper">
                    <div class="flex items-center justify-between p-2 bg-gray-700 rounded-md cursor-pointer select-btn h-9">
                        <span>{{ $users[0]->name }}</span>
                        <i class="text-2xl transition-transform duration-300 uil uil-angle-down"></i>
                    </div>
                    <div class="absolute z-50 hidden w-full p-3 mt-1 bg-gray-700 border border-gray-500 rounded-md content">
                        <div class="relative search">
                            <i class="absolute leading-9 text-gray-500 uil uil-search left-3"></i>
                            <input type="text" class="w-full leading-9 text-gray-700 rounded-md outline-none selectSearch pl-9 h-9" placeholder="Search">
                        </div>
                        <ul class="mt-2 overflow-y-auto listOption options max-h-64">
                            @foreach ($users as $user)
                                <li data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="flex items-center pl-3 leading-9 rounded-md cursor-pointer h-9 hover:bg-gray-800">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="user" value="{{ $users[0]->id }}">
                </div>
            </div>

            {{-- <div class="mt-5">
                <label for="user" class="block text-sm font-medium text-white">User</label>
                <select required id="user" name="user" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div> --}}

            <div class="mt-5">
                <label for="subject" class="block text-sm font-medium text-white">Subject</label>
                <input required name="subject" id="subject" autocomplete="off" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
            </div>

            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <textarea required name="description" id="description" autocomplete="off" rows="3" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white"></textarea>
            </div>

            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-white">Status</label>
                <div class="flex">
                    <div class="flex items-center">
                        <input checked type="radio" value="PENDING" name="status" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 statusRadio focus:ring-blue-600 ring-offset-gray-800 focus:ring-2">
                        <label for="statusPending" class="ml-1 text-sm font-medium text-red-500">PENDING</label>
                    </div>
                    <div class="flex items-center ml-4">
                        <input type="radio" value="ONGOING" name="status" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 statusRadio focus:ring-blue-600 ring-offset-gray-800 focus:ring-2">
                        <label for="statusOngoing" class="ml-1 text-sm font-medium text-amber-300">ONGOING</label>
                    </div>
                    <div class="flex items-center ml-4">
                        <input type="radio" value="DONE" name="status" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 statusRadio focus:ring-blue-600 ring-offset-gray-800 focus:ring-2">
                        <label for="statusDone" class="ml-1 text-sm font-medium text-teal-500">DONE</label>
                    </div>
                </div>
            </div>

            <div id="ResolutionDiv" class="hidden mt-5">
                <label for="resolution" class="block text-sm font-medium text-white">Resolution</label>
                <textarea name="resolution" id="resolution" autocomplete="off" rows="3" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white"></textarea>
            </div>

            <div class="mt-5">
                <label for="attachment" class="block text-sm font-medium text-white">Upload Attachment</label>
                <div class="grid grid-cols-5 gap-x-5">
                    <div class="col-span-5">
                        <input id="attachment" name="attachment" class="block w-full h-10 text-sm text-gray-400 placeholder-gray-400 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer focus:outline-none" type="file" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="w-24 text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Submit</button>
                <a href="{{ route('ticket.index') }}" class="inline-block text-center w-24 text-white focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-800 hover:bg-gray-700 focus:ring-gray-700 border-gray-700">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#attachment').change(function(){
                var file = $(this).val();
                if(file != ''){
                    $('#viewAttachment').prop("disabled", false);
                }
            });

            $('#nature').change(function(){
                var incharge = $(this).find('option:selected').data('incharge');
                $('#ticketInChargeDisplay').html(incharge);
                $('#ticketInCharge').html(incharge);
            });

            $('.statusRadio').click(function(){
                var status = $(this).val();

                if(status == 'DONE'){
                    $('#ResolutionDiv').removeClass('hidden');
                    $('#resolution').prop('required', true)
                }else{
                    $('#ResolutionDiv').addClass('hidden');
                    $('#resolution').prop('required', false)
                }
            });







            $('.select-btn').click(function(e){
                $('.content').not($(this).closest('.wrapper').find('.content')).addClass('hidden');
                $(this).closest('.wrapper').find('.content').toggleClass('hidden');
                $(this).closest('.wrapper').find('.uil-angle-down').toggleClass('-rotate-180');
                e.stopPropagation();
            });

            function searchFilter(searchInput){
                $(".listOption li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchInput) > -1)
                });
            }

            $('.content').click(function(e){
                e.stopPropagation();
            });
            
            $(".selectSearch").on("input", function() {
                var value = $(this).val().toLowerCase();
                searchFilter(value);
            });

            $(".listOption li").click(function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                $(this).closest('.wrapper').find('input').val(id);
                $(this).closest('.wrapper').find('.select-btn span').html(name);
                $('.content').addClass('hidden');
                $('.selectSearch').val('');
                var value = $(".selectSearch").val().toLowerCase();
                searchFilter(value);
            });

            $(document).click(function() {
                $('.content').addClass('hidden');
                $('.uil-angle-down').removeClass('-rotate-180');
            });
        });
    </script>
</x-app-layout>

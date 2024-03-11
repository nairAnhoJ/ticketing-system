<x-app-layout>
    @section('title')
    User
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

        .inset-0{
            opacity: 0.5;
        }
    </style>

  <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
    @if(count($errors) > 0)
        <div class="absolute w-screen">
            <div style="transform: translateX(-50%);" class="mx-auto absolute left-1/2 z-50">
                <div id="toast-danger" class="flex items-center p-4 w-full max-w-sm rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                    <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 rounded-lg bg-red-800 text-red-200">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ml-3 text-sm font-normal">{{$errors->first()}}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="absolute w-screen">
            <div style="transform: translateX(-50%);" class="mx-auto absolute left-1/2 z-50">
                <div id="toast-success" class="flex items-center p-4 mb-4 w-full max-w-sm rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                    <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 rounded-lg bg-green-800 text-green-200">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ml-3 text-sm font-normal">{{ session()->get('success') }}</div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">USERS</h1>
                
        {{-- ================================= ADD / EDIT MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            <button id="userAddEdit" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="userModal">
            </button>
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="userModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form id="userForm" action="" method="POST" class="relative rounded-lg shadow bg-gray-700 text-sm">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b rounded-t border-gray-600">
                            <h3 id="modalTitle" class="text-2xl font-semibold text-white leading-5"></h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="userModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 pb-7 space-y-3">
                            <input type="hidden" id="userId" name="id">
                            <div>
                                <label for="id_no" class="block mb-2 text-sm font-medium text-white">ID Number</label>
                                <input type="text" id="id_no" name="id_no" value="{{old('id_no')}}" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                                <input type="text" id="name" name="name" value="{{old('name')}}" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="department" class="block mb-2 text-sm font-medium text-white">Department</label>
                                <select id="department" name="department" value="{{old('department')}}" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" :value="old('department')">
                                    @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                <input type="email" id="email" name="email" value="{{old('email')}}" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-white">Phone</label>
                                <input type="text" id="phone" name="phone" value="{{old('phone')}}" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                                <input type="password" id="password" name="password" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                            <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
                            <button data-modal-toggle="userModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= ADD / EDIT MODAL END ================================= --}}

        
        {{-- ================================= RESET MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            {{-- <button id="userDelete" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="userDeleteModal">
            </button> --}}
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="resetModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form action="{{ route('user.reset') }}" method="POST" class="relative rounded-lg shadow bg-gray-700 text-sm">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b rounded-t border-gray-600">
                            <h3 id="modalTitle" class="text-2xl font-semibold text-white leading-5">RESET PASSWORD</h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="resetModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 pb-7 space-y-6">
                            <input type="hidden" id="resetUserId" name="id">
                            <div>
                                <label for="resetUserName" class="block mb-2 text-sm font-medium text-white">Are you sure you want to reset the password of this user?</label>
                                <h1 id="resetUserName"></h1>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                            <button data-modal-toggle="resetModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Submit</button>
                            <button data-modal-toggle="resetModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= RESET END ================================= --}}

        
        {{-- ================================= DELETE MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            <button id="userDelete" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="userDeleteModal">
            </button>
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="userDeleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form action="{{ route('user.delete') }}" method="POST" class="relative rounded-lg shadow bg-gray-700 text-sm">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b rounded-t border-gray-600">
                            <h3 id="modalTitle" class="text-2xl font-semibold text-white leading-5">DELETE</h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="userDeleteModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 pb-7 space-y-6">
                            <input type="hidden" id="delUserId" name="id">
                            <div>
                                <label for="delUserName" class="block mb-2 text-sm font-medium text-white">Are you sure you want to delete this user details?</label>
                                <h1 id="delUserName"></h1>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                            <button data-modal-toggle="userDeleteModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Submit</button>
                            <button data-modal-toggle="userDeleteModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= DELETE END ================================= --}}


  

        {{-- CONTROLS --}}
        <div class="grid grid-cols-3 mb-0 h-10">
            <div class="h-8 col-span-2">
                <button class="userAdd h-full text-white font-medium rounded-lg text-sm px-10 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none">Add</button>
            </div>
            <div class="flex gap-x-3 h-8">
                <div class="flex items-center w-full">
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
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
          <table class="min-w-full text-sm text-left text-gray-400">
              <thead class="relative top-0 text-xs uppercase bg-gray-600 text-gray-400 border-x-8 border-gray-600">
                  <tr class="bg-gray-600 sticky top-0">
                        <th id="thl" scope="col" class="sticky top-0 py-2 text-center">
                            #
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            ID NUMBER
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            NAME
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            DEPARTMENT
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            EMAIL
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            PHONE
                        </th>
                        <th scope="col" class="sticky top-0 py-2 text-center">
                            ACTION
                        </th>
                  </tr>
              </thead>
              <tbody id="userTableBody" style="max-height: calc(100% - 126px);">
                @php
                    $x = 1;
                @endphp
                @foreach ($users as $user)
                    <tr class="bg-gray-800 {{ $x>1 ? 'border-t' : '' }} border-gray-700 hover:bg-gray-700">
                        <th scope="row" class="py-3 px-6 font-medium text-center">
                                {{ $x++ }}
                        </th>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            {{ $user->id_no }}
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            {{ $user->name }}
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            {{ $user->dept }}
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            {{ $user->email }}
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            {{ $user->phone }}
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <a data-id="{{ $user->id }}" class="userEdit mr-2 text-blue-500 cursor-pointer">EDIT</a>|<a data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-modal-toggle="resetModal" class="btnUserReset mx-2 text-orange-500 cursor-pointer">RESET</a>|<a data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="btnUserDelete ml-2 text-red-500 cursor-pointer">DELETE</a>
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
            $("#userTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.userAdd').click(function(){
            var action = "{{ route('user.add') }}";

            $('#userForm').attr('action', action);
            $('#modalTitle').html('ADD');
            $('#password').attr('required', true);
            $('#password_confirmation').attr('required', true);
            $('#userAddEdit').click();
        });

        $('.userEdit').click(function(){
            $('#password').attr('required', false);
            $('#password_confirmation').attr('required', false);
            var id = $(this).data('id');
            var action = "{{ route('user.update') }}";
            $('#id_no').val('');

            $.ajax({
                url: "{{ route('user.edit') }}",
                type: 'POST',
                data :{ 
                    _token: '{!! csrf_token() !!}',
                    id: id
                },
                dataType:'json',
                success:function(result){
                    $('#id_no').val(result.id_no);
                    $('#name').val(result.name);
                    $('#department').val(result.department);
                    $('#email').val(result.email);
                    $('#phone').val(result.phone);

                    $('#userForm').attr('action', action);
                    $('#modalTitle').html('EDIT');
                    $('#userName').val(name);
                    $('#userId').val(id);
                    $('#userAddEdit').click();
                }
            });
        });

        $('.btnUserDelete').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            
            $('#delUserName').html(name);
            $('#delUserId').val(id);
            $('#userDelete').click();
        });

        $('.btnUserReset').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            
            $('#resetUserName').html(name);
            $('#resetUserId').val(id);
            // $('#userDelete').click();
        });
    });
  </script>
</x-app-layout>

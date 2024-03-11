<x-app-layout>
    @section('title')
    Department
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

  <div style="height: calc(100vh - 65px);" class="w-screen p-3 text-gray-200">
    <h1 class="mb-3 text-3xl font-extrabold leading-none tracking-wide text-blue-500">DEPARTMENT</h1>
                
        {{-- ================================= ADD / EDIT MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            <button id="deptAddEdit" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="departmentModal">
            </button>
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="departmentModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form id="deptForm" action="" method="POST" class="relative text-sm bg-gray-700 rounded-lg shadow">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-600 rounded-t">
                            <h3 id="modalTitle" class="text-2xl font-semibold leading-5 text-white"></h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="departmentModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 space-y-6 pb-7">
                            <input type="hidden" id="deptId" name="id">
                            <div>
                                <label for="deptName" class="block mb-2 text-sm font-medium text-white">Department Name</label>
                                <input type="text" id="deptName" name="name" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="inchargeUser" class="block mb-2 text-sm font-medium text-white">In-Charge</label>
                                <select id="inchargeUser" name="inchargeUser" class="border text-sm rounded-lg block w-full py-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                    @foreach ($dics as $dic)
                                        <option value="{{ $dic->id }}">{{ $dic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-600 rounded-b">
                            <button data-modal-toggle="departmentModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
                            <button data-modal-toggle="departmentModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= ADD / EDIT MODAL END ================================= --}}

        {{-- ================================= DELETE MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            <button id="deptDelete" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="deptDeleteModal">
            </button>
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="deptDeleteModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form action="{{ route('department.delete') }}" method="POST" class="relative text-sm bg-gray-700 rounded-lg shadow">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-600 rounded-t">
                            <h3 id="modalTitle" class="text-2xl font-semibold leading-5 text-white">DELETE</h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="deptDeleteModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 space-y-6 pb-7">
                            <input type="hidden" id="delDeptId" name="id">
                            <div>
                                <label for="delDeptName" class="block mb-2 text-sm font-medium text-white">Are you sure you want to delete this department?</label>
                                <h1 id="delDeptName"></h1>
                                {{-- <input type="text" id="delDeptName" name="name" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-600 rounded-b">
                            <button data-modal-toggle="deptDeleteModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Submit</button>
                            <button data-modal-toggle="deptDeleteModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= DELETE END ================================= --}}

        {{-- ================================= CHANGE DEPT IN CHARGE MODAL ================================= --}}
            <!-- ========================================================= Modal toggle ========================================================= -->
            <button id="changeInChage" class="hidden text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" type="button" data-modal-toggle="changeInChageModal">
            </button>
            
            <!-- ========================================================= Main modal ========================================================= -->
            <div id="changeInChageModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form action="{{ route('incharge.update') }}" method="POST" class="relative text-sm bg-gray-700 rounded-lg shadow">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-600 rounded-t">
                            <h3 id="modalTitle" class="text-2xl font-semibold leading-5 text-white">CHANGE DEPARTMENT IN-CHARGE</h3>
                            <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="changeInChageModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="px-6 pb-3 space-y-4">
                            <input type="hidden" id="dept_id" name="dept_id">
                            <div>
                                <label for="delCategoryName" class="block mb-2 text-base font-medium text-white">Are you sure you want to change the department in-charge?</label>
                                {{-- <p><span class="tracking-wide text-yellow-500">WARNING: ALL THE SAVED CATEGORIES WILL BE DELETED.</span></p> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-600 rounded-b">
                            <button data-modal-toggle="changeInChageModal" type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-red-600 hover:bg-red-700 focus:ring-red-800">Submit</button>
                            <button data-modal-toggle="changeInChageModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- ================================= DELETE END ================================= --}}

        {{-- CONTROLS --}}
            <div class="grid h-10 grid-cols-3 mb-0">
                <div class="h-8 col-span-2">
                    <button class="h-full px-10 mb-2 mr-2 text-sm font-medium text-white bg-blue-600 rounded-lg deptAdd hover:bg-blue-700 focus:outline-none">Add</button>
                    <div class="flex float-right">
                        <h1 class="leading-8">Dept In-Charge:</h1>
                        <select id="inchargeDept" class="ml-1 mr-1 border text-sm rounded-lg block w-50 h-8 px-3 py-1.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($depts as $dept)
                                <option value="{{ $dept->id }}" {{ ($dept->id == $deptInCharge) ? 'selected' : ''}}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        <button disabled data-modal-toggle="changeInChageModal" id="changeInChargeDept" class="h-8 px-8 mb-2 mr-8 text-sm font-medium text-white bg-blue-600 rounded-lg disabled:pointer-events-none disabled:opacity-50 hover:bg-blue-700 focus:outline-none">Save</button>
                    </div>
                </div>
                <div class="flex h-8 gap-x-3">
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
        {{-- CONTROLS --}}

        {{-- TABLE --}}
            <div style="max-height: calc(100% - 126px);" class="relative overflow-x-auto rounded-t-lg shadow-md">
                <table class="min-w-full text-sm text-left text-gray-400">
                    <thead class="relative top-0 text-xs text-gray-400 uppercase bg-gray-600 border-gray-600 border-x-8">
                        <tr class="sticky top-0 bg-gray-600">
                            <th id="thl" scope="col" class="sticky top-0 py-2 text-center">
                                #
                            </th>
                            <th scope="col" class="sticky top-0 py-2 text-center">
                                DEPARTMENT NAME
                            </th>
                            <th scope="col" class="sticky top-0 py-2 text-center">
                                IN-CHARGE
                            </th>
                            <th scope="col" class="sticky top-0 py-2 text-center">
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody id="departmentTableBody" style="max-height: calc(100% - 126px);">
                        @php
                            $x = 1;
                        @endphp
                        @foreach ($depts as $dept)
                            <tr class="bg-gray-800 {{ $x>1 ? 'border-t' : '' }} border-gray-700 hover:bg-gray-700">
                                <th scope="row" class="px-6 py-3 font-medium text-center">
                                        {{ $x++ }}
                                </th>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    {{ $dept->name }}
                                </td>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    @foreach ($users as $user)
                                        @php
                                            if($user->id == $dept->in_charge){
                                                echo $user->name;
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                </td>
                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                    <a data-id="{{ $dept->id }}" data-name="{{ $dept->name }}" class="mr-2 text-blue-500 cursor-pointer deptEdit">EDIT</a>|<a data-id="{{ $dept->id }}" data-name="{{ $dept->name }}" class="ml-2 text-red-500 cursor-pointer btnDeptDelete">DELETE</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- TABLE --}}
        
  </div>

  <script>
    $(document).ready(function(){
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#departmentTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#changeInChargeDept').click(function(){
            var dept_id = $('#inchargeDept').val();
            $('#dept_id').val(dept_id);
        });

        $('#inchargeDept').change(function(){
            $('#changeInChargeDept').prop('disabled', false);
        });

        
        $('.deptAdd').click(function(){
            var action = "{{ route('department.add') }}";

            $('#deptForm').attr('action', action);
            $('#modalTitle').html('ADD');
            $('#deptName').val('');
            $('#deptId').val('');
            $('#deptAddEdit').click();
        });

        $('.deptEdit').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var action = "{{ route('department.edit') }}";

            $('#deptForm').attr('action', action);
            $('#modalTitle').html('EDIT');
            $('#deptName').val(name);
            $('#deptId').val(id);
            $('#deptAddEdit').click();
        });

        $('.btnDeptDelete').click(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            
            $('#delDeptName').html(name);
            $('#delDeptId').val(id);
            $('#deptDelete').click();
        });
    });
  </script>
</x-app-layout>

<x-app-layout>
    @section('title')
    Settings
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



    <div id="notifMessage" class="absolute top-20 w-full mx-auto">
    </div>

    <div class="p-6 text-gray-200 w-screen overflow-x-hidden">
        <h1 class="mb-3 font-extrabold leading-none text-3xl text-blue-500 tracking-wide">Settings</h1>

        <form id="smtpForm" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label id="smtpToggle" class="relative inline-flex items-center cursor-pointer mt-10 mb-3">
                <input type="checkbox" value="1" id="smtp_status" name="smtp_status" class="sr-only peer" {{ ($settings->smtp_is_activated == 1) ? 'checked' : ''}}>
                <div class="w-11 h-6 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-300">Send Email on Ticketing System</span>
            </label>
            <div class="mb-2">
                <label for="hostServer" id="labelHostServer" class="{{ ($settings->smtp_is_activated == 1) ? '' : 'opacity-40'}} block text-sm font-medium text-white">SMTP Server</label>
                <input required type="text" id="hostServer" name="hostServer" autocomplete="off" value="{{ $settings->smtp_server }}" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none block w-1/3 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="username" id="labelUsername" class="{{ ($settings->smtp_is_activated == 1) ? '' : 'opacity-40'}} block text-sm font-medium text-white">SMTP Username</label>
                <input required type="email" id="username" name="username" autocomplete="off" value="{{ $settings->smtp_username }}" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none block w-1/3 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="password" id="labelPassword" class="{{ ($settings->smtp_is_activated == 1) ? '' : 'opacity-40'}} block text-sm font-medium text-white">SMTP Password</label>
                <input type="password" id="password" name="password" autocomplete="off" value="" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none block w-1/3 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="name" id="labelName" class="{{ ($settings->smtp_is_activated == 1) ? '' : 'opacity-40'}} block text-sm font-medium text-white">Sender Name</label>
                <input required type="text" id="name" name="name" autocomplete="off" value="{{ $settings->smtp_name }}" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none block w-1/3 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-3">
                <label for="port" id="labelPort" class="{{ ($settings->smtp_is_activated == 1) ? '' : 'opacity-40'}} block text-sm font-medium text-white">SMTP Port</label>
                <input required type="text" id="port" name="port" autocomplete="off" value="{{ $settings->smtp_port }}" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none block w-1/3 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <button data-modal-target="testModal" data-modal-toggle="testModal" type="button" id="btnTestCon" {{ ($settings->smtp_is_activated == 1) ? '' : 'disabled'}} class="disabled:opacity-40 disabled:pointer-events-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Test Connection</button>
                <button type="submit" id="btnSave" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-blue-800">Save</button>
            </div>

            {{-- ============================= TEST CONNECTION MODAL ============================= --}}
                <div id="testModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative rounded-lg shadow bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                                <h3 class="text-xl font-semibold text-white">
                                    Test Connection
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-hide="testModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="py-3 px-4">
                                <div class="mb-2">
                                    <label for="sendtest" class="block mb-1 text-sm font-medium text-white">Send Test Email to:</label>
                                    <input type="email" id="sendtest" name="sendtest" value="" autocomplete="off" class="block w-1/2 p-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t rounded-b border-gray-600">
                                <button data-modal-hide="testModal" type="button" id="sendTestEmail" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Send</button>
                                <button data-modal-hide="testModal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- ============================= TEST CONNECTION MODAL END ============================= --}}
        </form>

        <hr class="my-5 border-gray-500">

        <div class="mt-10">
            <h1 class="font-medium text-lg mb-3">ISSUANCE FORM USER AGREEMENT</h1>
            <a href="{{ route('settings.uadIndex') }}" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mr-3">Edit User Agreement for Devices</a>
            <a href="{{ route('settings.uapsIndex') }}" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Edit User Agreement for Phone/SIM Card</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#sendTestEmail').click(function(){
                var pass = $('#password').val();
                if(pass == ""){
                    alert('The Password field is required');
                }else{
                    var rec = $('#sendtest').val();
                    if(rec == ""){
                        alert('Please provide a valid email');
                    }else{
                        $('#notifMessage').html(`<div id="toast-loading" class="relative left-1/2 -translate-x-1/2 flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                            <div role="status">
                                <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="inline">Loading...</span>
                            </div>
                        </div>`);
                        $.ajax({
                            url: "{{ route('settings.test') }}",
                            type: 'POST',
                            data : $('#smtpForm').serialize(),
                            success:function(){
                                $('#notifMessage').html(`<div id="toast-success" class="msgNotif relative left-1/2 -translate-x-1/2 flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-green-800 text-green-200">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Check icon</span>
                                    </div>
                                    <div class="ml-3 text-sm font-normal">Test Connection Successful.</div>
                                    <button type="button" class="closeMsgNotif ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>`);
                            },
                            error: function(){
                                $('#notifMessage').html(`<div id="toast-error" class="msgNotif relative left-1/2 -translate-x-1/2 flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Error icon</span>
                                    </div>
                                    <div class="ml-3 text-sm font-normal">Test Connection Failed.</div>
                                    <button type="button" class="closeMsgNotif ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-error" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>`);
                            }
                        });
                    }
                }
            });

            jQuery(document).on( "click", ".closeMsgNotif", function(){
                $('#notifMessage').html('');
            });

            $('#smtpToggle').click(function(){
                var smtp_status = $('#smtp_status').prop('checked');
                if(smtp_status == true){
                    $('#btnTestCon').prop('disabled', false);
                    $('#port').prop('disabled', false);
                    $('#name').prop('disabled', false);
                    $('#password').prop('disabled', false);
                    $('#username').prop('disabled', false);
                    $('#hostServer').prop('disabled', false);

                    $('#labelPort').removeClass('opacity-40');
                    $('#labelName').removeClass('opacity-40');
                    $('#labelPassword').removeClass('opacity-40');
                    $('#labelUsername').removeClass('opacity-40');
                    $('#labelHostServer').removeClass('opacity-40');
                }else{
                    $('#btnTestCon').prop('disabled', true);
                    $('#port').prop('disabled', true);
                    $('#name').prop('disabled', true);
                    $('#password').prop('disabled', true);
                    $('#username').prop('disabled', true);
                    $('#hostServer').prop('disabled', true);

                    $('#labelPort').addClass('opacity-40');
                    $('#labelName').addClass('opacity-40');
                    $('#labelPassword').addClass('opacity-40');
                    $('#labelUsername').addClass('opacity-40');
                    $('#labelHostServer').addClass('opacity-40');
                }
            });
        });
    </script>
</x-app-layout>

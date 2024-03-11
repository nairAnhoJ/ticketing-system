{{-- <x-app-layout>
    @section('meta')
    <meta http-equiv="Refresh" content="60">
    @endsection
    @section('title')
    Change Password
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

    <div id="loadingScreen"></div>
    <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
        <h1 class="mb-2 font-extrabold leading-none text-3xl text-blue-500 tracking-wide text-center">CHANGE PASSWORD</h1>
                

        
    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    {{-- <title>{{ config('app.name', 'IT System') }}</title> --}}
    
    <title>CHANGE PASSWORD</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased overflow-x-hidden w-screen h-screen">
    <div class="text-gray-200 w-screen h-screen bg-gray-900">
                
        <div class="flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex-col">
            <h1 class="mb-6 font-extrabold leading-none text-4xl text-blue-500 tracking-wide text-center">CHANGE PASSWORD</h1>
            <p class="self-center w-96 text-sm bg-gray-800 px-7 py-3 mb-7 border-l-8 border-blue-500 rounded-r-lg">You are required to change your password before you login for the first time.</p>
            <form method="POST" action="{{ route('updatePass') }}" class="self-center w-96 bg-gray-800 p-7 rounded-xl">
                @csrf
                <div class="mb-6">
                  <label for="password" class="block mb-2 text-sm font-medium text-white">New Password<span class="ml-3 text-xs italic">(minimum of 8 characters)</span></label>
                  <input type="password" id="password" name="password" class="border text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                  <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">Confirm password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="px-36">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
        
    </div>
    <script>
        $(document).ready(function(){

        });
    </script>
</body>
</html>

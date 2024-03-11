<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Return Form</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
    </style>

    <body class="font-sans antialiased w-screen">
        <div class="px-20 mt-7">
            <div class="grid grid-cols-4 gap-x-4">
                <div class="self-center justify-self-end">
                    <img src="{{ asset('storage\images\logo\TMH_BT_RAYMOND.png') }}" class="block w-20 h-auto" alt="">
                </div>
                <div class="col-span-3 self-center">
                    <h1 class=" font-black text-xl tracking-wider">HANDLING INNOVATION INCORPORATED</h1>
                    <p>Dow Jones Bldg., Whse5A, KM 19, WSR, SSH, Parañaque City</p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <h1 class="font-medium text-2xl text-center tracking-wider mb-10">ITEMS FOR DISPOSAL</h1>

        <div class="px-20 my-2">
            <div class="grid grid-cols-4 gap-x-2 text-lg">
                @foreach ($items as $item)
                <div class="font-semibold col-span-1 tracking-wide">{{ $item->name }}</div>
                <div class="font-semibold col-span-3 tracking-wide">{{ $item->count }}</div>
                @endforeach
            </div>
        </div>

        {{-- <div class="px-20">
            @php
                $x = 1;
            @endphp
            @foreach ($items as $item)
                <div class="grid grid-cols-11 grid-rows-3 gap-x-2 text-sm my-4">
                    <div class="row-span-3 justify-self-center font-bold text-xl flex"><span class="self-center">{{$x++}}</span></div>
                    <div class=" col-span-2">Item Code: </div>
                    <div class="font-semibold col-span-4 tracking-wide">{{ $item->code}}</div>
                    <div class=" col-span-2">Item Type: </div>
                    <div class="font-semibold col-span-2 tracking-wide">{{ $item->type}}</div>
                    <div class=" col-span-2">Description: </div>
                    <div class="font-semibold col-span-4 tracking-wide">{{ $item->desc}}</div>
                    <div class=" col-span-2">Serial Number: </div>
                    <div class="font-semibold col-span-2 tracking-wide">{{ $item->serial_no}}</div>
                    <div class=" col-span-2">Remarks: </div>
                    <div class="font-semibold col-span-7 tracking-wide">{{ $item->remarks}}</div>
                </div>
            @endforeach
        </div> --}}


        <div style="width: 856px" class="px-10 mx-auto mt-16"><div class="grid grid-cols-3 mt-3">
                <div class="text-xs">
                    Conducted by:
                </div>
                <div></div>
                <div class="text-xs">
                    Received By:
                </div>

                <div class="border-b border-neutral-900 h-5"></div>
                <div></div>
                <div class="border-b border-neutral-900 h-5"></div>

                <div class="text-xs text-center">
                    Signature over Printed Name and Date
                </div>
                <div></div>
                <div class="text-xs text-center">
                    Signature over Printed Name and Date
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                window.onafterprint = window.close;
                window.print();
            });
        </script>
    </body>
</html>

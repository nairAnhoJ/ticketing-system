<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <title>Issuance Form</title>

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

        #quserAgreement a{
            text-decoration: underline;
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

        <hr class="mt-2">

        <h1 class="font-medium text-2xl text-center tracking-wider mt-1">ISSUANCE FORM</h1>

        <div class="px-20 mt-2">
            <div class="grid grid-cols-7 gap-x-2 text-sm">
                <div>Name: </div>
                <div class="font-semibold col-span-4 tracking-wide">{{ $item->user}}</div>
                <div>Date Returned: </div>
                <div class="font-semibold tracking-wide">{{ $item->date_issued }}</div>

                <div>Department: </div>
                <div class="font-semibold col-span-4 tracking-wide">{{ $item->department}}</div>
                <div>Location: </div>
                <div class="font-semibold tracking-wide">{{ $item->site}}</div>
            </div>
        </div>

        <hr class="my-2">

        <div class="px-20">
            <div class="grid grid-cols-7 gap-x-2 text-xs">
                <div>Brand Name: </div>
                <div class="font-semibold col-span-4 tracking-wide">{{ $item->desc}}</div>
                <div>Cost: </div>
                <div class="font-semibold tracking-wide">{{ (preg_match("/[a-zA-Z]/i", $item->cost)) ? $item->cost : '₱ '.number_format($item->cost, 2, '.', ',') }}</div>
                <div>Serial/SIM No: </div>
                <div class="font-semibold col-span-4 tracking-wide">{{ $item->serial_no}}</div>
                <div>Color: </div>
                <div class="font-semibold tracking-wide">{{ $item->color}}</div>
                <div>Remarks: </div>
                <div class="font-semibold col-span-4 tracking-wide">{{ $item->remarks}}</div>
                <div>Status: </div>
                <div class="font-semibold tracking-wide">{{ $item->status}}</div>

            </div>
        </div>

        <hr class="my-4">

        <h1 class="font-semibold text-base text-center tracking-wider">INSTRUCTION FROM HEREIN UNDER IS IMPORTANT. PLEASE READ THEM CAREFULLY</h1>

        <div style="width: 856px" class="px-10 mx-auto">
            <h1 style="box-shadow: inset 0 0 0 1000px red;" class="border inline border-neutral-900 px-2 py-px text-white font-semibold tracking-wide">USER AGREEMENT</h1>
            <div id="quserAgreement" style="font-size: 11px;" class="w-full px-2.5 py-1.5 leading-3 resize-none border-neutral-900 border">{!! $item->item == 'SIM CARD' || $item->item == 'PHONE' ? $settings->user_agreement_phonesim : $settings->user_agreement_device !!}</div>
            <p style="font-size: 10px;" class="mt-32 text-xs text-center">I hereby certify that I agreed and understand the terms and condition mention and received the listed items in good condition with proper orientation.</p>
            <div class="grid grid-cols-3 mt-3">
                <div class="text-xs">
                    Prepared by:
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
                var sh = $('#userAgreement').prop('scrollHeight');
                $('#userAgreement').height((sh) + 'px');
                window.onafterprint = window.close;
                window.print();
            });
        </script>
    </body>
</html>

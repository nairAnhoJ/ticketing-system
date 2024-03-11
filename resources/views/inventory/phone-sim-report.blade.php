<x-app-layout>
    @section('title')
    Phone / SIM Report
    @endsection

    <div style="height: calc(100vh - 65px);" class="p-3 text-gray-200 w-screen">
        <h1 class="mb-5 text-3xl font-bold">PHONE / SIM REPORT</h1>
        <form action="{{ route('phoneSim.report.generate') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="item" class="block text-sm font-medium text-white">Item</label>
                <select id="item" name="item" autocomplete="off" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" :value="old('department')">
                    <option value="">PHONE AND SIM</option>
                    <option value="PHONE">PHONE</option>
                    <option value="SIM CARD">SIM</option>
                </select>
            </div>
            <div class="mb-5 max-w-full">
                <label for="site" class="block text-sm font-medium text-white">Site/s</label>
                <div class="grid grid-cols-5 w-full">
                    @foreach ($sites as $site)
                        <div class="flex items-center">
                            <input checked id="site" type="checkbox" name="sites[]" value="{{ $site->id }}" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                            <label for="checked-checkbox" class="mr-3 ml-1 text-sm font-medium text-gray-300">{{ $site->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-5 max-w-full">
                <label for="site" class="block text-sm font-medium text-white">Department/s</label>
                <div class="grid grid-cols-5 w-full">
                    @foreach ($departments as $department)
                        <div class="flex items-center">
                            <input checked id="site" type="checkbox" name="departments[]" value="{{ $department->id }}" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                            <label for="checked-checkbox" class="mr-3 ml-1 text-sm font-medium text-gray-300">{{ $department->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">GENERATE</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
</x-app-layout>
 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feature 2: Set Static and customised Exchange Rates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="container px-4 mx-auto">
            <div class="sm:flex sm:items-center sm:justify-start">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Add Exchange Rates</h2>
                        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{$count}} Exchange Sets</span>
                    </div>
                    <div class="flex items-center gap-x-3">
                        @if(session('success'))
                        <div class="bg-green-500 text-white px-4 py-2 rounded">
                            {{ session('success') }}
                        </div>
                        @endif
                    
                        @if(session('error'))
                        <div class="bg-red-500 text-white px-4 py-2 rounded">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                        The admin panel incorporates a flexible and configurable system for managing both Static and Customised exchange rates. With this functionality, the administrator can easily set and modify the exchange rates according to specific currency pairs. The Static rate serves as the base rate, such as 100.00 rupees per pound for the UK to India currency conversion. The Customised rate is dependent on the Static rate and can be adjusted either as a fixed value, like +5 or -5, or as a percentage, such as -1%. For instance, if the Customised rate for UK to India conversion is -5, the home page will display the conversion rate as 95.00 rupees per pound. Conversely, if it is +5, the rate will be shown as 105.00 rupees per pound. Similarly, for the US to Pakistan currency conversion, if the Static rate is 286.00 rupees per dollar and the Customised rate is +3, the home page will display the conversion rate as 289.00 rupees per dollar. This feature empowers the admin to tailor the exchange rates and ensure accurate and dynamic currency conversions on the website.</p>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-full bg-white shadow-md rounded px-4 py-6 md:px-8 md:py-10 my-2">
                    <form action="{{route('saveRate')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- Sending Country -->
                            <div>
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-sending-country">
                                Sending Country
                                </label>
                                <select name="sendingcountry" id="sendingcountry"
                                class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-3 rounded" id="grid-sending-country">
                                <option value="">Select Country</option>
                                @foreach ($sendNations as $sendNation)
                                    <option value="{{ $sendNation->id }}">{{ $sendNation->flag }} {{ $sendNation->name }}</option>
                                @endforeach
                                </select>
                                @error('sendingcountry')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                                
                            </div>
                            <!-- Receiving Country -->
                            <div>
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-receiving-country">
                                Receiving Country
                                </label>
                                <select name="recevingcountry" id="recevingcountry"
                                class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-3 rounded" id="grid-receiving-country">
                                <option value="">Select Country</option>
                                @foreach ($receiveNations as $receiveNation)
                                    <option value="{{ $receiveNation->id }}">{{ $receiveNation->flag }} {{ $receiveNation->name }}</option>
                                @endforeach
                                </select>
                                @error('recevingcountry')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                                
                            </div>
                        </div>
                        <!-- Static Exchange Rate, State, and Zip -->
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Static Exchange Rate -->
                            <div>
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-static-exchange-rate">
                                Static Exchange Rate
                                </label>
                                <input name="staticrate" type="number" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="grid-static-exchange-rate" type="text" placeholder="100">
                                @error('staticrate')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
                            <!-- Customised rate -->
                            <div>
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                                    Customised rate
                                </label>
                                <input type="text" name="customrate" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="grid-state" type="text" placeholder="10%">
                                @error('customrate')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
                            <!-- Factor (+/- or % Percentage) -->
                            <div>
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
                                Factor
                                </label>
                                <div class="relative">
                                <select name="factor" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" id="grid-zip">
                                    <option value="">Select Option</option>
                                    <option value="1">Factor (+/-) </option>
                                    <option value="2">Percentage</option>
                                </select>
                                </div>
                                @error('factor')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                
                        <!-- Submit and Reset Buttons -->
                        <div class="flex justify-end mt-5">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded">Submit</button>
                        <button type="reset" class="px-4 py-2 bg-red-500 text-white font-semibold rounded ml-2">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        <section class="container px-4 mt-10 mx-auto">
            <div class="sm:flex sm:items-center sm:justify-start">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Exchange Rates Table</h2>
                        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{$count}} Sets</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                        Edit or Update Rates
                    </p>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-full bg-white shadow-md rounded px-4 py-6 md:px-8 md:py-10 my-2">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Exchange Pair
                                </th>

                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Static Rate
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Customised Rate
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Factor
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Final Rate
                                </th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($exchange as $item)
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h1 class="text-lg text-gray-800 dark:text-white ">
        
                                            {{$nations->find($item->sendCountry_id)->flag}} <i class="fas fa-chevron-right"></i> {{$nations->find($item->receiveCountry_id)->flag}}
                                           
                                        </h1>
                                        @if ($item->flag)
                                        <p class="line-through text-sm font-normal text-gray-600 dark:text-gray-400">
                                            Exchange form {{$nations->find($item->sendCountry_id)->name}} To {{$nations->find($item->receiveCountry_id)->name}} is disabled.
                                         </p>
                                        @else
                                        <p class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                           Exchange form {{$nations->find($item->sendCountry_id)->name}} To {{$nations->find($item->receiveCountry_id)->name}}
                                        </p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                    {{-- <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        
                                        {{$item->staticrate}}
                                    </div> --}}

                                    
                                <form method="POST" action="/updateRate/{{$item->id}}">                                            
                                            @csrf
                                            @method('PUT')
                                    <div class="flex">
                                        <input type="text" name="staticrate" class="w-12 px-2 py-2 border border-gray-400 rounded-l-md focus:outline-none focus:border-blue-500" value="{{$item->staticrate}}">
                                        <button type="submit" class="flex items-center  px-2 text-sm py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none">
                                          <i class="ml-2 fas fa-pen"></i>
                                        </button>
                                    </div>
                                </form>     
                                      
                                    
                                </td>
                                <td class="px-2 py-2 text-sm whitespace-nowrap">
                                    {{-- <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                       {{$item->customrate}}
                                    </div> --}}
                                    <form method="POST" action="/updateRate/{{$item->id}}">                                            
                                        @csrf
                                        @method('PUT')
                                    <div class="flex">
                                        <input type="text" name="customrate" class="w-12 px-2 py-2 border border-gray-400 rounded-l-md focus:outline-none focus:border-blue-500" value="{{$item->customrate}}">
                                        <button class="flex items-center px-2 text-sm py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none">
                                          <i class="ml-2 fas fa-pen"></i>
                                        </button>
                                    </div>
                                    </form>

                                </td>

                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        @if($item->factor == 1)
                                        + / -
                                        @else
                                        % 
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="inline px-3 py-1  font-bold font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                       {{$item->finalrate}}
                                    </div>
                                </td>
                               

                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <form action="/deleteRate/{{$item->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none rounded px-4 py-2 text-white">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
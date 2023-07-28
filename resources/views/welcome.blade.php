<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>
    <!-- component -->
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
      <div>
        <h2 class="font-semibold text-xl text-gray-600">Get Exchange Rates</h2>
        <a href="/dashboard"><p class="text-gray-500 mb-6">click for admin dashboard.</p></a>
        <p class="text-sm text-gray-500 mb-6">The website's admin panel features two configurable functionalities. Firstly, the admin can select and modify the list of sending and receiving countries for currency exchange on the website. For example, if the home page initially displays UK and US as sending countries, the admin can deactivate US from the backend, resulting in only UK being shown as a sending country on the front end.</p>
            
        <p class="text-sm text-gray-500 mb-6">Secondly, the admin has the ability to set up both static and customized exchange rates for currency conversion. Static rates are fixed values for specific currency pairs, while customized rates are dependent on the static rates, either as a fixed value or a percentage. For instance, if the static rate for converting UK pounds to Indian rupees is 100.00 rupees per pound, and the customised rate is -5, then the home page will show the conversion rate as 95.00 rupees per pound. Conversely, if the customised rate is +5, it will be displayed as 105.00 rupees per pound. Similarly, for converting US dollars to Pakistani rupees, if the static rate is 286.00 rupees per dollar and the customised rate is +3, then the home page will show the conversion rate as 289.00 rupees per dollar.<p>
            
        <p class="text-sm text-gray-500 mb-6">In summary, the admin panel allows the admin to configure and manage the list of sending and receiving countries and set both static and customized exchange rates for currency conversion, providing flexibility and control over the currency exchange process on the website.</P>
  
        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="text-gray-600">
                <p class="font-medium text-lg">Exchange Rates</p>
                <p>Please fill out all the fields.</p>
                </div>
    
                <div class="lg:col-span-2">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-5">
                        <label for="from">Despatching Country</label>
                        <select name="from" id="from" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  onchange="getOptionsForSelect2()">
                                <option value=""> Please Select </option>
                            @foreach ($sendList as $item)
                                <option value="{{$item->id}}">{{$item->flag}}  {{$item->name}}</option>
                            @endforeach
                        </select>
                        </div>
        
                        <div class="md:col-span-5">
                        <label for="to">Receving Country</label>
                        <select name="from" id="to" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  >
                        </select>
                        </div>
        
                        <div class="md:col-span-5 text-right mt-3">
                        <div class="inline-flex items-end">
                            <button id="btnElement" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                        </div>
                        </div>

                    </div>
                </div>
                

            </div>
        </div>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6" id="resultDiv" style="display: none;">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <p class="text-2xl font-bold" id="dataDisplay"></p>
                <p class="text-sm font-bold" id="calcDisplay"></p>
            </div>
        </div>

      </div>
    </div>
  </div>
  <script>
        function getOptionsForSelect2() {
            const select1 = document.getElementById("from");
            const select2 = document.getElementById("to");

            // Clear existing options
            select2.innerHTML = "";

            // Get the selected value from select1
            const selectedValue = select1.value;

            // Make an AJAX request to get options for select2
            fetch(`/getOptions/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    
                    // Populate options for select2
                    data.forEach(option => {
                        select2.add(new Option(option.flag+' '+option.name,option.id));
                    });
                })
                .catch(error => {
                    console.error('Error fetching options:', error);
                });
        }

</script>

<script>
    function displayDataAndImage(selectedValue, selectedValue2) {
      fetch('/getResults/' + selectedValue + '/' + selectedValue2)
        .then(response => response.json())
        .then(data => {

        const dataDisplayElement = document.getElementById('dataDisplay');
        const calculationDisplayElement = document.getElementById('calcDisplay');
            
        if(data.factor == 2){
            var percentage = "%";
        }else{
            percentage="";
        }
        const finalData = "Exchange Rate is "+data.finalrate;
        const calcData = "(given static rate: " +data.staticrate+"  given custom rate: "+data.customrate+""+percentage+" )";
          
        dataDisplayElement.textContent = finalData;
        calculationDisplayElement.textContent = calcData;


          const resultDiv = document.getElementById('resultDiv');
          resultDiv.style.display = 'block';
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }
    


    const buttonElement = document.getElementById('btnElement')
    buttonElement.addEventListener('click', function() {
      const selectedValue =  document.getElementById('to').value;;
      const selectedValue2 = document.getElementById('from').value;
      displayDataAndImage(selectedValue, selectedValue2);
    });
    </script>
    

</body>
</html>


@php
    $passwordScoreColors = [
        0 => 'bg-gray-200',
        1 => 'bg-red-400',
        2 => 'bg-red-400',
        3 => 'bg-yellow-400',
        4 => 'bg-yellow-400',
        5 => 'bg-green-400',
    ]
@endphp

<form wire:submit.prevent="handle" class="block p-6 my-6 max-w-sm rounded-md shadow-md bg-gray-50">
    <h1 class="mb-3 text-3xl font-bold tracking-tight text-center text-gray-700">Password Generator</h1>
    <div class="relative">
        <input type="text" readonly wire:model="password" id="password" class="block p-4 pr-16 w-full text-gray-900 bg-gray-200 rounded-md border border-gray-500 outline-none" />
        <div id="clickToCopy" class="flex absolute inset-y-0 right-0 items-center px-3 border bg-gray-300 hover:bg-gray-200 border-gray-500 rounded-tr-md rounded-br-md cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
            </svg>
        </div>
    </div>

    <div class="flex -mx-1 my-6">
        @for ($i = 0; $i < 5; ++$i)
            <div class="w-1/5 px-1">
                <div class="h-2 rounded-xl transition-colors {{ $i < $passwordScore ? $passwordScoreColors[$passwordScore] : $passwordScoreColors[0] }}"></div>
            </div>
        @endfor
    </div>

    <div class="flex justify-center">
        <div>
            <div class="flex flex-col mb-4">
                <label class="inline-block text-gray-800 self-center" for="passwordLength">
                    Password length: {{ $length }}
                </label>
                
                <input wire:model="length" min="4" max="30" step="1" type="range" id="passwordLength" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" />
            
                @error('length')
                    <span class="text-rose-700 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex">
                <input wire:model.defer="includes" id="includeUppercase" type="checkbox" value="uppercase" class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer" />
                <label class="inline-block text-gray-800" for="includeUppercase">
                    Include uppercase letters 
                </label>
            </div>
            <div class="flex">
                <input wire:model.defer="includes" id="includeLowercase" type="checkbox" value="lowercase" class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer" />
                <label class="inline-block text-gray-800" for="includeLowercase">
                    Include lowercase letters 
                </label>
            </div>
            <div class="flex">
                <input wire:model.defer="includes" id="includeNumbers" type="checkbox" value="numbers" class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer" />
                <label class="inline-block text-gray-800" for="includeNumbers">
                    Include numbers 
                </label>
            </div>
            <div class="flex">
                <input wire:model.defer="includes" id="includeSymbols" type="checkbox" value="symbols" class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer" />
                <label class="inline-block text-gray-800" for="includeSymbols">
                    Include symbols
                </label>
            </div>
            @error('includes')
                <span class="text-rose-700 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button wire:loading.remove type="submit" class="text-gray-50 bg-gray-900 hover:bg-gray-800 outline-none rounded-md text-center mx-auto mt-4 block w-full px-4 py-2">Generate</button>
    
    <div wire:loading.block>
        <div class="block text-center mt-4">
            Generating password...
        </div>
    </div>
</div>


<script>
    document.getElementById('clickToCopy').onclick = () => {
        const password = document.getElementById('password');
        
        if (!password.value) {
            return;
        }
        
        password.select();
        document.execCommand('copy');
        alert('Password copied to clipboard');
    }
</script>
<div>

    <p class="font-semibold text-gray-500 mb-2">
        Choose Excel
    </p>

    <form wire:submit.prevent="import">
        <div class="flex gap-x-3 mb-3 text-center justify-center">

            <label for="file-upload"
                class="flex w-full justify-center text-center cursor-pointer bg-white border-2 border-dashed border-gray-300 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">

                @if ($fileName)
                    <div wire:loading.remove class="self-center">
                        <div class="flex gap-2 text-green-600">
                            <svg class="h-4 w-4 text-green-600"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />  <polyline points="22 4 12 14.01 9 11.01" /></svg>
                            <span class="text-xs font-medium">Ready to Import : {{ $fileName }}</span>
                        </div>
                    </div>
                @endif

                <div wire:loading class="self-center">
                    <div class="flex gap-2 grow w-full justify-center content-center  text-green-600">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="text-green-600" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-medium text-green-600">loading...</span>
                    </div>
                </div>
                <div wire:loading.remove class="self-center">
                    @if (!$fileName)
                        <span>Click to Upload</span>
                    @endif
                </div>
                <input id="file-upload" name="file-upload" type="file" class="sr-only" wire:model="file">
            </label>
            <button type="submit"
                @if (!$fileName)
                    disabled
                @endif
                wire:loading.attr="disabled"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
                disabled:bg-gray-400 disabled:text-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                Import
            </button>
        </div>
    </form>

    <div class="flex justify-start gap-2 text-xs text-gray-500 mb-2">
        <p>
            Support file type : xlsx
        </p>
        <a href="{{ asset('sample/person.xlsx') }}" class="text-blue-500 flex">
            <svg class="h-3 w-3 text-blue-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />  <polyline points="7 11 12 16 17 11" />  <line x1="12" y1="4" x2="12" y2="16" /></svg>
            Sample File
        </a>
    </div>

    @error('file')
        <div class="text-red-600">{{ $message }}</div>
    @enderror

    @livewire('upload-status')
</div>

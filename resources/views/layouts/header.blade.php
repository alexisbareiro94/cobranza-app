<div
    class="flex justify-between bg-gradient-to-r shadow-sm from-gray-100 to-gray-200 text-green-700 p-4 md:flex md:justify-between md:items-center">
    <div>
        <h1 class="text-lg font-bold">¡Buenos días, {{ auth()->user()->name }}!</h1>
        <p class="text-green-500 text-sm">Hoy: {{ now()->format('d-m-Y') }}</p>
    </div>
    <button class="text-white bg-green-400 bg-opacity-20 px-3 py-3 rounded-full mt-2 md:mt-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>

    </button>
</div>
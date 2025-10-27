@extends('layouts.app')

@section('title', 'Menu')

@section('content')

    <div class="p-4 space-y-6 relative">
        <div>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    height: 100%;
                }

                #map {
                    width: 100%;
                    height: 88vh;
                }

                @media (max-width: 768px) {
                    #map {
                        height: 80vh;
                    }
                }
            </style>

            <div id="map"></div>
            <button
                class="absolute z-50 top-32 rounded-md text-red-500 right-6 px-1 py-1 bg-white hover:cursor-pointer transition-all active:scale-90"
                id="btnUbicacion">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 -960 960 960" fill="#1e0f0a">
                    <path
                        d="M440-40v-80q-125-14-214.5-103.5T122-438H42v-80h80q14-125 103.5-214.5T440-836v-80h80v80q125 14 214.5 103.5T838-518h80v80h-80q-14 125-103.5 214.5T520-120v80h-80Zm40-158q116 0 198-82t82-198q0-116-82-198t-198-82q-116 0-198 82t-82 198q0 116 82 198t198 82Z" />
                </svg>
            </button>
        </div>
    </div>



@endsection

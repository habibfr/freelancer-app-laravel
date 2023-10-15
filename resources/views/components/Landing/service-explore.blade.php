<a href="{{ route('detail.landing', $service->id) }}" class="block">
    <div class="w-auto h-auto overflow-hidden md:p-5 p-4 bg-white rounded-2xl inline-block">
        <div class="flex items-center space-x-2 mb-6">
            <!--Author's profile photo-->

            {{-- @dd($service) --}}
            @if ($service->user->detail_user->photo != null)
                <img class="inline w-12 h-12 mr-3 rounded-full"
                    src={{ url(Storage::url($service->user->detail_user()->first()->photo)) }} alt="profil photo">
            @else
                <svg class="inline w-12 h-12 mr-3 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            @endif


            <div>
                <!--Author name-->
                <p class="text-gray-900 font-semibold text-lg">{{ $service->user->name ?? '' }}</p>
                <p class="text-serv-text font-light text-md">
                    {{ $service->user->detail_user->role ?? '' }}
                </p>
            </div>
        </div>

        <!--Banner image-->

        @if ($service->thumbnail_service[0]->thumbnail != null)
            {{-- @dd($item->thumbnail_service) --}}
            <img class="rounded-2xl w-full object-cover h-48"
            src={{ url(Storage::url($service->thumbnail_service[0]->thumbnail)) }} alt="profil photo" @else <img
                class="rounded-2xl w-full object-cover h-48" src={{ url('https://via.placeholder.com/750x500') }}
                alt="profil photo">
        @endif


        <!--Title-->
        <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
            {{ $service->title ?? '' }}
        </h1>
        <!--Description-->
        <div class="max-w-full">
            @include('components.landing.rating')
        </div>

        <div class="text-center mt-5 flex justify-between w-full">
            <span class="text-serv-text mr-3 inline-flex items-center leading-none text-md py-1 ">
                Price starts from:
            </span>
            <span class="text-serv-button inline-flex items-center leading-none text-md font-semibold">
                Rp. {{ number_format($service->price) ?? '' }}
            </span>
        </div>
    </div>
</a>

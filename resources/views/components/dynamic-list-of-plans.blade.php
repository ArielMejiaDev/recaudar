<section class="h-auto min-w-screen animation-fade animation-delay">
    <div class="container w-full mx-auto px-5 md:px-0">
        <div class="sm:flex">
            <aside class="w-full sm:flex-initial">
                @foreach ($team->availablePlans() as $plan)

                    <div @click="toggle = {{ $plan->id }}"
                         :class="{ 'bg-melon text-white hover:bg-pink': toggle === {{ $plan->id }} }"
                         class="flex mt-1 text-black bg-white rounded-md hover:text-white hover:bg-gray-700 shadow-lg">
                        <div class="self-center flex-shrink p-5">
                            <svg x-show="toggle === {{ $plan->id }}" class="w-8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><ellipse style="fill:#32BEA6;" cx="256" cy="256" rx="256" ry="255.832"/><polygon style="fill:#FFFFFF;" points="235.472,392.08 114.432,297.784 148.848,253.616 223.176,311.52 345.848,134.504 391.88,166.392 "/></svg>
                            <svg x-show="toggle != {{ $plan->id }}" class="w-8 text-gray-700 stroke-current stroke-2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><ellipse style="fill:#FFFFFF;" cx="256" cy="256" rx="256" ry="255.832"/></svg>
                        </div>
                        <div class="flex-grow px-0 py-5 md:px-5">
                            <div class="text-xs md:text-md capitalize">{{ $plan->title }}</div>
                        </div>
                        <a class="self-center flex-shrink w-32 px-5 py-5 text-lg text-center md:px-5" x-text="money_format({{ $plan->amount_in_local_currency }})"></a>
                    </div>

                @endforeach

            </aside>

            @foreach ($team->availablePlans() as $plan)

                <div x-show="toggle === {{ $plan->id }}" class="flex w-full mt-10 bg-white rounded-md sm:mt-1 sm:ml-5 sm:flex-initial shadow-lg">
                    <div class="flex-grow px-4 py-5 w-5/12">
                        <div class="text-lg lg:text-sm font-semibold text-center lg:text-left">{{ $plan->title }}</div>
                        <div class="flex mt-5">
                            <div class="self-center flex-grow text-gray-600 text-xs font-light">{{ $plan->info }}</div>
                        </div>
                        <div class="flex">
                            <div class="mt-8 w-full lg:w-auto">
                                <button class="w-full px-4 py-2 text-center text-white bg-pink rounded-md hover:bg-melon pointer-cursor focus:outline-none" @click.prevent="selectPlan({{ $plan }})">
                                    {{ trans('Donate') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @if($plan->banner)
                        <div class="flex w-full lg:w-7/12 h-full bg-blue-500 bg-opacity-25 rounded-r md:flex-shrink bg-cover" style="background: url('{{ $plan->banner }}');"></div>
                        @else
                        <div class="flex w-0 lg:w-7/12 h-full bg-blue-500 bg-opacity-25 rounded-r md:flex-shrink bg-cover" style="background: url('{{ $team->logo }}');"></div>
                    @endif
                </div>

            @endforeach

        </div>
    </div>
</section>

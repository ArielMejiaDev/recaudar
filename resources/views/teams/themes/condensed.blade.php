@extends('layout')

@section('content')

    <section class="text-gray-700 body-font relative overflow-hidden bg-gray-200">

        <x-landing.navbar-dark />

        <svg class="absolute fill-current text-gray-300 z-0" style="top: -125px; left: -25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(300,300)">
                <path d="M112.7,-140.9C144.9,-107.4,169,-70.7,184.5,-26.1C200,18.5,206.9,71,185.7,106.6C164.4,142.2,114.9,160.8,65.9,176.7C17,192.6,-31.4,205.8,-75.7,195.2C-120.1,184.6,-160.5,150.3,-194,105.6C-227.5,60.8,-254.1,5.7,-248.8,-47.2C-243.5,-100.1,-206.3,-150.8,-159.5,-181.7C-112.7,-212.6,-56.4,-223.8,-8,-214.2C40.3,-204.7,80.6,-174.3,112.7,-140.9Z" />
            </g>
        </svg>

        <svg class="absolute z-0 fill-current text-gray-300" style="top: 225px; right: -325px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M57.4,-47.4C68.1,-32.4,66,-8.9,57,6.1C48,21,32.2,27.5,14.6,39.6C-3,51.6,-22.4,69.2,-40.3,67C-58.1,64.8,-74.5,42.7,-76.9,20.8C-79.4,-1.2,-67.9,-23.1,-52.8,-39.1C-37.6,-55,-18.8,-65.1,2.3,-66.9C23.4,-68.7,46.8,-62.3,57.4,-47.4Z" transform="translate(100 100)" />
        </svg>

        <svg class="absolute z-0 fill-current text-gray-300" style="bottom: 225px; left: -325px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M35.7,-28.8C50,-21.4,68,-10.7,69.4,1.3C70.7,13.4,55.4,26.7,41,41.9C26.7,57,13.4,74,-2.3,76.2C-17.9,78.5,-35.7,66,-47.9,50.9C-60.2,35.7,-66.8,17.9,-68.7,-1.9C-70.5,-21.6,-67.7,-43.2,-55.5,-50.6C-43.2,-58,-21.6,-51.2,-5.5,-45.7C10.7,-40.3,21.4,-36.2,35.7,-28.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="absolute z-0 fill-current text-gray-300" style="bottom: 25px; right: -125px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M48,-40.2C62.4,-33.6,74.3,-16.8,76.6,2.3C78.9,21.4,71.5,42.7,57.1,49.3C42.7,55.9,21.4,47.8,1.3,46.5C-18.7,45.2,-37.5,50.7,-53.9,44.1C-70.3,37.5,-84.5,18.7,-84.1,0.4C-83.7,-18,-68.9,-36,-52.4,-42.6C-36,-49.2,-18,-44.3,-0.6,-43.7C16.8,-43.1,33.6,-46.8,48,-40.2Z" transform="translate(100 100)" />
        </svg>


        <div class="container px-5 py-4 mx-auto flex flex-col mt-20 lg:my-32">

            <div class="lg:w-4/6 mx-auto z-10">

                <div class="rounded-lg h-64 overflow-hidden shadow-lg mt-0 lg:mt-8 hidden md:block">

                    @if ($team->banner)
                        <img alt="content" class="object-cover object-center h-full w-full" src="{{ $team->banner }}">
                    @else
                        <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/720x600">
                    @endif

                </div>

                <div class="flex flex-col sm:flex-row mt-10">

                    <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">

                        @if ($team->logo)
                            <div class="rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                                <img src="{{ $team->logo }}" class="mr-3 rounded bg-gray-400" alt="logo {{ $team->name }}">
                            </div>
                        @endif

                        <div class="flex flex-col items-center text-center justify-center">

                            <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $team->name }}</h2>
                            <div class="w-12 h-1 bg-pink rounded mt-2 mb-4"></div>

                            <div class="flex items-center justify-center my-6">
                                <a href="{{ $team->facebook_account }}" target="_blank" class="text-gray-500">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>

                                <a href="{{ $team->twitter_account }}" target="_blank" class="ml-3 text-gray-500">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>

                                <a href="{{ $team->instagram_account }}" target="_blank" class="ml-3 text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                    </svg>
                                </a>
                            </div>

                            <p class="text-base text-gray-600">{{ $team->impact }}</p>
                        </div>


                    </div>

                    <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-300 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                        <p class="leading-relaxed text-lg mb-4">{{ $team->description }}</p>
                        <a href="#more" class="text-pink cursor-pointer font-semibold inline-flex items-center fill-current hover:text-deeppink">Mas sobre nosotros
                            <svg class="ml-1 h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </a>
                    </div>

                </div>

            </div>

            <div id="more" class="z-10">

                <section class="text-gray-700 body-font">
                    <div class="container px-5 py-4 mx-auto flex flex-wrap">
                        <div class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden">
                            @isset ($plans->first()->banner)
                                <img alt="Imagen de un aporte" class="object-cover object-center h-full w-full" src="{{ $plans->first()->banner }}">
                            @else
                                <img alt="Imagen de un aporte" class="object-cover object-center h-full w-full" src="https://dummyimage.com/460x500">
                            @endisset
                        </div>
                        <div class="flex flex-col flex-wrap lg:py-6 -mb-10 w-full lg:w-1/2 lg:pl-12 lg:text-left text-center">

                            @foreach ($plans as $plan)

                                <div class="flex flex-col mb-10 items-center lg:items-start">

                                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-white shadow mb-5">
                                        <div class="text-pink">
                                            <svg class="fill-current w-8" viewBox="0 0 1322 1062" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M996.085 738.03C1004.33 731.552 1022.89 729.392 1035.26 722.914C1047.63 716.435 1055.88 705.638 1060 697C1060 697 1022.89 707.797 996.085 705.638C973.405 705.638 981.652 753.147 996.085 738.03Z"/>
                                                <path d="M1246.86 198.872C1165.59 79.1211 1030.85 8.55363 885.418 8.55363C814.842 8.55363 744.265 25.6609 682.243 57.737C677.966 59.8754 673.689 62.0138 667.273 62.0138C660.857 62.0138 656.579 59.8754 652.302 57.737C588.141 19.2457 513.287 0 436.295 0C297.281 0 166.821 66.2906 83.4124 177.488C14.9746 271.578 -12.8283 387.052 4.28118 502.526C23.5293 618 83.4124 718.505 177.514 786.934L455.543 990.083C577.448 1075.62 680.105 1073.48 776.345 1041.4C791.316 1037.13 819.119 1022.16 849.061 1002.91C853.338 1000.78 857.615 998.637 861.893 994.36C864.031 992.221 866.17 992.221 866.17 990.083C885.418 977.253 900.389 962.284 915.36 947.315C947.44 910.962 966.688 868.194 945.301 840.395C936.747 829.702 923.914 825.426 908.944 833.979C891.834 844.671 891.834 861.779 885.418 872.471C868.309 898.132 834.09 898.132 823.396 883.163C812.703 872.471 821.258 853.225 838.367 844.671C849.061 840.394 859.754 829.702 861.893 819.01C868.309 789.073 814.842 780.519 769.929 823.287C748.542 842.533 742.126 848.948 731.433 855.363C720.74 859.64 710.046 863.917 703.63 863.917C690.798 866.055 675.827 863.917 669.411 861.779C660.857 859.64 654.44 857.502 637.331 846.81L573.171 799.765L312.251 605.17C267.339 570.955 237.398 521.772 226.704 466.173C218.149 410.574 230.981 352.837 265.2 307.931C305.835 254.471 369.996 220.256 436.295 220.256C481.207 220.256 526.12 235.225 562.477 260.886L641.608 318.623C648.024 322.9 656.579 327.176 665.134 327.176C673.689 327.176 682.243 325.038 688.659 318.623L763.513 265.163C799.871 241.64 840.506 228.81 883.279 228.81C953.856 228.81 1020.16 263.024 1060.79 322.9C1092.87 369.945 1103.56 423.405 1095.01 474.727C1086.45 530.325 1056.51 583.785 1005.18 620.138L979.52 637.246C964.549 652.215 973.104 680.014 994.491 682.152C1009.46 684.291 1026.57 675.737 1026.57 675.737C1052.24 660.768 1082.18 686.429 1047.96 720.644C1028.71 739.889 998.768 731.336 988.075 750.581C981.659 761.273 981.659 774.104 990.214 780.519C1022.29 814.734 1139.92 784.796 1227.61 692.844C1261.83 658.63 1285.35 620.138 1300.32 570.955C1304.6 553.848 1308.88 538.879 1313.15 521.772C1336.68 410.574 1311.02 295.1 1246.86 198.872Z"/>
                                                <path d="M885.416 816.872C861.891 825.426 870.445 878.886 846.92 887.44C846.92 887.44 851.197 887.44 855.475 885.301C855.475 885.301 874.723 878.886 881.139 861.779C887.555 842.533 889.694 833.98 906.803 827.564C908.942 827.564 904.664 808.319 885.416 816.872Z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-grow">

                                        @if ($plan->title)
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">{{ $plan->title }}</h2>
                                        @else
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">No hay aportes disponibles.</h2>
                                        @endif

                                        @if ($plan->description)
                                            <p class="leading-relaxed text-base">{{ $plan->description }}</p>
                                        @endif

                                        <a href="#" class="mt-3 text-pink inline-flex items-center cursor-pointer">
                                            Donar Q @money($plan->amount_in_local_currency)
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>

            </div>

        </div>

    </section>

    <x-landing.footer />

@endsection

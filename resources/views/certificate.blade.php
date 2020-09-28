@extends('layout')

@section('content')

<div class="h-auto xl:h-screen w-full bg-gray-100 relative overflow-x-hidden">

    <x-landing.navbar-green />

    <svg class="hidden lg:block absolute fill-current text-gray-300 z-0" style="top: -125px; left: -25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M112.7,-140.9C144.9,-107.4,169,-70.7,184.5,-26.1C200,18.5,206.9,71,185.7,106.6C164.4,142.2,114.9,160.8,65.9,176.7C17,192.6,-31.4,205.8,-75.7,195.2C-120.1,184.6,-160.5,150.3,-194,105.6C-227.5,60.8,-254.1,5.7,-248.8,-47.2C-243.5,-100.1,-206.3,-150.8,-159.5,-181.7C-112.7,-212.6,-56.4,-223.8,-8,-214.2C40.3,-204.7,80.6,-174.3,112.7,-140.9Z" />
        </g>
    </svg>

    <svg class="hidden lg:block text-gray-300 fill-current absolute z-0" style="bottom: -100px; left: -300px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path d="M39.2,-40.8C54.4,-33.9,72.8,-25,74.4,-13.5C75.9,-2.1,60.5,12,48.3,23.1C36.2,34.3,27.4,42.5,17.1,45.8C6.8,49.1,-4.9,47.4,-14.8,42.9C-24.7,38.4,-32.8,31,-43.3,21C-53.8,11.1,-66.6,-1.5,-67.8,-14.9C-69,-28.4,-58.4,-42.7,-45.2,-50C-32,-57.2,-16,-57.2,-2,-54.8C12,-52.5,24,-47.6,39.2,-40.8Z" transform="translate(100 100)" />
    </svg>

    <svg class="hidden lg:block text-gray-300 fill-current absolute z-0" style="bottom: -100px; right: 200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path d="M36.1,-41.3C46.5,-34.2,54.7,-22.6,59.8,-8.4C64.8,5.8,66.8,22.7,60,34.8C53.2,46.8,37.7,54,22.3,58.4C6.8,62.9,-8.7,64.6,-19.6,58.6C-30.6,52.6,-37,38.8,-45.2,25.6C-53.3,12.4,-63.3,-0.3,-63,-12.7C-62.8,-25.2,-52.3,-37.5,-40.1,-44.3C-27.9,-51.1,-13.9,-52.5,-0.6,-51.8C12.8,-51.1,25.6,-48.4,36.1,-41.3Z" transform="translate(100 100)" />
    </svg>

    <svg class="hidden lg:block absolute fill-current text-gray-300 z-0" style="top: -200px; right: -140px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M127,-142.3C156.7,-126.4,167.5,-78.9,180.8,-28.2C194.2,22.5,210.1,76.5,195.3,122.6C180.4,168.8,134.9,207,88.7,208.4C42.6,209.9,-4,174.5,-55,154.4C-105.9,134.4,-161.2,129.7,-194.1,99.2C-227.1,68.7,-237.6,12.5,-231.3,-43.8C-225,-100.2,-201.9,-156.6,-160.5,-170.4C-119.1,-184.3,-59.6,-155.7,-5.5,-149.1C48.6,-142.6,97.3,-158.3,127,-142.3Z" />
        </g>
    </svg>

    <div class="container mx-auto">

        <div class="flex items-center justify-center">

            <div class="printable-certificate mt-32 md:mt-48 mb-20 mx-0 p-5 text-center border-8 border-melon w-full lg:max-w-screen-lg z-10 bg-white" style="height:600px;">

                <div class="text-center p-5 border-4 border-red-500" style="height:550px;">
                    <div class="flex items-center justify-center my-4 lg:my-2">
                        <div class="text-pink">
                            <svg class="fill-current w-8 lg:h-16 lg:w-16 mr-4" viewBox="0 0 1322 1062" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M996.085 738.03C1004.33 731.552 1022.89 729.392 1035.26 722.914C1047.63 716.435 1055.88 705.638 1060 697C1060 697 1022.89 707.797 996.085 705.638C973.405 705.638 981.652 753.147 996.085 738.03Z"/>
                                <path d="M1246.86 198.872C1165.59 79.1211 1030.85 8.55363 885.418 8.55363C814.842 8.55363 744.265 25.6609 682.243 57.737C677.966 59.8754 673.689 62.0138 667.273 62.0138C660.857 62.0138 656.579 59.8754 652.302 57.737C588.141 19.2457 513.287 0 436.295 0C297.281 0 166.821 66.2906 83.4124 177.488C14.9746 271.578 -12.8283 387.052 4.28118 502.526C23.5293 618 83.4124 718.505 177.514 786.934L455.543 990.083C577.448 1075.62 680.105 1073.48 776.345 1041.4C791.316 1037.13 819.119 1022.16 849.061 1002.91C853.338 1000.78 857.615 998.637 861.893 994.36C864.031 992.221 866.17 992.221 866.17 990.083C885.418 977.253 900.389 962.284 915.36 947.315C947.44 910.962 966.688 868.194 945.301 840.395C936.747 829.702 923.914 825.426 908.944 833.979C891.834 844.671 891.834 861.779 885.418 872.471C868.309 898.132 834.09 898.132 823.396 883.163C812.703 872.471 821.258 853.225 838.367 844.671C849.061 840.394 859.754 829.702 861.893 819.01C868.309 789.073 814.842 780.519 769.929 823.287C748.542 842.533 742.126 848.948 731.433 855.363C720.74 859.64 710.046 863.917 703.63 863.917C690.798 866.055 675.827 863.917 669.411 861.779C660.857 859.64 654.44 857.502 637.331 846.81L573.171 799.765L312.251 605.17C267.339 570.955 237.398 521.772 226.704 466.173C218.149 410.574 230.981 352.837 265.2 307.931C305.835 254.471 369.996 220.256 436.295 220.256C481.207 220.256 526.12 235.225 562.477 260.886L641.608 318.623C648.024 322.9 656.579 327.176 665.134 327.176C673.689 327.176 682.243 325.038 688.659 318.623L763.513 265.163C799.871 241.64 840.506 228.81 883.279 228.81C953.856 228.81 1020.16 263.024 1060.79 322.9C1092.87 369.945 1103.56 423.405 1095.01 474.727C1086.45 530.325 1056.51 583.785 1005.18 620.138L979.52 637.246C964.549 652.215 973.104 680.014 994.491 682.152C1009.46 684.291 1026.57 675.737 1026.57 675.737C1052.24 660.768 1082.18 686.429 1047.96 720.644C1028.71 739.889 998.768 731.336 988.075 750.581C981.659 761.273 981.659 774.104 990.214 780.519C1022.29 814.734 1139.92 784.796 1227.61 692.844C1261.83 658.63 1285.35 620.138 1300.32 570.955C1304.6 553.848 1308.88 538.879 1313.15 521.772C1336.68 410.574 1311.02 295.1 1246.86 198.872Z"/>
                                <path d="M885.416 816.872C861.891 825.426 870.445 878.886 846.92 887.44C846.92 887.44 851.197 887.44 855.475 885.301C855.475 885.301 874.723 878.886 881.139 861.779C887.555 842.533 889.694 833.98 906.803 827.564C908.942 827.564 904.664 808.319 885.416 816.872Z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xl sm:text-2xl uppercase tracking-tighter font-bold text-pink">@lang('Certificate of Donation')</span><br><br>
                    <span class="text-xl uppercase text-light font-display tracking-widest">@lang('Recaudar agradece a')</span>
                    <br><br>
                    <span class="mt-5 block text-xl md:text-2xl lg:text-5xl text-pink uppercase"><b>{{ $transaction->name }}</b></span><br/><br/>
                    <span class="mt-1 block text-xl text-light font-display tracking-wide">@lang('Por su invaluable apoyo para cambiar el mundo.')</span> <br/><br/>
                    <span class="text-sm sm:text-xl"><i>{{ $certificateDate }}</i></span> <br><br>
                    <span class="text-md tracking-tighter font-display">"@lang('Solo la caridad salvara al mundo')"</span> <span class="text-sm tracking-tight font-display ml-1"> - Don Orione</span>
                </div>
            </div>

        </div>

    </div>

    <button onclick="window.print()" class="bg-pink text-white rounded-lg shadow-xl py-2 px-4 fixed bottom-0 right-0 z-10 mb-56 mr-8 flex hover:bg-melon cursor-pointer no-print focus:outline-none focus:shadow-outline">
        <div class="text-white mr-2">
            <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"></path></svg>
        </div>
        @lang('Print')
    </button>

    <x-landing.footer />

</div>

@endsection

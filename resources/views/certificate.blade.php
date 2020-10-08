@extends('layout')

@section('content')

<div class="h-auto xl:h-screen w-full bg-gray-100 relative overflow-x-hidden">

    <x-navbar-pink />

    <x-blobs />

    <div class="container mx-auto">

        <div id="certificate" class="flex items-center justify-center">

            <div class="printable-certificate my-5 lg:my-20 mx-0 p-2 lg:p-5 text-center border-8 border-melon w-full lg:max-w-screen-lg z-10 bg-white">

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
                    <span class="block text-xl sm:text-2xl uppercase tracking-tighter font-bold text-pink my-6">@lang('Certificate of Donation')</span>
                    <span class="block text-md lg:text-xl uppercase text-light font-display tracking-widest my-6">@lang('Recaudar agradece a')</span>
                    <span class="block mt-5 text-xl md:text-2xl lg:text-5xl text-pink uppercase"><b>{{ $transaction->name }}</b></span><br/><br/>
                    <span class="block text-md lg:text-xl mt-1 block text-light font-display tracking-wide my-6">@lang('Por su invaluable apoyo para cambiar el mundo.')</span>
                    <span class="block text-sm sm:text-xl my-2 lg:my-4"><i>{{ $certificateDate }}</i></span>
                    <span class="block text-sm lg:text-xl tracking-tighter font-display">"@lang('Solo la caridad salvara al mundo')"</span> <span class="text-sm tracking-tight font-display ml-1"> - Don Orione</span>
                </div>
            </div>

        </div>

    </div>

    <x-share-buttons :transaction="$transaction" :team="$team" />

    <x-footer />

</div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/mathusummut/confetti.js/confetti.min.js"></script><script>confetti.start(3000)</script>

    <script>
        function printCertificate() {
            const printContents = document.getElementById('certificate').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function copyLinkToClipboard() {
            const route = '{{ route('certificate', ['transaction' => $transaction, 'team' => $team]) }}'
            const el = document.createElement('input');
            el.value = route;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }
    </script>
@endpush

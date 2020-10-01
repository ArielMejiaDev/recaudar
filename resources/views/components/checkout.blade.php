{{--Floating button--}}
<button @click="showModal = !showModal;planId = '';selectedAmount = ''" class="fixed bottom-0 right-0 m-2 lg:m-12 bg-melon rounded-lg py-2 px-4 text-white shadow-xl flex font-body hover:bg-pink z-10 focus:outline-none focus:shadow-outline">
    <div class="text-white mr-2">
        <svg class="fill-current w-8" viewBox="0 0 1322 1062" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M996.085 738.03C1004.33 731.552 1022.89 729.392 1035.26 722.914C1047.63 716.435 1055.88 705.638 1060 697C1060 697 1022.89 707.797 996.085 705.638C973.405 705.638 981.652 753.147 996.085 738.03Z"/>
            <path d="M1246.86 198.872C1165.59 79.1211 1030.85 8.55363 885.418 8.55363C814.842 8.55363 744.265 25.6609 682.243 57.737C677.966 59.8754 673.689 62.0138 667.273 62.0138C660.857 62.0138 656.579 59.8754 652.302 57.737C588.141 19.2457 513.287 0 436.295 0C297.281 0 166.821 66.2906 83.4124 177.488C14.9746 271.578 -12.8283 387.052 4.28118 502.526C23.5293 618 83.4124 718.505 177.514 786.934L455.543 990.083C577.448 1075.62 680.105 1073.48 776.345 1041.4C791.316 1037.13 819.119 1022.16 849.061 1002.91C853.338 1000.78 857.615 998.637 861.893 994.36C864.031 992.221 866.17 992.221 866.17 990.083C885.418 977.253 900.389 962.284 915.36 947.315C947.44 910.962 966.688 868.194 945.301 840.395C936.747 829.702 923.914 825.426 908.944 833.979C891.834 844.671 891.834 861.779 885.418 872.471C868.309 898.132 834.09 898.132 823.396 883.163C812.703 872.471 821.258 853.225 838.367 844.671C849.061 840.394 859.754 829.702 861.893 819.01C868.309 789.073 814.842 780.519 769.929 823.287C748.542 842.533 742.126 848.948 731.433 855.363C720.74 859.64 710.046 863.917 703.63 863.917C690.798 866.055 675.827 863.917 669.411 861.779C660.857 859.64 654.44 857.502 637.331 846.81L573.171 799.765L312.251 605.17C267.339 570.955 237.398 521.772 226.704 466.173C218.149 410.574 230.981 352.837 265.2 307.931C305.835 254.471 369.996 220.256 436.295 220.256C481.207 220.256 526.12 235.225 562.477 260.886L641.608 318.623C648.024 322.9 656.579 327.176 665.134 327.176C673.689 327.176 682.243 325.038 688.659 318.623L763.513 265.163C799.871 241.64 840.506 228.81 883.279 228.81C953.856 228.81 1020.16 263.024 1060.79 322.9C1092.87 369.945 1103.56 423.405 1095.01 474.727C1086.45 530.325 1056.51 583.785 1005.18 620.138L979.52 637.246C964.549 652.215 973.104 680.014 994.491 682.152C1009.46 684.291 1026.57 675.737 1026.57 675.737C1052.24 660.768 1082.18 686.429 1047.96 720.644C1028.71 739.889 998.768 731.336 988.075 750.581C981.659 761.273 981.659 774.104 990.214 780.519C1022.29 814.734 1139.92 784.796 1227.61 692.844C1261.83 658.63 1285.35 620.138 1300.32 570.955C1304.6 553.848 1308.88 538.879 1313.15 521.772C1336.68 410.574 1311.02 295.1 1246.86 198.872Z"/>
            <path d="M885.416 816.872C861.891 825.426 870.445 878.886 846.92 887.44C846.92 887.44 851.197 887.44 855.475 885.301C855.475 885.301 874.723 878.886 881.139 861.779C887.555 842.533 889.694 833.98 906.803 827.564C908.942 827.564 904.664 808.319 885.416 816.872Z"/>
        </svg>
    </div>
    Donar otro monto
</button>
{{--End Floating button--}}

{{--Checkout modal--}}
<div x-cloak x-show.transition="showModal" class="bg-gray-900 bg-opacity-75 fixed inset-0 z-40 flex items-center justify-center">
    <div x-on:click.away="showModal = !showModal" class="leading-loose">
        <form method="POST" @submit.prevent="submit()" id="checkout" class="w-full max-w-xl bg-white rounded shadow-xl relative">
            @csrf
            <div @click="showModal = !showModal" class="absolute top-0 right-0 px-6 py-4 text-gray-500 cursor-pointer">
                <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="text-gray-900 text-2xl font-medium p-3 text-center flex flex-col items-center justify-center">
                <img class="h-20 w-20 rounded-full shadow-xl border-4 border-gray-400" src="{{ $team->logo }}" alt="logo">
                <p class="mt-4">Customer information</p>
                <div class="hidden lg:flex font-medium text-xs uppercase flex text-gray-500">
                    <div class="mx-2">Select a foundation</div>
                    <div class="mx-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="mx-2">Pick a plan</div>
                    <div class="mx-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="mx-2 text-gray-800 font-bold">Checkout</div>
                </div>
            </div>
            <div class="p-2 md:p-8">

                {{--Error Alerts--}}
                <div class="text-red-500 text-xs text-center font-bold mb-4 p-2 uppercase w-full rounded-lg bg-red-100" x-show="errors.transaction" x-text="errors.transaction"></div>
                <div class="text-red-500 text-xs text-center font-bold mb-4 p-2 uppercase w-full rounded-lg bg-red-100" x-show="errors.amount" x-text="errors.amount"></div>
                <div class="text-red-500 text-xs text-center font-bold mb-4 p-2 uppercase w-full rounded-lg bg-red-100" x-show="errors.deviceFingerprintID" x-text="errors.deviceFingerprintID"></div>
                {{--End Error Alerts--}}

                <div class="bg-gray-200 rounded py-2">

                    <div class="p-4 rounded-t-lg text-gray-800 w-full flex justify-between border-b border-gray-300">
                        <span>Credit Card</span>
                        <div class="flex">
                            <img class="h-10 w-10 object-contain mr-2" src="{{ asset('images/checkout/visa.svg') }}" alt="Visa">
                            <img class="h-10 w-10 object-contain" src="{{ asset('images/checkout/mastercard.svg') }}" alt="Master card">
                        </div>
                    </div>

                    <input type="hidden" id="currency" value="{{ $locale->currencyCode() }}">

                    <div class="my-2 p-2">
                        <input x-model="email" class="w-full px-5 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:bg-white focus:outline-none" id="email" name="email" type="email" placeholder="Email">
                        <p class="text-red-500 text-xs font-bold my-1" x-show="errors.email" x-text="errors.email"></p>
                    </div>

                    <div class="my-2 p-2">
                        <input x-model="name" class="w-full px-5 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:bg-white focus:outline-none" id="name" name="name" type="text" placeholder="Name">
                        <p class="text-red-500 text-xs font-bold my-1" x-show="errors.name" x-text="errors.name"></p>
                    </div>

                    <div class="block mt-4 mx-2 text-gray-800 font-medium text-xs">Payment information</div>

                    <div class="w-full">
                        <div class="flex my-2 p-2">
                            <input x-model="card" type="text" id="card" class="w-5/6 border-t border-b border-l border-gray-300 flex-1 text-sm bg-gray-100 text-gray-700 p-3 rounded-l focus:bg-white focus:outline-none" placeholder="Card Number">
                            <input x-model="date" type="text" id="date" class="w-1/6 border-t border-b border-gray-300 inline-block text-sm bg-gray-100 text-gray-700 p-3 focus:bg-white focus:outline-none" placeholder="MM / YY">
                            <input x-model="cvc" type="text" id="cvc" class="w-1/6 border-t border-b border-r border-gray-300 inline-block text-sm bg-gray-100 text-gray-700 p-3 focus:bg-white rounded-r focus:outline-none" placeholder="CVC">
                        </div>
                        <div class="flex">
                            <p class="text-red-500 text-xs font-bold m-1" x-show="errors.card" x-text="errors.card"></p>
                            <p class="text-red-500 text-xs font-bold m-1" x-show="errors.date" x-text="errors.date"></p>
                            <p class="text-red-500 text-xs font-bold m-1" x-show="errors.cvc" x-text="errors.cvc"></p>
                        </div>
                    </div>

                    <div x-show="!planId" class="my-2 p-2">
                        <input x-model="selectedAmount" type="number" class="w-full px-3 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded focus:outline-none" placeholder="Add an amount to donate">
                    </div>

                    <div class="my-2 p-2">
                        <input x-model="recurrence" type="checkbox" class="form-check mr-4" id="recurrence">
                        <label for="recurrence">Quiero donar todos los meses.</label>
                    </div>

                </div>
                <div class="mt-4">
                    <div class="w-full h-20">
                        <button x-bind:disabled="submitting" x-show.transition="!submitting" class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded-lg uppercase w-full focus:outline-none focus:shadow-outline" type="submit" x-text="money_format(selectedAmount)"></button>
                        <p class="text-gray-900 leading-loose tracking-wider font-medium" x-show.transition="submitting" x-text="submittingText"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{--End Checkout modal--}}

@push('scripts')
    <script>
        // DeviceFingerPrint
        const merchantID  = 'visanetgt_jupiter'
        var environment = "{{  config('pagalogt.environment') }}"
        environment = environment.toLowerCase
        // DeviceFingerPrint
        const deviceFingerprintID = cybs_dfprofiler(`${merchantID}`,`${environment}`);
        function cybs_dfprofiler(merchantID, environment) {
            if (environment.toLowerCase() == 'live') {
                var org_id = 'k8vif92e'
            } else {
                var org_id = '1snn5n9w'
            }
            var sessionID = new Date().getTime()
            //One-Pixel Image Code
            var paragraphTM = document.createElement("p")
            str = "";
            str = "background:url(https://h.online-metrix.net/fp/clear.png?org_id=" + org_id + "&session_id=" + merchantID + sessionID + "&m=1)"
            paragraphTM.styleSheets = str
            document.body.appendChild(paragraphTM)
            var img = document.createElement("img")
            str = "https://h.online-metrix.net/fp/clear.png?org_id=" + org_id + "&session_id=" + merchantID + sessionID + "&m=2"
            img.src = str
            img.alt = ""
            document.body.appendChild(img)
            //Flash Code
            var objectTM = document.createElement("object")
            objectTM.data = "https://h.online-metrix.net/fp/fp.swf?org_id=" + org_id + "&session_id=" + merchantID + sessionID
            objectTM.type = "application/x-shockwave-flash"
            objectTM.width = "1"
            objectTM.height = "1"
            objectTM.id = "thm_fp"
            var param = document.createElement("param")
            param.name = "movie"
            param.value = "https://h.online-metrix.net/fp/fp.swf?org_id=" + org_id + "&session_id=" + merchantID + sessionID
            objectTM.appendChild(param)
            document.body.appendChild(objectTM)
            //JavaScript Code
            var tmscript = document.createElement("script")
            tmscript.src = "https://h.online-metrix.net/fp/tags.js?org_id=" + org_id + "&session_id=" + merchantID + sessionID
            tmscript.type = "text/javascript"
            document.body.appendChild(tmscript)
            return sessionID
        }
        // End DeviceFingerPrint

        // Checkout form
        function form() {
            return {
                toggle: {{ $team->availablePlans()->first()->id }},
                email: '',
                name: '',
                card: '',
                date: '',
                cvc: '',
                recurrence: '',
                selectedAmount: '',
                submitting: false,
                showModal: false,
                errors: {},
                planId: '',
                submittingText: 'Loading...',
                money_format(value) {
                    const amount = parseInt(value) || 0;
                    return new Intl.NumberFormat('{{ $locale->countryCode() }}', {
                        style: 'currency',
                        currency: '{{ $locale->currencyCode() }}',
                        minimumFractionDigits: 2
                    }).format(amount)
                },
                selectPlan(plan) {
                    this.planId = plan.id;
                    this.selectedAmount = plan.amount_in_local_currency;
                    this.showModal = ! this.showModal;
                },
                submit() {
                    this.submitting = true;
                    const planId = this.planId || {{ $variablePlanId }};
                    fetch(`/pay/${planId}`, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": document.querySelector('input[name="_token"]').value,
                        },
                        method: 'POST',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            name: this.name,
                            email: this.email,
                            card: this.card,
                            date: this.date,
                            cvc: this.cvc,
                            currency: document.getElementById('currency').value,
                            amount: this.selectedAmount,
                            recurrence: this.recurrence || 0,
                            deviceFingerprintID: deviceFingerprintID,
                        }) })
                        .then(response => response.json()
                            .then(data => {
                                if(data.errors) {
                                    return this.errors = data.errors;
                                }
                                return window.location.href = data.redirect;
                            })
                        )
                        .catch(errors => console.log(errors.response.data.errors))
                        .finally(() => this.submitting = false);
                }
            }
        }
        // End Checkout Form
    </script>
@endpush

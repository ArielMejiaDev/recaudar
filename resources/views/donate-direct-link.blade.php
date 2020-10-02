@extends('layout')

@section('content')

    <section x-data="form()" class="h-auto text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-center bg-gray-200">

        <x-landing.navbar-dark />

        <x-landing.blobs />

        <div class="container px-5 py-24 mx-auto mt-20 relative z-10">
            <form method="POST" @submit.prevent="submit()" id="checkout" class="w-full max-w-xl bg-white rounded shadow-xl relative mx-auto">
                @csrf
                <div class="text-gray-900 text-2xl font-medium p-3 text-center flex flex-col items-center justify-center">
                    @if ($team->logo)
                        <img class="h-20 w-20 rounded-full shadow-xl border-4 border-gray-400" src="{{ $team->logo }}" alt="logo">
                    @else
                        <p class="my-1">{{ $team->name }}</p>
                    @endif
                    <p class="mt-4 mb-6 {{ !$team->logo ? 'text-lg text-gray-600' : null }}">Customer information</p>
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

                    {{--Inputs--}}
                    <div class="bg-gray-200 rounded py-2">

                        {{--Card logos--}}
                        <div class="p-4 rounded-t-lg text-gray-800 w-full flex justify-between border-b border-gray-300">
                            <span>Credit Card</span>
                            <div class="flex">
                                <img class="h-10 w-10 object-contain mr-2" src="{{ asset('images/checkout/visa.svg') }}" alt="Visa">
                                <img class="h-10 w-10 object-contain" src="{{ asset('images/checkout/mastercard.svg') }}" alt="Master card">
                            </div>
                        </div>
                        {{--End Card logos--}}

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
                                <input x-model="cvc" type="text" id="cvc" class="w-1/6 border-t border-b border-r border-gray-300 inline-block text-sm bg-gray-100 text-gray-700 p-3 rounded-r focus:bg-white focus:outline-none" placeholder="CVC">
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
                    {{--End Inputs--}}

                    <div class="w-full h-20 mt-4">
                        <button x-bind:disabled="submitting" x-show.transition="!submitting" class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded-lg uppercase w-full focus:outline-none focus:shadow-outline" type="submit" x-text="money_format(selectedAmount)"></button>
                        <p class="text-gray-900 leading-loose tracking-wider font-medium" x-show.transition="submitting" x-text="submittingText"></p>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <x-landing.footer />

@endsection

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
                toggle: {{ $team->availablePlans()->first()->id ?? $variablePlanId }},
                email: '',
                name: '',
                card: '',
                date: '',
                cvc: '',
                recurrence: '',
                selectedAmount: '{{ $amount }}',
                submitting: false,
                showModal: false,
                errors: {},
                planId: '{{ $plan->id }}',
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

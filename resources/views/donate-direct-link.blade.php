@extends('layout')

@section('content')

    <x-navbar-pink />

    <section x-data="form()" class="h-auto text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-center bg-gray-200">

        <x-landing.blobs />

        <div class="container mx-auto my-4 lg:my-8">
            <form method="POST" @submit.prevent="submit()" id="checkout" class="w-full max-w-xl mx-auto bg-white rounded shadow-xl relative py-4">
                @csrf
                <div class="text-gray-900 font-medium text-xs text-center flex flex-col items-center justify-center">
                    @if ($team->logo)
                        <img class="h-20 w-20 rounded-full shadow-xl border-4 border-gray-400" src="{{ $team->logo }}" alt="logo">
                    @else
                        <p class="my-1">{{ $team->name }}</p>
                    @endif
                    <p class="mx-2 my-3 {{ !$team->logo ? 'text-xs lg:text-lg text-gray-600' : null }}">
                        {{ trans('Customer information') }}
                    </p>
                    <div class="hidden lg:flex font-medium text-xs flex text-gray-500">
                        <div class="mx-2">{{ trans('Select a foundation') }}</div>
                        <div class="mx-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="mx-2">{{ trans('Pick a plan') }}</div>
                        <div class="mx-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="mx-2 text-gray-800 font-bold">{{ trans('Checkout') }}</div>
                    </div>
                </div>
                <div class="py-2 px-4 md:px-8">

                    {{--Error Alerts--}}
                    <div class="text-red-500 text-xs text-center font-bold mb-2 p-1 uppercase w-full rounded-lg bg-red-100" x-cloak x-show="errors.transaction" x-text="errors.transaction"></div>
                    <div class="text-red-500 text-xs text-center font-bold mb-2 p-1 uppercase w-full rounded-lg bg-red-100" x-cloak x-show="errors.deviceFingerprintID" x-text="errors.deviceFingerprintID"></div>
                    {{--End Error Alerts--}}

                    <div class="bg-gray-200 rounded py-2">

                        <div class="rounded-t-lg text-xs text-gray-800 w-full flex items-center justify-between border-b border-gray-300">
                            <span class="block ml-2 font-semibold">{{ trans('Credit card') }}</span>
                            <div class="flex">
                                <img class="h-10 w-10 object-contain mr-2" src="{{ asset('images/checkout/visa.svg') }}" alt="Visa">
                                <img class="h-10 w-10 object-contain" src="{{ asset('images/checkout/mastercard.svg') }}" alt="Master card">
                            </div>
                        </div>

                        <input type="hidden" id="currency" required value="{{ $locale->currencyCode() }}">

                        <div class="my-1 p-2">
                            <input x-model="email" id="email" name="email" type="email" placeholder="{{ trans('Email') }}" required class="w-full px-2 py-1 lg:px-4 lg:py-2 text-gray-700 bg-gray-100 text-xs lg:text-sm border border-gray-300 rounded-lg focus:outline-none focus:bg-white">
                            <p class="text-red-500 text-xs font-bold my-1" x-show="errors.email" x-text="errors.email"></p>
                        </div>

                        <div class="block m-1 mx-2 text-gray-800 font-medium text-xs">{{ trans('Payment information') }}</div>

                        <div class="mb-1 p-2">
                            <input x-model="name" id="name" name="name" type="text" placeholder="{{ trans('Name card') }}" required class="w-full px-2 py-1 lg:px-4 lg:py-2 text-gray-700 bg-gray-100 text-xs lg:text-sm border border-gray-300 rounded-lg focus:outline-none focus:bg-white">
                            <p class="text-red-500 text-xs font-bold my-1" x-show="errors.name" x-text="errors.name"></p>
                        </div>

                        <div class="w-full">
                            <div class="flex my-1 p-2">
                                <input x-model="card" type="text" id="card" required class="w-5/6 border-t border-b border-l border-gray-300 flex-1 text-xs lg:text-sm py-1 lg:py-2 px-2 lg:px-4 bg-gray-100 text-gray-700 rounded-l-lg focus:bg-white focus:outline-none" placeholder="{{ trans('Card number') }}">
                                <input x-model="month" type="text" id="month" required maxlength="2" class="w-1/6 border-t border-b border-gray-300 inline-block text-xs lg:text-sm py-1 lg:py-2 px-2 lg:px-4 bg-gray-100 text-gray-700 focus:bg-white focus:outline-none" placeholder="MM">
                                <input x-model="year" type="text" id="year" required maxlength="2" class="w-1/6 border-t border-b border-gray-300 inline-block text-xs lg:text-sm py-1 lg:py-2 px-2 lg:px-4 bg-gray-100 text-gray-700 focus:bg-white focus:outline-none" placeholder="YY">
                                <input x-model="cvc" type="text" id="cvc" required maxlength="3" class="w-1/6 border-t border-b border-r border-gray-300 inline-block text-xs lg:text-sm py-1 lg:py-2 px-2 lg:px-4 bg-gray-100 text-gray-700 focus:bg-white rounded-r-lg focus:outline-none" placeholder="CVC">
                            </div>
                            <div class="flex">
                                <span class="text-red-500 text-xs font-bold m-1" x-show="errors.card" x-text="errors.card"></span>
                                <span class="block lg:hidden text-red-500 text-xs font-bold mt-1 mr-1 flex flex-col" x-cloak x-show="errors.month || errors.year">@lang('The field date has an invalid format.')</span>
                                <span class="hidden lg:block text-red-500 text-xs font-bold mt-1 mx-1" x-show="errors.month" x-text="errors.month"></span>
                                <span class="hidden lg:block text-red-500 text-xs font-bold mt-1 mx-1" x-show="errors.year" x-text="errors.year"></span>
                                <span class="text-red-500 text-xs font-bold mt-1 ml-1" x-show="errors.cvc" x-text="errors.cvc"></span>
                            </div>
                        </div>

                        @if(!$amount)
                            <div class="my-1 p-2">
                                <input x-model="selectedAmount" type="number" class="w-full text-xs lg:text-sm py-1 lg:py-2 px-2 lg:px-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:bg-white" placeholder="{{ trans('Add an amount to donate.') }}">
                                <small class="text-red-500 text-xs font-bold mt-1" x-show="errors.amount" x-text="errors.amount"></small>
                            </div>
                        @endif

                        <div class="my-1 p-2">
                            <input x-model="recurrence" type="checkbox" class="form-check mr-4" id="recurrence">
                            <label for="recurrence" class="text-xs lg:text-sm">{{ trans('I want to donate every month.') }}</label>
                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="w-full">
                            <button x-bind:disabled="submitting" x-show.transition="!submitting" class="h-auto lg:h-12 text-xs py-1 lg:py-2 px-2 lg-px-4 text-white font-light tracking-wider bg-gray-900 rounded-lg uppercase w-full focus:outline-none focus:shadow-outline" type="submit" x-text="submitCheckoutText + money_format(selectedAmount)"></button>
                            <p class="text-gray-900 leading-loose tracking-wider font-medium" x-show.transition="submitting" x-text="submittingText"></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <x-footer />

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
                month: '',
                year: '',
                cvc: '',
                recurrence: '',
                selectedAmount: '{{ $amount ?? '' }}',
                submitting: false,
                showModal: false,
                errors: {},
                planId: '{{ $plan->id }}',
                submittingText: '{{ trans('Processing payment...') }}',
                submitCheckoutText: '{{ trans('Pay') }} ',
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
                            month: this.month,
                            year: this.year,
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

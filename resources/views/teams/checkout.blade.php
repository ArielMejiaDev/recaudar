@extends('layout')

@section('content')

    <section class="text-gray-700 bg-gray-200 body-font overflow-hidden relative flex flex-col items-center justify-center">

        <x-landing.navbar-dark/>

        <svg class="text-gray-300 fill-current absolute z-0" style="top: -100px; right: -200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.1,-46.1C54.7,-35.4,71.4,-25.5,72.8,-13.4C74.3,-1.4,60.5,12.8,51.3,30.4C42.1,47.9,37.4,68.9,25.4,76C13.3,83.2,-6,76.5,-19.1,65.9C-32.2,55.3,-39,40.9,-46,27.3C-53,13.7,-60.2,0.9,-62.4,-15.2C-64.6,-31.4,-61.8,-50.9,-50.6,-62.2C-39.4,-73.5,-19.7,-76.7,-3.5,-72.5C12.7,-68.3,25.4,-56.8,40.1,-46.1Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -100px; left: -300px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.2,-40.8C54.4,-33.9,72.8,-25,74.4,-13.5C75.9,-2.1,60.5,12,48.3,23.1C36.2,34.3,27.4,42.5,17.1,45.8C6.8,49.1,-4.9,47.4,-14.8,42.9C-24.7,38.4,-32.8,31,-43.3,21C-53.8,11.1,-66.6,-1.5,-67.8,-14.9C-69,-28.4,-58.4,-42.7,-45.2,-50C-32,-57.2,-16,-57.2,-2,-54.8C12,-52.5,24,-47.6,39.2,-40.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -300px; right: 200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M36.1,-41.3C46.5,-34.2,54.7,-22.6,59.8,-8.4C64.8,5.8,66.8,22.7,60,34.8C53.2,46.8,37.7,54,22.3,58.4C6.8,62.9,-8.7,64.6,-19.6,58.6C-30.6,52.6,-37,38.8,-45.2,25.6C-53.3,12.4,-63.3,-0.3,-63,-12.7C-62.8,-25.2,-52.3,-37.5,-40.1,-44.3C-27.9,-51.1,-13.9,-52.5,-0.6,-51.8C12.8,-51.1,25.6,-48.4,36.1,-41.3Z" transform="translate(100 100)" />
        </svg>

        <div class="container px-5 lg:py-24 mx-auto relative z-10 mt-10 xl:-mt-20">

            <div class="flex flex-col-reverse lg:flex-row w-full">

                <div class="lg:w-4/6 min-h-full mx-auto flex flex-wrap mx-8 mb-10 lg:mb-0">

                    <form onsubmit="disabledSubmitBtn()" method="POST" action="#" class="w-full h-full lg:py-6 mt-6 lg:mt-0 bg-white rounded-lg pt-4 px-8 shadow">

                        @csrf

                        <div class="flex items-end justify-between mb-4 border-b-2 border-gray-400">

                            <div class="flex flex-col">
                                <h2 class="text-sm title-font text-gray-500 tracking-widest">Checkout</h2>
                            </div>

                        </div>

                        <input type="hidden" class="hidden" value="{{ $amount }}" name="amount">

                        <x-form-group>
                            <x-input class="w-full px-3" label="Nombre de la tarjeta" name="cc_name" type="text" placeholder="John Doe" help="El nombre de la persona en la tarjeta." value="" />
                        </x-form-group>

                        <x-form-group>
                            <x-input class="w-full md:w-1/2 px-3" label="Email" name="email" type="email" placeholder="john@mail.com" help="Tu email." value="" />
                            <x-input class="w-full md:w-1/2 px-3" label="Numero de tarjeta" name="cc_number" type="text" placeholder="**** **** **** 8023" help="El numero de la tarjeta." />
                        </x-form-group>

                        <x-form-group>
                            <x-input class="w-full md:w-1/3 px-3 mb-6 md:mb-0" label="Mes de expiracion" name="cc_expiration_month" type="number" placeholder="09" help="El numero de mes de vencimiento de la tarjeta." />
                            <x-input class="w-full md:w-1/3 px-3 mb-6 md:mb-0" label="Año de expiracion" name="cc_expiration_year" type="number" placeholder="{{ now('Y')->year }}" help="El numero de año de vencimiento de la tarjeta." />
                            <x-input class="w-full md:w-1/3 px-3 mb-6 md:mb-0" label="CVV de la tarjeta" name="cvv_card" type="number" placeholder="010" help="El numero cvv de la tarjeta." />
                        </x-form-group>

                        <label class="md:w-2/3 my-6 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" type="checkbox" name="recurrence">
                            <span class="text-sm">Quiero aportar de forma recurrente.</span>
                        </label>

                        @error('amount')
                        <p class="text-red-600 text-xs font-bold my-2">{{ __($message) }}</p>
                        @enderror

                        <x-form-group>
                            <div id="submit_text" class="hidden mx-3 text-deeppink font-bold text-xs tracking-tight">Procesando el pago ...</div>
                            <button id="submit" type="submit" class="bg-pink text-gray-100 py-2 px-4 w-full rounded mx-3 hover:bg-deeppink outline-none focus:shadow-outline">Donar ahora</button>
                        </x-form-group>

                    </form>

                </div>

                <div class="w-full lg:w-2/6 min-h-full flex flex-col bg-white p-1 lg:p-5 rounded-lg shadow-lg lg:mx-8">

                    <div>

                        @isset($team->logo)

                            <div class="w-full flex items-center justify-center">
                                <img width="200px" src="{{ $team->logo }}" alt="{{ $team->name }} logo">
                            </div>

                            <div class="my-4 border-gray-200 border-b-2"></div>

                        @endisset

                        <div class="flex flex-col mx-4 text-xs">

                            <p class="text-gray-900 font-semibold text-gray-900 my-2 hidden lg:block">Detalles</p>

                            <div class="flex ">
                                <label class="text-gray-500 uppercase mr-2 my-2" for="organization">Organizacion:</label>
                                <p class="text-gray-700 title-font font-semibold tracking-tight my-2">{{ $team->name }}</p>
                            </div>

                        </div>

                        <div class="my-4 border-gray-200 border-b-2"></div>

                        <div class="flex flex-col mx-4 text-xs">

                            <p class="text-gray-900 font-semibold text-gray-900 my-2 hidden lg:block">Acerca del pago</p>

                            <div class="flex">
                                <label class="text-gray-500 uppercase mr-2 my-2" for="organization">Aporte:</label>
                                <p class="text-gray-700 title-font font-semibold tracking-tight my-2">Q @money($amount)</p>
                            </div>

                        </div>

                        <div class="my-4 border-gray-200 border-b-2"></div>

                    </div>

                    <div class="flex flex-row items-center justify-between p-2">

                        <img width="75px" src="{{ asset('assets/images/checkout/visa.png') }}" alt="Visa logo">

                        <img width="75px" src="{{ asset('assets/images/checkout/mastercard.png') }}" alt="Mastercard logo">

                        <img width="75px" src="{{ asset('assets/images/checkout/cybersource.png') }}" alt="Cybersource logo">

                    </div>


                </div>

            </div>



        </div>

    </section>

    <x-landing.footer/>

    @push('scripts')
        <script>
            function disabledSubmitBtn() {
                const submitBtn = document.querySelector('#submit')
                submitBtn.disabled = true
                submitBtn.style.display = 'none'
                const submitText = document.querySelector('#submit_text')
                submitText.classList.remove('hidden')
            }
            const merchantID  = 'visanetgt_jupiter'
            var environment = "{{  config('pagalogt.environment') }}"
            environment = environment.toLowerCase
            const checkout = document.querySelector('form')
            const newInputWrapper = document.createElement('div')
            newInputWrapper.innerHTML = '<input type="hidden" name="deviceFingerprintID" value="'+ cybs_dfprofiler(`${merchantID}`,`${environment}`) + '">'
            checkout.appendChild(newInputWrapper)
            function cybs_dfprofiler(merchantID,environment) {
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
        </script>
    @endpush

@endsection

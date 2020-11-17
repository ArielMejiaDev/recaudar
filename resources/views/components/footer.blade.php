@if(!Route::is('contact.create') &&
    !Route::is('profile-page') &&
    !Route::is('certificate') &&
    !Route::is('about-us') &&
    !Route::is('terms-for-teams') &&
    !Route::is('terms-for-users') &&
    !Route::is('teams-page') &&
    !Route::is('pricing'))

    @push('headerScripts')
    <!-- Recaptcha -->
    {!! htmlScriptTagJsApi() !!}
@endpush

@endif

<footer class="text-gray-700 body-font bg-gray-900 relative no-print">

    <a href="#app" class="absolute bg-gray-800 p-2 lg:p-4 rounded fill-current text-gray-100" style="right: 50px;top: 30px;">
        <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 15l7-7 7 7"></path></svg>
    </a>

    <div class="container px-0 py-24 mx-auto lg:px-10">

        <div class="flex flex-wrap md:text-left text-center -mb-10 mx-2">

            <div class="lg:w-1/3 md:w-full w-full flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">

                <a href="{{ config('app.url') }}" class="flex items-center lg:justify-start justify-center mb-6 text-primary">
                        <svg class="fill-current w-40 h-auto" viewBox="0 0 1014.18 208.58" fill="none">
                            <path class="cls-1" d="M281.28,167.81H255.71V113.18a41.88,41.88,0,1,1,83.75,0v12.65H313.9V113.18a16.31,16.31,0,1,0-32.62,0Z"/>
                            <path class="cls-1" d="M683.72,71v54.63a16.31,16.31,0,1,1-32.62,0V71H625.53v54.63A43.66,43.66,0,0,0,626,132a42.05,42.05,0,0,0,41.39,35.78h0a42.19,42.19,0,0,0,41.88-42.19V71Z"/>
                            <path class="cls-1" d="M930.92,167.81H905.35V113.18a41.88,41.88,0,1,1,83.76,0v12.65H963.54V113.18a16.31,16.31,0,1,0-32.62,0Z"/>
                            <path class="cls-1" d="M371,125.75q.57,10.49,6.08,16.64t14.49,6.16a20.44,20.44,0,0,0,10.56-2.7,12.3,12.3,0,0,0,5.88-7.57h25q-4.3,14.21-14.95,21.87t-25.42,7.66q-46,0-46-50.09a58.13,58.13,0,0,1,3-19.25,41.53,41.53,0,0,1,8.69-14.77,37.45,37.45,0,0,1,13.92-9.43A50.82,50.82,0,0,1,391.16,71q21.3,0,32.24,13.64t10.94,41.11Zm38.32-15.32a25.67,25.67,0,0,0-1.77-8.88,18.77,18.77,0,0,0-4.2-6.36,17.08,17.08,0,0,0-6-3.74,20.44,20.44,0,0,0-6.91-1.21,17.24,17.24,0,0,0-12.62,5.33q-5.32,5.33-6.08,14.86Z"/>
                            <path class="cls-1" d="M526.87,132.11a38.78,38.78,0,0,1-4.58,14.58A39.19,39.19,0,0,1,513,157.9a42.37,42.37,0,0,1-12.8,7.29,45.36,45.36,0,0,1-15.6,2.62,45.86,45.86,0,0,1-17.11-3.08,35.07,35.07,0,0,1-13.36-9.35,43.65,43.65,0,0,1-8.69-15.52,68.21,68.21,0,0,1-3.09-21.59A65.58,65.58,0,0,1,445.47,97a38.43,38.43,0,0,1,8.69-14.68,35,35,0,0,1,13.55-8.5A52.77,52.77,0,0,1,485.37,71a52.12,52.12,0,0,1,16.36,2.43,38.17,38.17,0,0,1,12.89,7.1,34.09,34.09,0,0,1,8.7,11.22,39.38,39.38,0,0,1,3.73,14.58H502.57a16.8,16.8,0,0,0-5.7-11.13,17.56,17.56,0,0,0-11.68-4,20.06,20.06,0,0,0-7.3,1.31A14.24,14.24,0,0,0,472,96.87a23.09,23.09,0,0,0-4,8.23,45.69,45.69,0,0,0-1.49,12.61q0,15.15,5.42,22.44t12.52,7.28a19.21,19.21,0,0,0,12.15-3.92c3.36-2.62,5.3-6.41,5.79-11.4Z"/>
                            <path class="cls-1" d="M594.61,167.67a63.74,63.74,0,0,1-1.49-10.51,30,30,0,0,1-11.4,7.75,43.17,43.17,0,0,1-16.45,2.9q-15.88,0-23.27-7t-7.39-18.22q0-9.92,3.18-15.8a23.71,23.71,0,0,1,8.79-9.25,42.07,42.07,0,0,1,13.36-5q7.75-1.59,16.92-2.9t12.34-3.46q3.16-2.14,3.17-7a7.82,7.82,0,0,0-4.21-7q-4.2-2.52-11.3-2.51-8.42,0-12.06,3.73a17.5,17.5,0,0,0-4.58,9.91H537.61a41.7,41.7,0,0,1,2.33-13.09A25.2,25.2,0,0,1,546.86,80a32.39,32.39,0,0,1,12.43-6.63A64.67,64.67,0,0,1,578,71a60.83,60.83,0,0,1,18.41,2.42,29.64,29.64,0,0,1,12.15,7,26.65,26.65,0,0,1,6.63,11.41,53.39,53.39,0,0,1,2.06,15.42v60.41Zm-1.68-47.34a13,13,0,0,1-5.42,3,95,95,0,0,1-10.28,2.43q-10.47,2.07-14.39,5.24t-3.93,9.16q0,10.28,11.78,10.28a23.43,23.43,0,0,0,8.69-1.59,21.73,21.73,0,0,0,6.91-4.3,21.27,21.27,0,0,0,4.68-6.36,17.5,17.5,0,0,0,1.77-7.75Z"/>
                            <path class="cls-1" d="M874.33,167.67c-.75-2.37-1.25-7.4-1.5-10.51a29.9,29.9,0,0,1-11.4,7.75,43.14,43.14,0,0,1-16.45,2.9q-15.88,0-23.27-7t-7.38-18.22q0-9.92,3.18-15.8a23.62,23.62,0,0,1,8.78-9.25,42.16,42.16,0,0,1,13.36-5q7.76-1.59,16.92-2.9c6.11-.87,10.21-2,12.34-3.46s3.17-3.76,3.17-7a7.82,7.82,0,0,0-4.2-7c-2.8-1.68-6.58-2.51-11.31-2.51q-8.42,0-12.05,3.73a17.58,17.58,0,0,0-4.59,9.91H817.32a41.41,41.41,0,0,1,2.34-13.09A25.1,25.1,0,0,1,826.58,80,32.27,32.27,0,0,1,839,73.33,64.71,64.71,0,0,1,857.69,71a60.89,60.89,0,0,1,18.42,2.42,29.67,29.67,0,0,1,12.14,7,26.77,26.77,0,0,1,6.64,11.41,53.75,53.75,0,0,1,2.05,15.42v60.41Zm-1.69-47.34a12.89,12.89,0,0,1-5.42,3,95,95,0,0,1-10.28,2.43q-10.47,2.07-14.39,5.24t-3.92,9.16q0,10.28,11.77,10.28a23.39,23.39,0,0,0,8.69-1.59,21.78,21.78,0,0,0,6.92-4.3,21.42,21.42,0,0,0,4.67-6.36,17.38,17.38,0,0,0,1.78-7.75Z"/>
                            <path class="cls-1" d="M782.51,167.81l-.19-13.72q-8.42,13.64-25.61,13.64a37.76,37.76,0,0,1-16.07-3.37,35.06,35.06,0,0,1-12.52-9.71,47.27,47.27,0,0,1-8.23-15.52,66.48,66.48,0,0,1-3-20.74,68.62,68.62,0,0,1,2.51-19.16,45.23,45.23,0,0,1,7.39-15,33.34,33.34,0,0,1,11.87-9.82,35.7,35.7,0,0,1,16-3.45q17,0,27.29,14.39V39.69h23.93V167.81Zm-20.19-19.89q8.77,0,14.67-7.3t5.89-19.06q0-29.91-20.37-29.9-20.94,0-20.94,28.41,0,12.33,5.79,20.08t15,7.77"/>
                            <path class="cls-1" d="M219.92,48.53a68.77,68.77,0,0,0-89.51-18.92,4.74,4.74,0,0,1-1.26.5,4.74,4.74,0,0,1-1.26-.5,68.64,68.64,0,0,0-102.81,60,69.06,69.06,0,0,0,1.21,13.62,70.22,70.22,0,0,0,2,7.81,46.63,46.63,0,0,0,6.43,13.23,68.23,68.23,0,0,0,18.41,20.27l43.64,32a77.25,77.25,0,0,0,8,4.87,44.42,44.42,0,0,0,6.49,3.12c1.34.45,2.68.87,4,1.24l.13,0,2,.54a50.76,50.76,0,0,0,31.06-1.64c.41-.16.75-.29,1-.4l0,0c18.31-8.43,28.9-24.4,25.43-30.83-.84-1.55-2.47-2.12-4.51-1.79-3.6.57-3.79,5.41-7.56,7.23-7,3.4-9.18-2.58-5.72-5.54a11.31,11.31,0,0,0,2.58-4.36,4.16,4.16,0,0,0-5.9-4.69l-3.84,2.81c-3.28,2.41-6.32,6.74-9.94,8.39A20.6,20.6,0,0,1,135.5,157a13.15,13.15,0,0,1-5.32-.4l-1-.28a14.72,14.72,0,0,1-4-2.08L115,146.93,73.84,116.25a33.36,33.36,0,0,1-13.31-22,32.71,32.71,0,0,1-.35-3.68,33.28,33.28,0,0,1,6.46-21.29,33.75,33.75,0,0,1,27.12-13.7,33.23,33.23,0,0,1,19.82,6.48l12.5,9h0a5.21,5.21,0,0,0,6.1,0l0,0,12.5-9a33.23,33.23,0,0,1,19.82-6.48,33.75,33.75,0,0,1,27.12,13.7,33.28,33.28,0,0,1,6.46,21.29,33.76,33.76,0,0,1-14.61,27.65l-3.93,2.68A4.17,4.17,0,0,0,182,128a11.38,11.38,0,0,0,5-1c3.95-2.27,8.88,1.73,3.33,7.24-3,2.95-7.6,1.52-9.34,4.73-1,1.82-1,3.54.19,4.84,4.91,5.41,23.49.74,37.54-13.71a48.88,48.88,0,0,0,4.9-5.89A46.35,46.35,0,0,0,230,111a68.11,68.11,0,0,0,2-7.81,69.06,69.06,0,0,0,1.21-13.62A68.05,68.05,0,0,0,219.92,48.53Z"/>
                        </svg>
                </a>

                <div class="flex justify-center">
                    <p class="mt-2 text-sm text-gray-500 w-56 sm:w-auto">
                        {{ trans("It's time to help! We are the heart of charity and safety is paramount in Raising.") }}
                    </p>
                </div>

            </div>

            <div class="lg:w-1/3 md:w-1/2 w-full px-4 text-center lg:text-right hidden lg:block">
                <h2 class="title-font font-medium text-gray-100 tracking-widest text-sm mb-3">
                    {{ trans('Recaudar') }}
                </h2>
                <nav class="list-none mb-8">
                    <li class="py-2">
                        <a class="text-gray-600 hover:text-gray-100" href="{{ route('about-us') }}">{{ trans('About us') }}</a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('pricing') }}" class="text-gray-600 hover:text-gray-100">{{ trans('Pricing') }}</a>
                    </li>
                </nav>
            </div>

            <div class="lg:w-1/3 md:w-1/2 w-full px-4 text-center lg:text-right hidden lg:block">
                <h2 class="title-font font-medium text-gray-100 tracking-widest text-sm mb-3">{{ trans('Resources') }}</h2>
                <nav class="list-none mb-8">
                    <li class="py-2">
                        <a href="{{ route('contact.create') }}" class="text-gray-600 hover:text-gray-100">{{ trans('Contact us') }}</a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('terms-for-users') }}" class="text-gray-600 hover:text-gray-100">{{ trans('Terms & conditions') }}</a>
                    </li>
                </nav>
            </div>

        </div>
    </div>

    <div class="border-t border-gray-700">

        <div class="container px-5 py-8 flex flex-wrap mx-auto items-center justify-center">

            @if(
                !Route::is('contact.create') &&
                !Route::is('profile-page') &&
                !Route::is('certificate') &&
                !Route::is('about-us') &&
                !Route::is('terms-for-teams') &&
                !Route::is('terms-for-users') &&
                !Route::is('teams-page') &&
                !Route::is('pricing'))

            <form id="{{ getFormId() }}" method="POST" action="{{ route('newsletter.store') }}" class="flex flex-col md:flex-row md:items-center md:flex-no-wrap flex-wrap justify-center md:justify-start">
                @csrf

                <input tabindex="20" autocomplete="off" class="w-full md:w-64 my-1 md:my-0 bg-gray-100 rounded sm:mr-4 mr-2 border border-gray-400 focus:outline-none focus:border-indigo-500 text-base py-2 px-4" placeholder="Email" name="email" value="{{ old('email', '') }}" type="email">

                {!!
                    htmlFormButton(trans('Send'), [
                        'class' => 'w-full md:w-auto my-1 md:my-0 inline-flex text-white justify-center bg-primary border-0 py-2 px-6 focus:outline-none focus:shadow-outline hover:bg-darkprimary rounded focus:shadow-outline',
                        'id' => 'newsletterSubmitButton',
                        'tabindex' => 21,
                    ])
                !!}

                <p class="text-gray-500 text-xs md:ml-6 mt-2 sm:text-left text-center">
                    {{ trans('Leave your email to find out more news.') }}
                </p>

            </form>
            @endif

            <span class="inline-flex lg:ml-auto lg:mt-0 mt-6 w-full justify-center md:justify-start md:w-auto">

            <a class="ml-3 text-gray-500 fill-current mr-2" href="#">
                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </a>

            @if(config('social.facebook_account_link'))
                    <a target="_blank" href="{{ config('social.facebook_account_link') }}" class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                @endif

                @if(config('social.twitter_account_link'))
                    <a target="_blank" href="{{ config('social.twitter_account_link') }}" class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                </a>
                @endif

                @if (config('social.instagram_account_link'))
                    <a class="ml-3 text-gray-500" target="_blank" href="{{ config('social.instagram_account_link') }}">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                @endif

                @if (config('social.linkedin_account_link'))
                    <a class="ml-3 text-gray-500" target="_blank" href="{{ config('social.linkedin_account_link') }}">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                    <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
                @endif

        </span>

        </div>

    </div>

    <div class="bg-gray-800">
        <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
            <p class="text-gray-500 text-sm text-center sm:text-left">© {{ now()->format('Y') }} {{ config('app.name') }} —
                <a href="{{ route('terms-for-users') }}" class="text-gray-600 ml-1" target="_blank">
                    {{ trans('Terms & conditions') }}
                </a>
            </p>
            <span class="sm:ml-auto sm:mt-0 mt-2 sm:w-auto w-full sm:text-left text-center text-gray-500 text-sm">
                {{ trans('All rights reserved.') }}
            </span>
        </div>
    </div>

</footer>

@if(Route::is('welcome') || Route::is('about-us'))

@push('scripts')
    <script>
        const footerRecaptcha = document.getElementById("newsletterSubmitButton");
        footerRecaptcha.addEventListener('click', function() {
            footerRecaptcha.disabled = true;
        })
    </script>
@endpush

@endif

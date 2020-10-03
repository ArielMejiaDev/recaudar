<div id="faqs" class="h-auto lg:h-screen bg-mint flex items-center justify-center relative overflow-hidden pt-4 font-body">

    <svg class="absolute fill-current text-deepmint z-0" style="top: -125px; left: -25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M112.7,-140.9C144.9,-107.4,169,-70.7,184.5,-26.1C200,18.5,206.9,71,185.7,106.6C164.4,142.2,114.9,160.8,65.9,176.7C17,192.6,-31.4,205.8,-75.7,195.2C-120.1,184.6,-160.5,150.3,-194,105.6C-227.5,60.8,-254.1,5.7,-248.8,-47.2C-243.5,-100.1,-206.3,-150.8,-159.5,-181.7C-112.7,-212.6,-56.4,-223.8,-8,-214.2C40.3,-204.7,80.6,-174.3,112.7,-140.9Z" />
        </g>
    </svg>

    <svg class="absolute fill-current text-deepmint z-0" style="bottom: -200px; right: -140px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M127,-142.3C156.7,-126.4,167.5,-78.9,180.8,-28.2C194.2,22.5,210.1,76.5,195.3,122.6C180.4,168.8,134.9,207,88.7,208.4C42.6,209.9,-4,174.5,-55,154.4C-105.9,134.4,-161.2,129.7,-194.1,99.2C-227.1,68.7,-237.6,12.5,-231.3,-43.8C-225,-100.2,-201.9,-156.6,-160.5,-170.4C-119.1,-184.3,-59.6,-155.7,-5.5,-149.1C48.6,-142.6,97.3,-158.3,127,-142.3Z" />
        </g>
    </svg>

    <div x-data="{showMore: false}" class="container mx-auto px-4 md:px-32 z-10 h-full">

        <h2 class="text-white text-center text-4xl lg:text-5xl mt-8 mb-16">{{ trans('Frequent questions') }}</h2>

        <div x-show.transition.duration.200ms="!showMore" class="text-blue-900">

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">
                    {{ trans('What is Recaudar.com?') }}
                </h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    {{ trans('We are the heart of charity, because we connect organizations and donors in an easy and safe way to change the world.') }}
                </p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">
                    {{ trans('How can I donate?') }}
                </h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    {{ trans('Select the organization that you are most passionate about to contribute to their cause, choose the amount and make your donation. All in less than five minutes!') }}
                </p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">
                    {{ trans('Are you a non-profit organization?') }}
                </h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    {{ trans('If you are a non-profit organization and want to receive donations through Recaudar, you must fill out our registration form. We will review the validity of your information and notify you by email when you are ready to receive donations. If you want to be part of Recaudar,') }}
                    <a href="{{ route('register') }}" class="underline">{{ trans('Sign up') }}</a>.
                </p>
            </div>

            <span @click="showMore = !showMore;" class="text-blue-900 text-2xl font-bold hover:underline cursor-pointer block mb-6">
                {{ trans('Show more') }}...
            </span>

        </div>

        <div x-show.transition.duration.200ms="showMore" class="text-blue-900">

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">{{ trans('Does it cost anything to create my profile?') }}</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    {{ trans('If you are a non-profit organization, creating your profile and starting receiving donations is completely free. If you want to have access to the process automation modules (Human Resources, Finance, Volunteering, Donor and Beneficiary Management), you can opt for a monthly subscription of $ 15.') }}
                </p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">{{ trans('Why donate at Recaudar?') }}</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    {{ trans('We are not a simple intermediary between donors and organizations. We provide donors with a complete experience and detailed service where you can experience and see first-hand the impact your donation is having. We provide a guarantee of security for all your information, while helping to create a better world.') }}
                </p>
            </div>

            <span @click="showMore = !showMore;" class="text-blue-900 text-2xl font-bold hover:underline cursor-pointer">{{ trans('Back') }}...</span>

        </div>

    </div>
</div>

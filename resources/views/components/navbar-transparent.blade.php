<nav x-data="{ navbarToggle:false }" class="flex items-center justify-between flex-wrap bg-pink lg:bg-transparent p-6 relative z-10">
    <a href="{{ config('app.url') }}" class="flex items-center flex-shrink-0 mr-6">
        <div class="hidden lg:block">
            <x-logo :class="'text-pink'" />
        </div>
        <div class="block lg:hidden">
            <x-logo :class="'text-white'" />
        </div>
    </a>
    <div class="block lg:hidden">
        <button @click="navbarToggle = ! navbarToggle" class="flex items-center px-3 py-2 border rounded text-gray-200 border-gray-400 hover:text-white hover:border-white focus:outline-none">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    {{--Desktop--}}
    <div class="hidden lg:block flex-grow flex items-center">
        <div class="text-sm text-gray-200 flex items-center justify-end font-body">
            <a href="{{ config('app.url') . '/#faqs' }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white text-xl mr-4">{{ trans('Frequent questions') }}</a>
            <a href="{{ route('about-us') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white text-xl mr-4">{{ trans('About us') }}</a>
            <a href="{{ route('pricing') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white text-xl mr-4">{{ trans('Pricing') }}</a>
            <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white text-xl mr-4 py-2 px-6 border-4 border-pink hover:bg-white hover:bg-pink rounded-full">{{ trans('Login') }}</a>
            <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-blue-900 text-xl mr-4 py-2 px-6 border-4 border-teal-400 bg-teal-400 hover:bg-transparent hover:text-white rounded-full">{{ trans('Create your profile') }}</a>
        </div>
    </div>
    {{--Responsive--}}
    <div x-cloak x-show="navbarToggle" class="block lg:hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow font-body">
            <a href="{{ config('app.url') . '/#faqs' }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                {{ trans('Frequent questions') }}
            </a>
            <a href="{{ route('about-us') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                {{ trans('About us') }}
            </a>
            <a href="{{ route('pricing') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
                {{ trans('Pricing') }}
            </a>
            <a href="{{ route('login') }}" class="block mt-4 lg:inline-block w-40 text-center text-white py-1 px-2 border-2 border-white hover:bg-white hover:text-melon rounded-full">{{ trans('Login') }}</a>
            <a href="{{ route('register') }}" class="block mt-4 lg:inline-block w-40 text-center text-blue-900 py-1 px-2 border-2 border-teal-400 bg-teal-400 hover:bg-transparent hover:text-white rounded-full">{{ trans('Create your profile') }}</a>
        </div>
    </div>
</nav>

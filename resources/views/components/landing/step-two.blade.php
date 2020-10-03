<div id="step-two" class="sm:h-screen bg-pink overflow-hidden relative flex flex-col items-center justify-center relative pt-4 pb-20 lg:py-0 lg:py-0 font-body">

    <!-- Blobs -->
    <svg class="absolute fill-current text-melon z-0" style="top: -100px; right: -400px" width="800" height="800" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M155.6,-110.7C184.5,-87.8,179,-24.1,162.6,32.8C146.2,89.8,118.9,139.9,68.6,177.8C18.2,215.6,-55.1,241.2,-111.6,218.9C-168.2,196.6,-207.9,126.6,-205.4,67.1C-202.9,7.5,-158.1,-41.4,-116.8,-67.2C-75.6,-92.9,-37.8,-95.5,12.8,-105.7C63.3,-115.8,126.7,-133.7,155.6,-110.7Z" />
        </g>
    </svg>

    <svg class="absolute fill-current text-melon z-0" style="bottom: -400px; left: -350px" width="800" height="800" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M150.6,-186C187.3,-180.7,203.5,-126.1,207,-76.4C210.5,-26.8,201.3,17.8,178.9,49.3C156.5,80.7,120.9,99,88.8,106.1C56.8,113.2,28.4,109.1,1,107.8C-26.5,106.4,-52.9,107.8,-65.3,94.3C-77.6,80.8,-75.9,52.5,-75.8,30C-75.8,7.5,-77.4,-9.1,-89.4,-46.7C-101.4,-84.2,-123.9,-142.8,-110.7,-155.7C-97.6,-168.6,-48.8,-135.8,4.1,-141.5C57,-147.1,114,-191.3,150.6,-186Z" />
        </g>
    </svg>

    <!-- Main -->
    <div class="container mx-auto px-4 lg:px-12 z-10">

        <div class="flex flex-col lg:flex-row">

            <!-- Text -->
            <div class="w-full lg:w-1/2 flex flex-col lg:flex-row items-center lg:items-start">
                <div class="text-white text-6xl border-4 border-white rounded-full px-8 mr-6">2</div>
                <div class="text-white">
                    <h2 class="mt-6 text-4xl font-bold tracking-wider text-center lg:text-left">
                        {{ trans('Donate easy and safe') }}
                    </h2>

                    <div class="mt-6 text-md md:text-xl font-display text-left lg:w-10/12">
                        <p class="my-4">
                            {{ trans("It's time to help! We are the heart of charity and safety is paramount in Raising.") }}
                        </p>

                        <p class="my-4">{{ trans('We guarantee that your donation will reach real and legally established organizations.') }}</p>

                        <p class="my-4">{{ trans('In addition, your information is fully protected with us.') }}</p>
                    </div>

                </div>
            </div>

            <!-- Icon -->
            <div class="w-full lg:w-1/2 mt-6 lg:mt-0 flex items-center justify-around z-10">
                <img class="h-20 w-20 md:h-32 md:w-32 lg:h-40 lg:w-40" src="{{ asset('images/landing/step-two/first-illustration.png') }}" alt="key illustration">
                <img class="h-20 w-20 md:h-32 md:w-32 lg:h-40 lg:w-40" src="{{ asset('images/landing/step-two/second-illustration.png') }}"  alt="">
                <img class="h-20 w-20 md:h-32 md:w-32 lg:h-40 lg:w-40" src="{{ asset('images/landing/step-two/third-illustration.png') }}" alt="">
            </div>

        </div>

    </div>

    <div class="absolute bottom-0">
        <a href="#step-three">
            <svg class="fill-current text-white" enable-background="new 0 0 32 32" height="64px" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M14.77,23.795L5.185,14.21c-0.879-0.879-0.879-2.317,0-3.195l0.8-0.801c0.877-0.878,2.316-0.878,3.194,0  l7.315,7.315l7.316-7.315c0.878-0.878,2.317-0.878,3.194,0l0.8,0.801c0.879,0.878,0.879,2.316,0,3.195l-9.587,9.585  c-0.471,0.472-1.104,0.682-1.723,0.647C15.875,24.477,15.243,24.267,14.77,23.795z"/></svg>
        </a>
    </div>

</div>

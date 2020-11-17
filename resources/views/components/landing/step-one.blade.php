<div class="min-h-screen bg-gray-100 overflow-hidden relative flex flex-col font-body">

    <svg class="absolute fill-current text-gray-200 z-0" style="left: -200px; bottom: -150px" width="800" height="800" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M108.5,-80.4C134.2,-54.4,144.1,-9.6,138.5,38.3C132.9,86.2,111.8,137.3,67.8,169.5C23.7,201.8,-43.2,215.3,-96.4,192.6C-149.5,169.9,-188.8,111,-202.5,47.3C-216.2,-16.4,-204.3,-84.9,-166.2,-113.7C-128.2,-142.6,-64.1,-131.8,-11.3,-122.8C41.4,-113.7,82.9,-106.4,108.5,-80.4Z" />
        </g>
    </svg>

    <svg class="fill-current absolute text-gray-200 z-0" style="right: -300px; top: 25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M143.8,-137C167.2,-85.3,153.8,-26.6,140.7,32.6C127.6,91.9,114.8,151.8,75.3,179.8C35.9,207.8,-30.2,203.9,-78.4,175.8C-126.6,147.6,-156.9,95.2,-178.6,31.7C-200.4,-31.8,-213.5,-106.3,-182.4,-159.8C-151.2,-213.2,-75.6,-245.6,-7.7,-239.5C60.2,-233.3,120.4,-188.7,143.8,-137Z" />
        </g>
    </svg>

    <div class="h-full flex flex-col items-center justify-around text-gray-900 z-10 relative mb-12 mx-4">
        <div class="text-primary text-6xl border-4 border-primary rounded-full px-10 flex items-center justify-center mt-8">1</div>
        <h2 class="mt-6 font-bold tracking-wider text-center {{ $teams->isEmpty() ? 'text-8xl' : 'text-4xl'}}">
            {{ trans('Choose a project') }}
        </h2>
        <p class="mt-3 font-display text-center w-full px-2 sm:w-1/2 {{ $teams->isEmpty() ? 'text-2xl' : 'text-xl' }}">
            {{ trans('Be part of the change! Select the initiative that you are most passionate about to contribute to a cause. Together, through Collect, we will create a better world.') }}
        </p>
    </div>

    <div class="z-10 flex items-center justify-center flex-col md:flex-row px-4 mb-16 container mx-auto">

        @forelse ($teams as $team)
            <div class="rounded-lg w-full md:w-1/3 overflow-hidden shadow-lg m-4 relative">

                <img class="w-full h-56 object-cover z-0" src="{{ $team->banner }}" alt="{{ $team->name }}">

                <div class="bg-black opacity-100 lg:opacity-0 hover:opacity-100 bg-opacity-50 lg:bg-opacity-0 hover:bg-opacity-50 flex items-center justify-center absolute inset-0">
                    <a href="{{ route('profile-page', $team) }}" class="bg-primary py-2 px-4 md:py-4 md:px-8 lg:py-2 lg:px-4 text-center text-gray-100 rounded hover:bg-darkprimary text-2xl tracking-wide z-10">
                        {{ trans('Donate') }}
                    </a>
                </div>

            </div>
            @empty
        @endforelse
    </div>

    <div class="absolute bottom-0 self-center z-20">
        <a href="#step-two">
            <svg class="fill-current text-primary" enable-background="new 0 0 32 32" height="64px" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M14.77,23.795L5.185,14.21c-0.879-0.879-0.879-2.317,0-3.195l0.8-0.801c0.877-0.878,2.316-0.878,3.194,0  l7.315,7.315l7.316-7.315c0.878-0.878,2.317-0.878,3.194,0l0.8,0.801c0.879,0.878,0.879,2.316,0,3.195l-9.587,9.585  c-0.471,0.472-1.104,0.682-1.723,0.647C15.875,24.477,15.243,24.267,14.77,23.795z"/></svg>
        </a>
    </div>

</div>

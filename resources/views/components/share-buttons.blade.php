<style>
    .fab {
        background-color: transparent;
        height: 64px;
        width: 64px;
        border-radius: 32px;
        transition: height 300ms;
        transition-timing-function: ease;
        position: fixed;
        right: 20px;
        bottom: 20px;
        text-align: center;
        overflow: hidden;
        z-index: 50;
    }

    .fab:hover {
        height: 300px;
    }

    .fab:hover .main {
        transform: rotate(180deg);
    }

    .main {
        margin: auto;
        width: 64px;
        height: 64px;
        position: absolute;
        bottom: 0;
        right: 0;
        transition: transform 300ms;
        border-radius: 32px;
        z-index: 6;
    }

    .mini {
        position: relative;
        width: 48px;
        height: 48px;
        border-radius: 24px;
        z-index: 5;
        float: left;
        margin-bottom: 8px;
        margin-left: 8px;
        margin-right: 8px;
        transition: box-shadow 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }
</style>

<div class="fab">
    <div class="main bg-pink shadow-xl text-white flex justify-center items-center">
        <svg class="w-8 h-8 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"></path></svg>
    </div>
    <button onclick="printCertificate()" class="mini bg-pink flex items-center justify-center text-white hover:shadow-lg">
        <svg class="w-8 h-8 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"></path></svg>
    </button>
    <a href="http://www.facebook.com/sharer.php?u={{ route('certificate', ['transaction' => $transaction, 'team' => $team]) }}" target="_blank" class="mini bg-blue-800 flex items-center justify-center text-white hover:shadow-lg">
        <svg class="h-8 w-8" height="100%" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M374.245,285.825l14.104,-91.961l-88.233,0l0,-59.677c0,-25.159 12.325,-49.682 51.845,-49.682l40.117,0l0,-78.291c0,0 -36.408,-6.214 -71.214,-6.214c-72.67,0 -120.165,44.042 -120.165,123.775l0,70.089l-80.777,0l0,91.961l80.777,0l0,222.31c16.197,2.542 32.798,3.865 49.709,3.865c16.911,0 33.512,-1.323 49.708,-3.865l0,-222.31l74.129,0Z" style="fill:#ffffff;fill-rule:nonzero;"/></svg>
    </a>
    <a href="https://twitter.com/share?url={{ route('certificate', ['transaction' => $transaction, 'team' => $team]) }}&amp;text=Acabo%20de%20cambiarle%20la%20vida%20a%20alguien,%20tu%20también%20puedes%20hacerlo,%20en%20menos%20de%20cinco%20minuto%20&amp;hashtags=recaudar" target="_blank" class="mini bg-blue-500 flex items-center justify-center text-white hover:shadow-lg">
        <svg class="h-8 w-8" enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M2.6,446.3c56.8,5.4,107.1-8.8,153-43.2c-11.9-0.9-22.3-2.5-32.3-6.1c-26.2-9.5-45.8-26.4-58.5-51.2   c-1.8-3.5-3.3-7.3-5-10.9c-1.8-3.8,0-4.3,3.3-3.8c13,2.1,25.9,1.2,38.7-1.4c0.3-0.1,0.5-0.4,0.8-0.6c0.2-1.4-0.9-1.6-1.8-1.8   c-29-7.2-50.7-24.2-65.6-49.8c-8.4-14.5-12.8-30.2-13.3-47c-0.1-4.3,1.1-4.8,4.7-3.1c12.8,6.2,26.3,10,41.7,10.5   c-7.5-5.9-14.2-11.3-19.8-17.9c-20.5-24.1-29-51.8-24.9-83.3c1.5-11.7,5.2-22.6,10.3-33.2c1.9-3.9,3.3-4.4,6.2-0.9   c16.7,20.3,36.2,37.6,57.7,52.6c16.1,11.3,33.3,20.7,51.3,28.6c23.3,10.1,47.6,17,72.6,21c8.4,1.3,16.9,1.6,25.3,2.6   c3.9,0.4,4.5-1.1,3.8-4.6c-4.2-21.8-1.4-42.9,8.1-62.8c14.9-31,39.2-50.8,73.1-58c33.5-7.1,63.2,1.3,89.6,22.6   c8.5,12.8,19.2,5.3,28.9,2.6c15.4-4.3,29.9-11,44.3-18.5c-7.3,23.3-21.7,41.2-41.8,55.1c19.4-1.3,37.5-7.3,56.7-14.9   c-5.1,8.1-10.4,14.4-15.6,20.7c-9.7,11.6-20.9,21.4-32.8,30.5c-2.5,1.9-3.2,3.8-3.1,6.7c0.6,21-1.1,41.9-4.9,62.6   c-4,21.7-10.4,42.6-18.9,62.9c-9.5,22.6-21.5,44-36.1,63.7c-18.2,24.6-39.7,46.1-64.7,63.9c-33.7,24-71,39.6-111.6,47.4   c-25.4,4.9-51.1,6.4-77,5.1c-20.1-1-39.7-4.1-59-9.1c-24.2-6.3-47.4-15.5-69.1-27.9C12.3,452.7,7.2,450.9,2.6,446.3z" fill="#ffffff"/></g></svg>
    </a>
    <button onclick="copyLinkToClipboard()" class="mini bg-green-500 flex items-center justify-center text-white hover:shadow-lg focus:outline-none focus:shadow-outline">
        <svg class="h-8 w-8 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path></svg>
    </button>
</div>

<nav x-data="{ mobile: false }"
class="relative mx-auto md:pb-6 max-w-7xl md:flex md:justify-between md:items-center">
<div class="relative z-20 flex items-center justify-between">
    <div class="">
        <a class="text-xl font-bold text-gray-800 md:text-2xl hover:text-gray-700" href="#top">
            <img style="max-height: 40px" src="{{ config('settings.logo') }}" alt="">
        </a>
    </div>

    <!-- Mobile menu button -->
    <div @click="mobile = !mobile" class="flex md:hidden">
        <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
            aria-label="toggle menu">
            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path fill-rule="evenodd"
                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                </path>
            </svg>
        </button>
    </div>
</div>
<!-- Mobile Menu open: "block", Menu closed: "hidden" -->
<div :class="{ 'hidden' : !mobile, 'flex': mobile }"
    class="left-0 z-10 items-center justify-center w-full font-semibold select-none md:flex lg:absolute hidden">
    <div
        class="flex flex-col justify-center w-full mt-4 space-y-2 md:mt-0 md:flex-row md:space-x-6 lg:space-x-10 xl:space-x-16 md:space-y-0">
        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/dashboard">Dashboard</a>

        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/agent/list">Agent</a>
        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/chat">Chat</a>
        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/campaigns">Campaigns</a>

        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/contacts/contacts">Contacts</a>   

        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/replies/flow">BotsFlow</a>

        <a class="py-3 text-gray-800 hover:text-gray-700 hover:underline" href="/templates">Template</a> 


        
    </div>
</div>
</nav>
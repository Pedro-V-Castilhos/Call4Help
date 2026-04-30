<div class="p-6 bg-[#486B7A] w-full flex items-center justify-between">
    <img src="{{ asset('images\logo.svg') }}" alt="logo" class="w-[160px]">
    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-[#384347] text-white font-semibold text-xl px-10 py-4 rounded-full cursor-pointer hover:bg-[#2C3538]">Logout</button>
        </form>
    @endauth
</div>

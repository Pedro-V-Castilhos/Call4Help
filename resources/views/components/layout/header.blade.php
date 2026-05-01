<div class="p-6 bg-[#486B7A] w-full flex items-center justify-between">
    <img src="{{ asset('images\logo.svg') }}" alt="logo" class="w-[160px]">
    @auth
        <div class="flex gap-4 items-center">
            @if (auth()->user()->worker)
                <button type="button" data-modal-target="newSectorModal" data-modal-toggle="newSectorModal"
                    class="bg-[#384347] text-white font-semibold text-xl px-10 py-4 rounded-full cursor-pointer hover:bg-[#2C3538]">+
                    Novo Setor</button>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-[#384347] text-white font-semibold text-xl px-10 py-4 rounded-full cursor-pointer hover:bg-[#2C3538]">Logout</button>
            </form>
        </div>
    @endauth
</div>

<div class="w-full">
    <div class="flex flex-row justify-between w-full">
        <h2 class="text-2xl font-bold mb-4">Meus Chamados:</h2>
        <button type="button" data-modal-target="newCallModal" data-modal-toggle="newCallModal"
            class="bg-[#2BAAE0] font-semibold font-medium px-5 py-2 rounded-full cursor-pointer hover:bg-[#24a0ce]">
            + Novo Chamado
        </button>
        <x-forms.new-call />
    </div>
    <div class="flex gap-2.5 mb-6 flex-wrap">
        <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
            <input type="radio" name="call_status" value="all" class="w-0 sr-only peer" checked>
            <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                <p class="text-sm font-medium ">Todos</p>
            </div>
        </label>
        <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
            <input type="radio" name="call_status" value="open" class="w-0 sr-only peer">
            <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                <p class="text-sm font-medium ">Abertos</p>
            </div>
        </label>
        <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
            <input type="radio" name="call_status" value="pending" class="w-0 sr-only peer">
            <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                <p class="text-sm font-medium ">Pendentes</p>
            </div>
        </label>
        <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
            <input type="radio" name="call_status" value="closed" class="w-0 sr-only peer">
            <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                <p class="text-sm font-medium ">Fechados</p>
            </div>
        </label>
    </div>
    <div class="flex flex-row gap-6 flex-wrap">
        @foreach ($callsOpened as $call)
            <x-ui.call-card :call="$call" :class="'call-card'" />
        @endforeach
    </div>
    @auth
        @if (auth()->user()->worker)
            <h2 class="text-2xl font-bold mb-6 mt-10">Chamados do setor:</h2>
            <div class="flex gap-2.5 mb-6 flex-wrap">
                <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
                    <input type="radio" name="sector_call_status" value="all" class="w-0 sr-only peer" checked>
                    <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                        <p class="text-sm font-medium ">Todos</p>
                    </div>
                </label>
                <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
                    <input type="radio" name="sector_call_status" value="open" class="w-0 sr-only peer">
                    <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                        <p class="text-sm font-medium ">Abertos</p>
                    </div>
                </label>
                <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
                    <input type="radio" name="sector_call_status" value="pending" class="w-0 sr-only peer">
                    <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                        <p class="text-sm font-medium ">Pendentes</p>
                    </div>
                </label>
                <label class="inline-flex cursor-pointer border border-default rounded-base shadow-xs">
                    <input type="radio" name="sector_call_status" value="closed" class="w-0 sr-only peer">
                    <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                        <p class="text-sm font-medium ">Fechados</p>
                    </div>
                </label>
            </div>
            <div class="flex flex-row gap-6 flex-wrap">
                @foreach ($sectorCalls as $call)
                    <x-ui.call-card :call="$call" :class="'sectorCall'" />
                @endforeach
            </div>
        @endif
    @endauth
</div>

<script>
    const radios = document.querySelectorAll('input[name="call_status"]');
    const callCards = document.querySelectorAll('.call-card');

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            const value = radio.value;

            callCards.forEach(card => {
                if (value === 'all') {
                    card.style.display = 'flex';
                } else if (value === 'open' && card.dataset.status === 'open') {
                    card.style.display = 'flex';
                } else if (value === 'pending' && card.dataset.status === 'pending') {
                    card.style.display = 'flex';
                } else if (value === 'closed' && card.dataset.status === 'closed') {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    const sectorRadios = document.querySelectorAll('input[name="sector_call_status"]');
    const sectorCallCards = document.querySelectorAll('.sectorCall');

    sectorRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            const value = radio.value;

            sectorCallCards.forEach(card => {
                if (value === 'all') {
                    card.style.display = 'flex';
                } else if (value === 'open' && card.dataset.status === 'open') {
                    card.style.display = 'flex';
                } else if (value === 'closed' && card.dataset.status === 'closed') {
                    card.style.display = 'flex';
                } else if (value === 'pending' && card.dataset.status === 'pending') {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

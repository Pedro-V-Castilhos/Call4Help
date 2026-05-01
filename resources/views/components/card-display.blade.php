<div>
    <h2 class="text-2xl font-bold mb-4">Meus Chamados:</h2>
    <div class="flex gap-2.5 mb-6">
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
            <input type="radio" name="call_status" value="closed" class="w-0 sr-only peer">
            <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                <p class="text-sm font-medium ">Fechados</p>
            </div>
        </label>
    </div>
    @if ($callsOpened->isEmpty())
        <p class="text-gray-500 text-lg">
            Nenhum chamado aberto
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-journal-x inline" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708" />
                <path
                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                <path
                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
            </svg>
        </p>
    @endif
    @foreach ($callsOpened as $call)
        <x-ui.call-card :call="$call" :class="'call-card'" />
    @endforeach
    @auth
        @if (auth()->user()->worker)
            <h2 class="text-2xl font-bold mb-6 mt-10">Chamados do setor:</h2>
            <div class="flex gap-2.5 mb-6">
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
                    <input type="radio" name="sector_call_status" value="closed" class="w-0 sr-only peer">
                    <div class="bg-gray-200 select-none px-5 py-2 peer-checked:bg-gray-400 rounded-base w-full">
                        <p class="text-sm font-medium ">Fechados</p>
                    </div>
                </label>
            </div>
            @foreach ($sectorCalls as $call)
                <x-ui.call-card :call="$call" :class="'sectorCall'" />
            @endforeach
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
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

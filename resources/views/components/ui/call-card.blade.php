<div class="{{ $class }} sm:w-82.5 min-h-70 p-6 rounded-2xl border-gray-100 border-2 justify-between flex flex-col bg-white"
    data-status="{{ $call->status }}">
    <div class="flex flex-row justify-between items-start">
        <div>
            <h2 class="text-xl line-clamp-1 font-medium">#{{ $call->id }} — {{ $call->title }}</h2>
            <span class="text-base text-gray-500">{{ $call->status == 'open' ? 'Aberto' : 'Fechado' }}</span>
        </div>
        <div class="bg-red-300 px-5 py-2 rounded-full font-medium text-base">{{ $call->priority->name }}</div>
    </div>
    <div class="flex flex-col gap-2.5">
        <p class="font-medium">
            {{ $call->sector->name }}
        </p>
        <p class="line-clamp-5 text-gray-500 font-medium">
            {{ $call->content }}
        </p>
    </div>
    <div>
        @php
            $limite = $call->created_at->addMinutes($call->priority->expected_time_minutes);
            $restante = now()->diffInMinutes($limite, false);
        @endphp

        <p class="text-sm font-semibold {{ $restante < 0 ? 'text-red-500' : 'text-gray-500' }}">
            @if ($restante >= 0)
                🕛 Tempo restante: {{ (int) $restante }} minutos
            @else
                🕛 Atrasado: {{ abs((int) $restante) }} minutos
            @endif
        </p>
    </div>
</div>

@php
    $limit = $call->created_at->addMinutes($call->priority->expected_time_minutes);
    $remaining = now()->diffInMinutes($limit, false);
@endphp
<a href="{{ route('callDetails', $call->id) }}"
    class="{{ $class }} cursor-pointer sm:w-82.5 min-h-70 p-6 rounded-2xl {{ $remaining > 0 ? 'border-gray-300' : 'border-red-300' }} border-2 justify-between flex flex-col bg-white"
    data-status="{{ $call->status }}">
    <div class="flex flex-row justify-between items-start">
        <div>
            <h2 class="text-xl line-clamp-1 font-medium">#{{ $call->id }} — {{ $call->title }}</h2>
            <span class="text-base text-gray-500">{{ $call->status == 'open' ? 'Aberto' : 'Fechado' }}</span>
        </div>
        @php
            $priorityClass = 'bg-red-300 text-gray-900';
            if ($call->priority->name == 'Baixa') {
                $priorityClass = 'bg-green-300 text-gray-900';
            } elseif ($call->priority->name == 'Média') {
                $priorityClass = 'bg-yellow-300 text-gray-900';
            }
        @endphp
        <div class="{{ $priorityClass }} px-5 py-2 rounded-full font-medium text-base">{{ $call->priority->name }}</div>
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
        <p class="text-sm font-semibold {{ $remaining < 0 ? 'text-red-500' : 'text-gray-500' }}">
            @if ($remaining >= 0)
                🕛 Tempo restante: {{ (int) $remaining }} minutos
            @else
                🕛 Atrasado: {{ abs((int) $remaining) }} minutos
            @endif
        </p>
    </div>
</a>

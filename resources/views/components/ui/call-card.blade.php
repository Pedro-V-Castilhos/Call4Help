@php
    $limit = $call->created_at->addMinutes($call->priority->expected_time_minutes);
    $remaining = now()->diffInMinutes($limit, false);
    $formatDuration = function ($minutes) {
        $totalMinutes = abs((int) $minutes);
        $hours = intdiv($totalMinutes, 60);
        $mins = $totalMinutes % 60;

        return "{$hours} horas e {$mins} Minutos";
    };
@endphp
<a href="{{ route('callDetails', $call->id) }}"
    class="{{ $class }} cursor-pointer sm:w-82.5 min-h-70 p-6 rounded-2xl {{ $remaining < 0 && $call->status == 'pending' ? 'border-red-300' : 'border-gray-300' }} border-2 justify-between flex flex-col bg-white"
    data-status="{{ $call->status }}">
    <div class="flex flex-row justify-between items-start">
        <div>
            <h2 class="text-xl line-clamp-1 font-medium">#{{ $call->id }} — {{ $call->title }}</h2>
            <span class="text-base text-gray-500">
                @php
                    $status = 'Aberto';
                    if ($call->status == 'pending') {
                        $status = 'Pendente';
                    } elseif ($call->status == 'closed') {
                        $status = 'Fechado';
                    }
                @endphp
                {{ $status }}
            </span>
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
        @if ($call->status == 'closed')
            @php
                $closedDiff = $call->closed_at->diffInMinutes(now(), false);
            @endphp
            <p class="text-sm text-gray-500 font-semibold mb-1">Fechado a</p>
            <p class="text-base font-medium mb-2 text-gray-700">
                {{ $formatDuration($closedDiff) }}
            </p>
        @else
            <p class="text-sm font-semibold {{ $remaining < 0 ? 'text-red-500' : 'text-gray-500' }}">
                @if ($remaining >= 0)
                    🕛 Tempo restante: {{ $formatDuration($remaining) }}
                @else
                    🕛 Atrasado: {{ $formatDuration($remaining) }}
                @endif
            </p>
        @endif
    </div>
</a>

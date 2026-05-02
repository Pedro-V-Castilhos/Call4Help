<x-layout>
    <x-slot:title>
        Detalhes do Chamado
    </x-slot:title>
    <div class="flex flex-col items-start justify-start p-6 w-full max-w-7xl gap-6">
        @php
            $limite = $call->created_at->copy()->addMinutes($call->priority->expected_time_minutes);
            $diff = now()->diffInMinutes($limite, false);
            $formatDuration = function ($minutes) {
                $totalMinutes = abs((int) $minutes);
                $hours = intdiv($totalMinutes, 60);
                $mins = $totalMinutes % 60;

                return "{$hours} horas e {$mins} Minutos";
            };

            $priorityClass = 'bg-red-300 text-gray-900';
            if ($call->priority->name == 'Baixa') {
                $priorityClass = 'bg-green-300 text-gray-900';
            } elseif ($call->priority->name == 'Média') {
                $priorityClass = 'bg-yellow-300 text-gray-900';
            }
        @endphp

        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-[#486B7A] hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8" />
            </svg>
            Voltar para chamados
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 w-full">
            <section
                class="lg:col-span-2 min-h-70 p-6 rounded-2xl border-gray-100 border-2 bg-white flex flex-col gap-6">
                <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4">
                    <div>
                        <h1 class="text-3xl font-bold">#{{ $call->id }} - {{ $call->title }}</h1>
                        <span
                            class="text-base font-medium {{ $call->status == 'open' ? 'text-green-600' : 'text-gray-500' }}">
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

                    <div class="{{ $priorityClass }} px-5 py-2 rounded-full font-medium text-base self-start">
                        {{ $call->priority->name }}
                    </div>
                </div>

                <div class="rounded-xl bg-gray-50 border border-gray-100 p-4">
                    <h2 class="text-sm font-semibold text-gray-500 mb-2">Descrição</h2>
                    <p class="text-base text-gray-700 whitespace-pre-line">{{ $call->content }}</p>
                </div>

                @if ($call->attachment_url)
                    <div class="rounded-xl bg-gray-50 border border-gray-100 p-4">
                        <h2 class="text-sm font-semibold text-gray-500 mb-2">Anexo</h2>
                        <a href="{{ route('calls.download', $call->id) }}">
                            Baixar anexo
                        </a>
                    </div>
                @endif

                @if ($call->solution_message)
                    <div class="rounded-xl bg-gray-50 border border-green-100 p-4">
                        <h2 class="text-sm font-semibold text-green-500 mb-2">Descrição da Solução</h2>
                        <p class="text-base text-gray-700 whitespace-pre-line">{{ $call->solution_message }}</p>
                    </div>
                @endif

                @auth
                    <div class="flex flex-row gap-6">
                        @if (auth()->user()->worker && auth()->user()->worker->sector_id == $call->sector_id && $call->status == 'pending')
                            <div>
                                <button type="submit" data-modal-target="solutionModal" data-modal-toggle="solutionModal"
                                    class="bg-[#2BAAE0] hover:bg-[#1B8CB0] text-white font-semibold px-5 py-2 rounded-full cursor-pointer">
                                    Fechar Chamado
                                </button>
                            </div>
                        @elseif(auth()->user()->worker && auth()->user()->worker->sector_id == $call->sector_id && $call->status == 'open')
                            <form action="{{ route('calls.open', $call->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="bg-[#2BAAE0] hover:bg-[#1B8CB0] text-white font-semibold px-5 py-2 rounded-full cursor-pointer">
                                    Abrir Chamado
                                </button>
                            </form>
                        @endif
                        @if (auth()->user()->id == $call->user_id && $call->status != 'closed')
                            <form action="{{ route('calls.cancel', $call->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-[#E02B2B] hover:bg-[#B01B1B] text-white font-semibold px-5 py-2 rounded-full cursor-pointer">
                                    Cancelar Chamado
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth
            </section>

            <aside class="min-h-70 p-6 rounded-2xl border-gray-100 border-2 bg-white flex flex-col gap-4">
                <h2 class="text-xl font-bold">Informações do Chamado</h2>

                <div>
                    <p class="text-sm text-gray-500 font-semibold">Setor</p>
                    <p class="text-base font-medium">{{ $call->sector->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold">Solicitante</p>
                    <p class="text-base font-medium">{{ $call->user->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold">Responsavel</p>
                    <p class="text-base font-medium">{{ $call->worker?->user?->name ?? 'Nao atribuido' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold">Criado em</p>
                    <p class="text-base font-medium">{{ $call->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold">Aberto em</p>
                    <p class="text-base font-medium">
                        {{ $call->opened_at ? $call->opened_at->format('d/m/Y H:i') : 'Nao aberto' }}</p>
                </div>

                <div class="mt-auto rounded-xl border border-gray-200 bg-gray-50 p-4">
                    @if ($call->status == 'closed')
                        @php
                            $closedDiff = $call->closed_at->diffInMinutes(now(), false);
                        @endphp
                        <p class="text-sm text-gray-500 font-semibold mb-1">Fechado a</p>
                        <p class="text-base font-medium mb-2 text-gray-700">
                            {{ $formatDuration($closedDiff) }}
                        </p>
                    @else
                        <p class="text-sm text-gray-500 font-semibold mb-1">Tempo esperado</p>
                        <p class="text-base font-medium mb-2">
                            {{ $formatDuration($call->priority->expected_time_minutes) }}</p>

                        <p class="text-sm font-semibold {{ $diff < 0 ? 'text-red-500' : 'text-gray-500' }}">
                            @if ($diff >= 0)
                                Tempo restante: {{ $formatDuration($diff) }}
                            @else
                                Atrasado: {{ $formatDuration($diff) }}
                            @endif
                        </p>
                    @endif
                </div>
            </aside>
        </div>
    </div>
    <x-forms.solution :call="$call" />
</x-layout>

<x-layout>
    <x-slot:title>
        Detalhes do Chamado
    </x-slot:title>
    <div class="flex flex-col items-start justify-start p-6 w-full max-w-7xl gap-6">
        @php
            $limite = $call->created_at->copy()->addMinutes($call->priority->expected_time_minutes);
            $diff = now()->diffInMinutes($limite, false);

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
                            {{ $call->status == 'open' ? 'Aberto' : 'Fechado' }}
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
                        <a href="{{ route('calls.download', $call) }}">
                            Baixar anexo
                        </a>
                    </div>
                @endif
            </section>

            <aside class="min-h-70 p-6 rounded-2xl border-gray-100 border-2 bg-white flex flex-col gap-4">
                <h2 class="text-xl font-bold">Informacoes do Chamado</h2>

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
                    <p class="text-sm text-gray-500 font-semibold">Aberto em</p>
                    <p class="text-base font-medium">{{ $call->created_at->format('d/m/Y H:i') }}</p>
                </div>

                @if ($call->closed_at)
                    <div>
                        <p class="text-sm text-gray-500 font-semibold">Fechado em</p>
                        <p class="text-base font-medium">{{ $call->closed_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endif

                <div class="mt-auto rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <p class="text-sm text-gray-500 font-semibold mb-1">Tempo esperado</p>
                    <p class="text-base font-medium mb-2">{{ $call->priority->expected_time_minutes }} minutos</p>

                    <p class="text-sm font-semibold {{ $diff < 0 ? 'text-red-500' : 'text-gray-500' }}">
                        @if ($diff >= 0)
                            Tempo restante: {{ (int) $diff }} minutos
                        @else
                            Atrasado: {{ abs((int) $diff) }} minutos
                        @endif
                    </p>
                </div>
            </aside>
        </div>
    </div>
</x-layout>

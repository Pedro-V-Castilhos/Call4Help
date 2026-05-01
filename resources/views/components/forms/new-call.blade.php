<div id="newCallModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            <div class="grid grid-cols-5 mb-6">
                <div class="col-start-2 col-end-5 justify-self-center text-center">
                    <h1 class="text-4xl font-bold mb-2">Novo Chamado</h1>
                    <span class="text-gray-500 mb-6">Preencha os detalhes do chamado</span>
                </div>
                <button type="button"
                    class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="newCallModal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('call') }}" method="POST" class="mb-6" enctype="multipart/form-data">
                @csrf
                <div class="mb-6 text-left">
                    <label for="sector_id" class="block text-gray-700 text-sm font-bold mb-2">Setor responsável:</label>
                    <select name="sector_id" id="sector_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" selected disabled>Selecione um setor</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                {{ $sector->name }}</option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 text-left">
                    <label for="priority_id" class="block text-gray-700 text-sm font-bold mb-2">Prioridade:</label>
                    <select name="priority_id" id="priority_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" selected disabled>Selecione a prioridade</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}"
                                {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                {{ $priority->name }}</option>
                        @endforeach
                    </select>
                    @error('priority_id')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 text-left">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="Ex: Impressora não funciona"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('title')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 text-left">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                    <textarea name="content" id="content" rows="6"
                        placeholder="Descreva o problema com detalhes para que possamos ajudar melhor"
                        class="shadow resize-none appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 text-left">
                    <label for="attachment" class="block text-gray-700 text-sm font-bold mb-2">Anexo:</label>
                    <input type="file" name="attachment" id="attachment"
                        class="appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    @error('attachment')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-[#486B7A] hover:bg-[#3B5560] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer w-full">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

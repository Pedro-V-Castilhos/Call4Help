<div id="solutionModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            <div class="grid grid-cols-5 mb-6">
                <div class="col-start-2 col-end-5 justify-self-center text-center">
                    <h1 class="text-4xl font-bold mb-2">Solução do Chamado</h1>
                    <span class="text-gray-500 mb-6">Preencha os detalhes da solução</span>
                </div>
                <button type="button"
                    class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="solutionModal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('calls.close', $call->id) }}" method="POST" class="mb-6">
                @method('PUT')
                @csrf
                <div class="mb-6 text-left">
                    <label for="solution_message" class="block text-gray-700 text-sm font-bold mb-2">Descrição da
                        solução:</label>
                    <textarea name="solution_message" id="solution_message" rows="6"
                        placeholder="Descreva a solução aplicada para resolver o chamado"
                        class="shadow resize-none appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('solution_message') }}</textarea>
                    @error('solution_message')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-[#486B7A] hover:bg-[#3B5560] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer w-full">
                        Fechar chamado
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

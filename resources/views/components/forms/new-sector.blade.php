<div id="newSectorModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            <div class="grid grid-cols-5 mb-6">
                <div class="col-start-2 col-end-5 justify-self-center text-center">
                    <h1 class="text-4xl font-bold mb-2">Setores da empresa</h1>
                    <span class="text-gray-500 mb-6">Atualize a lista de setores conforme necessário</span>
                </div>
                <button type="button"
                    class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="newSectorModal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('sector') }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-6 text-left">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Ex: Recursos Humanos"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('name')
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


            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sectors as $sector)
                            <tr
                                class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $sector->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('deleteSector', $sector->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-500 hover:underline cursor-pointer">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

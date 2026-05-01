<x-layout>
    <x-slot:title>
        Cadastro
    </x-slot>
    <main class="flex justify-center w-full">
        <div class="flex flex-col items-center justify-center p-20 w-lg ">
            <h1 class="text-4xl font-bold mb-2">Cadastro</h1>
            <span class="text-gray-500 mb-6">Crie sua conta</span>
            <form action="{{ route('register') }}" method="POST" class="w-full">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('name')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('email')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha:</label>
                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirme a
                        senha:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="is_worker" value="1" {{ old('sector_id') ? 'checked' : '' }}
                            class="sr-only peer">
                        <div
                            class="relative w-9 h-5 bg-neutral-quaternary peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-0.5 after:inset-s-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand">
                        </div>
                        <span class="select-none ms-3 text-sm font-medium text-heading">Sou funcionário</span>
                    </label>
                </div>
                <div class="mb-6 {{ old('sector_id') ? '' : 'hidden' }}" id="sector-field">
                    <label for="sector_id" class="block text-gray-700 text-sm font-bold mb-2">Setor:</label>
                    <select name="sector_id" id="sector_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Selecione um setor</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}"
                                {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                {{ $sector->name }}</option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-[#486B7A] hover:bg-[#3B5560] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer w-full">
                        Cadastrar
                    </button>
                </div>
                <p class="text-center text-gray-500 mt-4">Já tem uma conta? <a href="{{ route('login') }}"
                        class="text-[#486B7A] hover:text-[#3B5560] hover:underline font-semibold">Faça login</a>
                </p>
            </form>
        </div>
    </main>
    <script>
        const checkbox = document.getElementById('is_worker');
        const sectorField = document.getElementById('sector-field');
        const select = document.getElementById('sector_id');

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                sectorField.classList.remove('hidden');
            } else {
                sectorField.classList.add('hidden');
                select.value = "";
            }
        });
    </script>
</x-layout>

<x-layout>
    <x-slot:title>
        Login
    </x-slot>
    <main class="flex justify-center w-full">
        <div class="flex flex-col items-center justify-center p-20 w-lg ">
            <h1 class="text-4xl font-bold mb-2">Login</h1>
            <span class="text-gray-500 mb-6">Entre com suas credenciais</span>
            <form action="{{ route('login') }}" method="POST" class="w-full">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Senha:</label>
                    <input type="password" name="password" id="password" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between mb-6">
                    <button type="submit"
                        class="bg-[#486B7A] hover:bg-[#3B5560] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer w-full">
                        Entrar
                    </button>
                </div>
                <p class="text-center text-gray-500 mt-4">Não tem uma conta? <a href="{{ route('register') }}"
                        class="text-[#486B7A] hover:text-[#3B5560] hover:underline font-semibold">Cadastre-se</a>
                </p>
            </form>
        </div>
    </main>
</x-layout>

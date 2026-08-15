<x-guest-layout>
    <!-- Left Side: Image -->
    <div class="hidden md:block md:w-1/2 bg-cover bg-center relative rounded-l-2xl" style="background-image: url('{{ asset('images/image-login-register.png') }}'); min-height: 500px;">
        <!-- Overlay/Logo if needed, or just the image -->
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center rounded-r-2xl">
        <h2 class="text-3xl font-bold text-[#5C4033] text-center mb-8">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email :</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Kata Sandi:</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>



            <!-- Remember Me -->
            <div class="block mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-[#5C4033] text-[#5C4033] shadow-sm focus:ring-[#5C4033]" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-center mb-6">
                <button type="submit" class="w-full bg-[#5C4033] text-white font-bold py-3 px-4 rounded-full hover:bg-[#4a332a] transition duration-200">
                    Login
                </button>
            </div>

            <!-- Google Login (Placeholder) -->            
        </form>
    </div>
</x-guest-layout>

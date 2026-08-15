<x-guest-layout>
    <!-- Left Side: Image -->
    <div class="hidden md:block md:w-1/2 bg-cover bg-center relative rounded-l-2xl" style="background-image: url('{{ asset('images/image-login-register.png') }}'); min-height: 500px;">
        <!-- Overlay/Logo if needed, or just the image -->
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center rounded-r-2xl">
        <h2 class="text-3xl font-bold text-[#5C4033] text-center mb-8">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Nama :</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email :</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Nomor HP :</label>
                <input id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="tel"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Kata Sandi :</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Kata Sandi :</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Already Registered Link -->
            <div class="flex items-center justify-center mb-6 text-sm">
                <div class="text-gray-600">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Login</a>
                </div>
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-center mb-6">
                <button type="submit" class="w-full bg-[#5C4033] text-white font-bold py-3 px-4 rounded-full hover:bg-[#4a332a] transition duration-200">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>

<x-guest-layout>
    <!-- Left Side: Image -->
    <div class="hidden md:block md:w-1/2 bg-cover bg-center relative rounded-l-2xl" style="background-image: url('{{ asset('images/image-login-register.png') }}'); min-height: 500px;">
    </div>

    <!-- Right Side: Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center rounded-r-2xl">
        <h2 class="text-3xl font-bold text-[#5C4033] text-center mb-8">Lupa Password</h2>

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email :</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="w-full px-4 py-3 rounded-full border border-[#5C4033] focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50"
                    placeholder="">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit" class="w-full bg-[#5C4033] text-white font-bold py-3 px-4 rounded-full hover:bg-[#4a332a] transition duration-200">
                    {{ __('Kirim Tautan Reset Password') }}
                </button>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-[#5C4033] underline">Kembali ke Login</a>
            </div>
        </form>
    </div>
</x-guest-layout>

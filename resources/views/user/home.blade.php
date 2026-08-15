<x-app-layout> 
    <section class="relative py-16 md:py-36 overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/bg-home.png') }}');">
        <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">            
            <div class="space-y-6 z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight font-serif">
                    Berawal Dari Sebatas Kopi, <br>
                    <span class="text-white font-normal">Menjadi Teman Akrab Ngopi.</span>
                </h1>
                <p class="text-white text-lg" style="font-family: 'Joan', serif;">
                    Nikmati secangkir kopi terbaik, pesan online dan dapat dinikmati segera!
                </p>                
                <p class="text-sm font-semibold text-white ">Mau minum apa hari ini?</p>                
                <form action="{{ route('menu') }}" method="GET" class="relative max-w-md">
                    <input type="text" name="search" placeholder="Search Here..." 
                        class="w-full bg-[#5C4033] text-white placeholder-gray-300 rounded-full py-3 px-6 focus:outline-none focus:ring-2 focus:ring-amber-600">
                    <button type="submit" class="absolute right-2 top-1.5 bg-white p-1.5 rounded-full text-[#5C4033]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>            
        </div>
    </section>
    <section class="py-16 bg-white" style="font-family: 'Joan', serif;">
        <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">            
            <div>
                <div class="-mt-44 -ml-24 -mb-16">
                   <img src="{{ asset('images/element.png') }}" alt="">
                </div>
                <h2 class="text-4xl font-serif font-bold text-gray-800 mb-6">Welcome About Us!</h2>
                <div class="space-y-4 text-xl text-gray-600 text-justify leading-relaxed">
                    <p>Selamat datang, tempat di mana kopi bukan hanya sekadar minuman, tetapi juga ruang untuk singgah sejenak, berbagi cerita, dan menjadi rumah kedua yang nyaman bagi siapa pun yang sering kembali.</p>
                    <p>Di setiap kunjungan, kami ingin menghadirkan pengalaman kopi yang terasa tepat—bukan hanya enak, tetapi juga dibuat dari bahan yang bisa dipercaya. Kami menaruh perhatian besar pada pemilihan biji kopi, proses pengolahan, hingga cara penyajiannya.</p>
                </div>
            </div>

            <div class="h-96">
                <img src="{{ asset('images/bg-home-2.png') }}" class="w-full h-full object-cover rounded-l-xl">
            </div>
        </div>
    </section>

    <section class="bg-[#1a1a1a] text-white py-20 relative">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-3xl font-bold text-[#d4af37] mb-12" style="font-family: 'Hanken Grotesk', serif;">Best Sellers</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <div class="flex items-center space-x-6 group">
                    <div class="relative w-32 md:w-40 flex-shrink-0">
                        <img src="{{ asset('images/americano-lemon.png') }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-[#d4af37] mb-2" style="font-family: 'Hanken Grotesk', serif;">Americano Lemon</h3>
                        <p class="text-gray-400 leading-relaxed mb-3 text-xl" style="font-family: 'Joan', serif;">
                            Americano Lemon adalah perpaduan kopi Americano yang bold dan segar dengan sentuhan lemon alami. Espresso menghasilkan kopi yang ringan namun tetap pekat dan dipadukan dengan aroma citrus lemon yang menyegarkan.
                        </p>
                    </div>
                </div>

        
                <div class="flex items-center space-x-6 group">
                    <div class="relative w-32 md:w-40 flex-shrink-0">
                        <img src="{{ asset('images/salted-creme-brulee.png') }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-[#d4af37] mb-2" style="font-family: 'Hanken Grotesk', serif;">Salted Creme Brulee</h3>
                        <p class="text-gray-400 leading-relaxed mb-3 text-xl" style="font-family: 'Joan', serif;">
                            Salted Creme Brulee adalah kopi espresso yang creamy, dipadukan dengan foam gula merah karamel bakar khas crème brûlée, lalu diberi sentuhan garam laut yang ringan untuk menyeimbangkan rasa manisnya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('cart') }}" class="inline-block bg-white text-black font-serif px-8 py-2 rounded-full hover:bg-gray-200 transition" style="font-family: 'Joan', serif;">
                    Order Here
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#fdfbf7]">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-center text-3xl font-serif font-bold text-[#5C4033] mb-12">~Menu Category~</h2>

            <div class="flex flex-col space-y-6">
                
                @foreach($categories as $category)
                    
                    @if($loop->odd)
                    <a href="{{ route('menu', ['category' => $category->id]) }}" class="flex items-center">
                        <div class="z-10 w-24 h-24 rounded-full border-4 border-white shadow-lg overflow-hidden flex-shrink-0">
                            <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://source.unsplash.com/random/200x200/?coffee,'.$category->slug }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="bg-[#cba678] text-[#5C4033] -ml-10 pl-14 pr-8 py-3 rounded-r-full flex-grow shadow-md hover:bg-[#b08d5f] transition cursor-pointer">
                            <h3 class="font-bold text-lg">{{ $category->name }}</h3>
                        </div>
                        <div class="w-1/4"></div> </a>

                    @else
                    <a href="{{ route('menu', ['category' => $category->id]) }}" class="flex items-center justify-end">
                        <div class="w-1/4"></div> <div class="bg-[#5C4033] text-[#cba678] -mr-10 pr-14 pl-8 py-3 rounded-l-full flex-grow text-right shadow-md hover:bg-[#4a332a] transition cursor-pointer">
                            <h3 class="font-bold text-lg">{{ $category->name }}</h3>
                        </div>
                        <div class="z-10 w-24 h-24 rounded-full border-4 border-white shadow-lg overflow-hidden flex-shrink-0">
                            <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://source.unsplash.com/random/200x200/?beverage,'.$category->slug }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </a>
                    @endif

                @endforeach

            </div>
        </div>
    </section>

    <footer>
        
        <!-- BAGIAN ATAS: Background Warna #cbb593 -->
        <div class="bg-[#cbb593] pt-12 pb-12">
            <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-[#4a3b32]">
                
                <!-- Social Media (Updated: Menggunakan Tag <a> dan SVG Putih) -->
                <div class="flex flex-col items-start space-y-4">
                    <div class="flex space-x-4">
                        
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 bg-gradient-to-tr from-yellow-400 to-purple-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition duration-300 shadow-md">
                            <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/>
                            </svg>
                        </a>

                        <!-- Facebook -->
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition duration-300 shadow-md">
                            <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z"/>
                            </svg>
                        </a>

                        <!-- X (Twitter) -->
                        <a href="#" class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white hover:scale-110 transition duration-300 shadow-md">
                            <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.234 10.162 22.977 0h-2.072l-7.591 8.824L7.251 0H.258l9.168 13.343L.258 24H2.33l8.016-9.318L16.749 24h6.993zm-2.837 3.299-.929-1.329L3.076 1.56h3.182l5.965 8.532.929 1.329 7.754 11.09h-3.182z"/>
                            </svg>
                        </a>

                        <!-- WhatsApp -->
                        <a href="#" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition duration-300 shadow-md">
                            <svg class="w-5 h-5 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                        
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="text-center">
                    <h4 class="font-serif font-bold text-xl uppercase tracking-widest">Senin - Minggu</h4>
                    <p class="text-lg font-medium mt-1">14.00 PM - 23.00 PM</p>
                </div>

                <!-- Spacer (Agar layout grid seimbang 3 kolom) -->
                <div></div>
            </div>
        </div>
        <!-- BATAS BAGIAN ATAS (Background #cbb593 berakhir di sini) -->

        <!-- BAGIAN BAWAH: Background Putih, Teks Hitam -->
        <div class="bg-white text-black py-10">
            <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                
                <!-- Address -->
                <div>
                    <h5 class="font-bold text-lg mb-4 font-serif text-[#5C4033]">Come Visit Us:</h5>
                    <div class="flex items-start space-x-3 mb-4">
                        <svg class="w-5 h-5 mt-1 text-[#5C4033]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <p class="text-gray-700 leading-relaxed">Jalan Pagar Alam No. 22, Balige, Sumatera Utara,<br>Indonesia 22316</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 mt-1 text-[#5C4033]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>                        
                        <p class="text-gray-700">Ps. Laguboti, Kec. Laguboti, Toba, Sumatera Utara</p>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h5 class="font-bold text-lg mb-4 font-serif text-[#5C4033]">Contact for more info:</h5>
                    <div class="flex items-center space-x-3 mb-3">
                        <svg class="w-5 h-5 mt-1 text-[#5C4033]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <p class="text-gray-700 font-medium">081212908737</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 mt-1 text-[#5C4033]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <p class="text-gray-700 font-medium">085358556678</p>
                    </div>
                </div>

            </div>
        </div>
        <!-- BATAS BAGIAN BAWAH -->

    </footer>

</x-app-layout>
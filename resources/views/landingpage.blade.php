<!DOCTYPE html>
<html lang="id" x-data="{ mobileMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebatas Kopi - Kopi yang kami minum sendiri</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&family=Inter:wght@300;400;500;600;700;800&family=Hanken+Grotesk:wght@300;400;500;600;700;800&family=Joan&display=swap" rel="stylesheet">
    
    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Hanken Grotesk', 'Inter', sans-serif;
        }
        
        .hero-bg {
            background-image: url('/images/bg-landing-page.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .text-shadow-glow {
            text-shadow: 0 0 20px rgba(251, 191, 36, 0.5), 0 0 40px rgba(251, 191, 36, 0.3);
        }
        
        .btn-glow {
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.4);
        }
        
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(251, 191, 36, 0.6);
        }
    </style>
</head>
<!-- tambahkan font Hanken Grotesk -->
<body class="bg-black text-white antialiased">
    
    {{-- Include Navbar --}}
    @include('layouts.navigation')
    
    {{-- Hero Section --}}
    <section class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
        {{-- Decorative Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-amber-600/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center">
                {{-- Main Heading --}}
                <h1 class="text-5xl font-bold mb-6 px-10">
                    Di Sebatas Kopi, kami menyajikan kopi yang kami minum sendiri 
                </h1>
                
                {{-- Subtitle --}}
                <p class="text-lg md:text-xl lg:text-2xl text-gray-300 mx-auto mb-12 leading-relaxed px-10" style="font-family: 'Joan', serif;">
                    Biji yang dipilih dengan hati-hati, diracik segar setiap hari, dan dibuat konsisten supaya rasanya tetap sama, kapan pun kamu datang
                </p>
                
                {{-- CTA Button menggunakan font Joan--}}
                <div class="flex flex-col sm:flex-row gap-4  justify-center items-center" style="font-family: 'Joan', serif;">
                        <a href="{{ route('home') }}" class="px-10 py-2 text-[22px] bg-[#532E1C] text-white rounded-full hover:bg-[#532E1C] transition-all duration-300 inline-flex items-center gap-2" style="font-family: 'Joan', serif;">
                            <span class="">Mulai Pesan</span>                            
                        </a>                    
                </div>
                <!-- batas font Joan -->
            </div>
        </div>    
    </section>
     
    
     
    
    
</body>
</html>

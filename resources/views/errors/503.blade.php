<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situs Sedang Diperbarui - D'Moroy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #faf9f6;
        }
        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="antialiased text-gray-800 flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Efek Latar Belakang -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-5 pointer-events-none">
        <svg viewBox="0 0 100 100" class="w-full h-full object-cover">
            <pattern id="Dmoroy-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <circle cx="10" cy="10" r="2" fill="#8b0000" />
                <path d="M0,10 Q5,5 10,10 T20,10" fill="none" stroke="#8b0000" stroke-width="0.5"/>
            </pattern>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#Dmoroy-pattern)"/>
        </svg>
    </div>

    <div class="max-w-xl mx-auto px-8 py-14 text-center bg-white rounded-3xl shadow-xl shadow-red-900/5 relative z-10 border border-red-50">
        <div class="w-24 h-24 bg-red-50 text-red-800 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner shadow-red-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.83-5.83M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v.01M8 6v.01M6 8v.01M4 12v.01" />
            </svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Segera Kembali</h1>
        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            Website <strong>D'Moroy</strong> saat ini sedang dalam proses pemeliharaan dan peningkatan sistem untuk melayani Anda lebih baik.<br>Silakan kembali dalam beberapa saat lagi.
        </p>
        
        <div class="inline-flex items-center justify-center space-x-3 text-sm text-gray-600 bg-gray-50 px-6 py-3 rounded-full border border-gray-100">
            <span class="flex h-3 w-3 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
            </span>
            <span class="font-medium tracking-wide">Sistem sedang diperbarui</span>
        </div>
    </div>
</body>
</html>

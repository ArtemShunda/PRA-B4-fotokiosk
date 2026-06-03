<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/resources/components/head.php'; ?>
    <title>Fotokiosk</title>
</head>
<body class="bg-[linear-gradient(rgba(0,0,0,0.15),rgba(0,0,0,0.15)),url('/img/pattern.jpg')] bg-repeat bg-[length:300px_300px] flex flex-col min-h-screen">
    <header>
        <div class="header-container sticky top-0 z-40 backdrop-blur-md bg-[#2C2B3C]/95 border-b border-white/10 mx-auto py-5 px-8 flex items-center justify-between shadow-lg">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-yellow-200">Fotokiosk</h1>
            <button id="open-modal-button" class="text-yellow-200 hover:text-yellow-300 transition duration-300 focus:outline-none">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="w-8 h-8">
                    <path d="M23 2.13h-2.6a1.49 1.49 0 0 0 -1.46 1.15l-1.12 4.65a0.26 0.26 0 0 1 -0.25 0.2H1.09a1 1 0 0 0 -0.81 0.41 1 1 0 0 0 -0.14 0.9l2.67 8a1 1 0 0 0 0.95 0.69H15.1a0.25 0.25 0 0 1 0.2 0.09 0.26 0.26 0 0 1 0 0.21l-0.11 0.5a0.26 0.26 0 0 1 -0.25 0.2H4.92a2.25 2.25 0 1 0 2.3 2.25 0.25 0.25 0 0 1 0.08 -0.18 0.22 0 0 1 0.17 -0.07h6a0.25 0.25 0 0 1 0.25 0.25 2.25 2.25 0 1 0 3.57 -1.83 0.22 0.22 0 0 1 -0.09 -0.25l3.52 -15a0.26 0.26 0 0 1 0.28 -0.17h2a1 1 0 0 0 0 -2Z" fill="currentColor" stroke-width="1"></path>
                    <path d="M9.8 7.13h5.29a1 1 0 0 0 0.91 -0.56 1 1 0 0 0 -0.09 -1.05L13.93 3l-0.09 -0.11a1.62 1.62 0 0 0 -2.29 0L9.08 5.43a1 1 0 0 0 0.72 1.7Z" fill="currentColor" stroke-width="1"></path>
                    <path d="M1.4 6.53a1 1 0 0 0 0.92 0.6h4.31a1 1 0 0 0 0.83 -0.46 1 1 0 0 0 0.08 -1l-2 -4.42a1.6 1.6 0 0 0 -1 -0.86 1.73 1.73 0 0 0 -1.23 0.16L1 1.61a1.67 1.67 0 0 0 -0.84 2.16Z" fill="currentColor" stroke-width="1"></path>
                </svg>
            </button>
            
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-6 py-16 flex flex-col lg:flex-row gap-8 w-full flex-grow items-stretch">
        <div class="main-container w-full lg:w-1/2 py-14 px-10 bg-[#2C2B3C]/95 backdrop-blur-md rounded-3xl shadow-2xl border border-white/10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-yellow-200 mb-6">Welkom bij de Fotokiosk!</h2>
            <p class="text-gray-300 mb-4">Hier kunt u uw foto's bekijken, bewerken en afdrukken. Klik op de onderstaande knop om te beginnen.</p>
            <a href="<?php echo $base_url; ?>/resources/fotokiosk/index.php" class="inline-block bg-yellow-200 text-[#2C2B3C] font-bold py-2 px-4 rounded hover:bg-yellow-300 transition duration-300 self-start">Start Fotokiosk</a>
        </div>
        <div class="w-full md:w-1/2 h-[420px] bg-[#2C2B3C]/50 rounded-lg border-2 border-dashed border-gray-500/50 flex items-center justify-center overflow-hidden">
            <img src="img/fotos/0_Zondag/10_05_30_id8824.jpg" alt="Fotokiosk foto" class="w-full h-full object-cover">
        </div>

    </main>
    <footer class="bg-[#2C2B3C]/95 backdrop-blur-md border-t border-white/10 py-4 px-7 text-gray-400 text-sm mt-auto">
        <div class="max-w-7xl mx-auto">
            <p>&copy; 2026 Fotokiosk. Nikita-Artem-Berkay.</p>
        </div>
    </footer>
    <div id="my-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        
        <div class="bg-[#2C2B3C]/95 backdrop-blur-xl text-white w-full max-w-md rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.45)] overflow-hidden border border-white/10">
            
            <div class="flex justify-between items-center border-b border-gray-700 p-4 bg-[#1E1D2A]">
                <h3 class="text-lg font-bold tracking-wide uppercase text-yellow-200">Winkelmandje</h3>
                <button id="close-modal-button" class="text-gray-400 hover:text-white text-xl font-bold">&times;</button>
            </div>
            
            
            <div class="p-4 max-h-[300px] overflow-y-auto">
                <p class="text-xs font-semibold text-gray-400 uppercase mb-3 tracking-wider">Mijn items</p>
                
                
                <div class="space-y-3">
                    
                    <div class="flex items-center gap-3 bg-[#1E1D2A]/50 p-2 rounded">
                        <div class="w-12 h-12 bg-gray-600 rounded"></div>
                        <div class="flex-grow h-4 bg-gray-700 rounded-sm"></div>
                        <div class="w-16 h-4 bg-gray-700 rounded-sm"></div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-[#1E1D2A]/50 p-2 rounded">
                        <div class="w-12 h-12 bg-gray-600 rounded"></div>
                        <div class="flex-grow h-4 bg-gray-700 rounded-sm"></div>
                        <div class="w-16 h-4 bg-gray-700 rounded-sm"></div>
                    </div>
                </div>
            </div>

            
            <div class="border-t border-gray-700 p-4 bg-[#1E1D2A] flex justify-between items-center gap-4">
                <div>
                    <span class="text-xl font-bold text-yellow-200">$666</span>
                    <span class="text-[10px] text-gray-400 block">incl. btw</span>
                </div>
                <button class="bg-yellow-200 text-[#2C2B3C] hover:bg-yellow-300 font-bold py-2 px-4 rounded transition duration-300 text-sm">
                    Bestellen en Betalen
                </button>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>

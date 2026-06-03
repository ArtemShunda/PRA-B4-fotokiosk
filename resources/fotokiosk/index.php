<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../components/head.php'; ?>
    <title>Fotokiosk fotos</title>
</head>

<body class="overflow-hidden">
    <div id="my-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div
            class="bg-[#2C2B3C] text-white w-full max-w-md rounded-lg shadow-2xl overflow-hidden border border-gray-700">

            <div class="flex justify-between items-center border-b border-gray-700 p-4 bg-[#1E1D2A]">
                <h3 class="text-lg font-bold tracking-wide uppercase text-yellow-200">Winkelmandje</h3>
                <button id="close-modal-button"
                    class="text-gray-400 hover:text-white text-xl font-bold">&times;</button>
            </div>

            <div class="p-4 max-h-[300px] overflow-y-auto">
                <p class="text-xs font-semibold text-gray-400 uppercase mb-3 tracking-wider">Mijn items</p>

                <!-- DIT WORDT AUTOMATISCH GEVULD -->
                <div id="cart-items" class="space-y-3"></div>
            </div>

            <div class="border-t border-gray-700 p-4 bg-[#1E1D2A] flex justify-between items-center gap-4">
                <div>
                    <span id="cart-total" class="text-xl font-bold text-yellow-200">€0,00</span>
                    <span class="text-[10px] text-gray-400 block">incl. btw</span>
                </div>
                <button
                    class="bg-yellow-200 text-[#2C2B3C] hover:bg-yellow-300 font-bold py-2 px-4 rounded transition duration-300 text-sm">
                    Bestellen en Betalen
                </button>
            </div>
        </div>
    </div>
    <header>
        <div class="header-container bg-[#2C2B3C] mx-auto py-4 px-7 flex items-center justify-between">
            <a href="../../index.php">
                <h1 class="text-4xl font-bold text-yellow-200">Fotokiosk</h1>
            </a>

            <button id="open-modal-button"
                class="relative text-yellow-200 hover:text-yellow-300 transition duration-300 focus:outline-none">
                <svg xmlns="http://www.w3.org" viewBox="0 0 24 24" class="w-8 h-8">
                    <path
                        d="M23 2.13h-2.6a1.49 1.49 0 0 0 -1.46 1.15l-1.12 4.65a0.26 0.26 0 0 1 -0.25 0.2H1.09a1 1 0 0 0 -0.81 0.41 1 1 0 0 0 -0.14 0.9l2.67 8a1 1 0 0 0 0.95 0.69H15.1a0.25 0.25 0 0 1 0.2 0.09 0.26 0.26 0 0 1 0 0.21l-0.11 0.5a0.26 0.26 0 0 1 -0.25 0.2H4.92a2.25 2.25 0 1 0 2.3 2.25 0.25 0.25 0 0 1 0.08 -0.18 0.22 0 0 1 0.17 -0.07h6a0.25 0.25 0 0 1 0.25 0.25 2.25 2.25 0 1 0 3.57 -1.83 0.22 0 0 1 -0.09 -0.25l3.52 -15a0.26 0.26 0 0 1 0.28 -0.17h2a1 1 0 0 0 0 -2Z"
                        fill="currentColor"></path>
                </svg>

                <!-- WINKELMAND TELLER -->
                <span id="cart-count"
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">0</span>
            </button>
        </div>
    </header>
    <div class="
                mx-auto
                h-screen
                bg-[linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url('/img/pattern.jpg')]
                grid
                bg-repeat
                bg-[length:300px_300px]
                grid-cols-[10%_1fr_10%]  
                grid-rows-[80%]

    ">
        <div class="left-row z-50 flex justify-center items-center">
        </div>
        <div class="flex justify-center items-center content">
            <!-- SLIDES -->
            <div id="slider" class="w-full h-full flex transition-transform duration-500">

                <div class="slide min-w-full flex items-center justify-center text-white text-3xl">
                    <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>20-11-22</span><span class="ml-[70%]">20:31</span></h1>
                </div>
                <div class=" span-2 overflow-hidden grid grid-cols-2 justify-between"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg"> </div>
                <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center"> <a
                        href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-2 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
                </div>

                <div class="slide min-w-full flex items-center justify-center text-white text-3xl">
                    <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>226-11-22</span><span class="ml-[70%]">20:31</span></h1>
                </div>
                <div class=" span-2 overflow-hidden grid grid-cols-2 justify-between"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg"> </div>
               <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center"> <a
                        href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-2 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
                </div>

                <div class="slide min-w-full flex items-center justify-center text-white text-3xl">
                    <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>026-11-22</span><span class="ml-[70%]">20:31</span></h1>
                </div>
                <div class=" span-2 overflow-hidden grid grid-cols-2 justify-between"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg"> </div>
                <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center"> <a
                        href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-2 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
                </div>

                <div class="slide min-w-full flex items-center justify-center text-white text-3xl">
                    <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>202-22</span><span class="ml-[70%]">20:31</span></h1>
                </div>
                <div class=" span-2 overflow-hidden grid grid-cols-2 justify-between"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg"> </div>
                <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center"> <a
                        href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-2 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
                </div>

                <div class="slide min-w-full flex items-center justify-center text-white text-3xl">
                    <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>2026-1</span><span class="ml-[70%]">20:31</span></h1>
                </div>
                <div class="span-2 overflow-hidden grid grid-cols-2 justify-between"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg"> <img
                        class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg"> </div>
                <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center"> <a
                        href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-2 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
                </div>

            </div>
        </div>
        <div class="right-row z-50 flex justify-center items-center">
        </div>
        <footer class="bg-[#2C2B3C] py-10 px-7 fill text-gray-400 text-sm mt-auto col-span-full">
            <div class="max-w-7xl mx-auto">
                <p>&copy; 2026 Fotokiosk. Nikita-Artem-Berkay.</p>
            </div>
        </footer>
    </div>
    <script src="../../js/main.js"></script>
</body>

</html>

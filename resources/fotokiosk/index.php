<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../components/head.php'; ?>
    <title>Fotokiosk fotos</title>
</head>

<body>
    <header>
        <div class="header-container bg-[#2C2B3C] mx-auto py-4 px-7 flex items-center justify-between">
            <a href="../../index.php">
                <h1 class="text-4xl font-bold text-yellow-200">Fotokiosk</h1>
            </a>
            <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="w-8 h-8 text-yellow-200">
                <path
                    d="M23 2.13h-2.6a1.49 1.49 0 0 0 -1.46 1.15l-1.12 4.65a0.26 0.26 0 0 1 -0.25 0.2H1.09a1 1 0 0 0 -0.81 0.41 1 1 0 0 0 -0.14 0.9l2.67 8a1 1 0 0 0 0.95 0.69H15.1a0.25 0.25 0 0 1 0.2 0.09 0.26 0.26 0 0 1 0 0.21l-0.11 0.5a0.26 0.26 0 0 1 -0.25 0.2H4.92a2.25 2.25 0 1 0 2.3 2.25 0.25 0.25 0 0 1 0.08 -0.18 0.22 0 0 1 0.17 -0.07h6a0.25 0.25 0 0 1 0.25 0.25 2.25 2.25 0 1 0 3.57 -1.83 0.22 0.22 0 0 1 -0.09 -0.25l3.52 -15a0.26 0.26 0 0 1 0.28 -0.17h2a1 1 0 0 0 0 -2Z"
                    fill="currentColor" stroke-width="1"></path>
                <path
                    d="M9.8 7.13h5.29a1 1 0 0 0 0.91 -0.56 1 1 0 0 0 -0.09 -1.05L13.93 3l-0.09 -0.11a1.62 1.62 0 0 0 -2.29 0L9.08 5.43a1 1 0 0 0 0.72 1.7Z"
                    fill="currentColor" stroke-width="1"></path>
                <path
                    d="M1.4 6.53a1 1 0 0 0 0.92 0.6h4.31a1 1 0 0 0 0.83 -0.46 1 1 0 0 0 0.08 -1l-2 -4.42a1.6 1.6 0 0 0 -1 -0.86 1.73 1.73 0 0 0 -1.23 0.16L1 1.61a1.67 1.67 0 0 0 -0.84 2.16Z"
                    fill="currentColor" stroke-width="1"></path>
            </svg>
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

    ">
        <div class="flex justify-center items-center">
            <div>
                <svg viewBox="0 0 24 24" class="w-[100px] h-[100px]" fill="none" xmlns="http://www.w3.org/2000/svg"
                    transform="rotate(270)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <div class="bg-[#2C2B3C] rounded-2xl w-[90%] h-[550px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                <div class="text-white pl-5 pt-3">
                    <h1 class="text-2xl">Date: <span>2026-11-22</span><span>20:31</span></h1>
                </div>
                <div class=" span-2 overflow-hidden grid grid-cols-2 justify-between">
                    <img class="mx-auto w-[90%] h-[80%] rounded-2xl border-[#2C2B3C]-500" src="/img/pattern.jpg">
                    <img class="mx-auto w-[90%] h-[80%] rounded-2xl" src="/img/fotokiosk-background.jpg">
                </div>
                <div class="w-[130px] h-[90px] mx-auto text-center flex justify-center items-center">
                    <a href="<?php echo $base_url; ?>/resources/fotokiosk/index.php"
                        class="inline-block bg-yellow-200 mt-[20px] text-[#2C2B3C] font-bold py-4 px-12 rounded hover:bg-yellow-300 transition duration-300 self-start">Kopen</a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <div>
                <svg viewBox="0 0 24 24" class="w-[100px] h-[100px]" fill="none" xmlns="http://www.w3.org/2000/svg"
                    transform="rotate(90)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
        </div>
    </div>
        <footer class="bg-[#2C2B3C] py-6 px-7 fill text-gray-400 text-sm mt-auto">
            <div class="max-w-7xl mx-auto">
                <p>&copy; 2026 Fotokiosk. Nikita-Artem-Berkay.</p>
            </div>
        </footer>
</body>

</html>
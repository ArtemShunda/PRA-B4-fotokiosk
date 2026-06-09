<?php

$todayNumber = date('w');

$dagMappen = [
    0 => '0_Zondag',
    1 => '1_Maandag',
    2 => '2_Dinsdag',
    3 => '3_Woensdag',
    4 => '4_Donderdag',
    5 => '5_Vrijdag',
    6 => '6_Zaterdag'
];

$huidigeMap = $dagMappen[$todayNumber];

$fotosPad = dirname(__DIR__, 2) . '/img/fotos/' . $huidigeMap . '/';

$fotos = [];

if (is_dir($fotosPad))
{
    foreach (scandir($fotosPad) as $file)
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg']))
        {
            $fotos[] = $fotosPad . $file;
        }
    }
}


function getTimestampFromFilename($file)
{
    $name = basename($file);

    if (
        preg_match(
            '/(\d{2})_(\d{2})_(\d{2})/',
            $name,
            $m
        )
    ) {

        return strtotime(
            $m[1] . ':' .
            $m[2] . ':' .
            $m[3]
        );
    }

    return 0;
}

function getTimeFromFilename($file)
{
    $name = basename($file);

    if (
        preg_match(
            '/(\d{2})_(\d{2})_(\d{2})/',
            $name,
            $m
        )
    ) {

        return $m[1] . ':' . $m[2] . ':' . $m[3];
    }

    return '--:--:--';
}

usort($fotos, function ($a, $b) {
    return getTimestampFromFilename($a) <=> getTimestampFromFilename($b);
});

$slides = [];
$used = [];

foreach ($fotos as $foto1) {

    if (in_array($foto1, $used)) {
        continue;
    }

    $time1 = getTimestampFromFilename($foto1);

    $bestMatch = null;
    $bestDiff = PHP_INT_MAX;

    foreach ($fotos as $foto2) {

        if ($foto1 === $foto2) {
            continue;
        }

        if (in_array($foto2, $used)) {
            continue;
        }

        $time2 = getTimestampFromFilename($foto2);

        $diff = abs($time2 - $time1);

        if ($diff >= 55 && $diff <= 65) {

            if ($diff < $bestDiff) {
                $bestDiff = $diff;
                $bestMatch = $foto2;
            }
        }
    }

    if ($bestMatch) {

        $slides[] = [
            'foto1' => $foto1,
            'tijd1' => getTimeFromFilename($foto1),

            'foto2' => $bestMatch,
            'tijd2' => getTimeFromFilename($bestMatch)
        ];

        $used[] = $foto1;
        $used[] = $bestMatch;
    }
}

shuffle($slides); // перемешать пары

$slides = array_slice($slides, 0, 20); // оставить только 20 слайдов

$totalSlides = count($slides);

$debugInfo =
    "Map: {$huidigeMap} | Foto's: " .
    count($fotos) .
    " | Slides: " .
    $totalSlides;
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <?php require_once '../components/head.php'; ?>
    <title>Fotokiosk - <?php echo $huidigeMap; ?></title>
    <style>
        .timer-container {
            position: fixed;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.8);
            padding: 10px 20px;
            border-radius: 50px;
            font-family: monospace;
            font-size: 1.8rem;
            font-weight: bold;
            color: #fde047;
            letter-spacing: 2px;
            backdrop-filter: blur(8px);
            z-index: 60;
            pointer-events: none;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .timer-container span:first-child {
            font-size: 0.9rem;
            margin-right: 10px;
            color: #ddd;
        }
        .timer-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background-color: #fde047;
            width: 100%;
            transition: width linear 0.1s;
            border-radius: 3px;
        }
        .slide-indicator {
            position: fixed;
            bottom: 40px;
            right: 20px;
            background: rgba(0,0,0,0.6);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: white;
            font-family: monospace;
            z-index: 60;
        }
        .left-row, .right-row {
            cursor: pointer;
            font-size: 3rem;
            color: white;
            transition: all 0.3s;
        }
        .left-row:hover, .right-row:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.1);
        }
        .buy-button {
            cursor: pointer;
        }
        .slide img {
            background: #1a1a2e;
            min-height: 280px;
            object-fit: cover;
        }
        .debug-info {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background: rgba(0,0,0,0.5);
            color: #0f0;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 4px;
            z-index: 999;
            font-family: monospace;
        }
    </style>
</head>

<body class="overflow-hidden">
    <!-- MODAL WINKELMAND -->
    <div id="my-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-[#2C2B3C] text-white w-full max-w-md rounded-lg shadow-2xl overflow-hidden border border-gray-700">
            <div class="flex justify-between items-center border-b border-gray-700 p-4 bg-[#1E1D2A]">
                <h3 class="text-lg font-bold tracking-wide uppercase text-yellow-200">Winkelmandje</h3>
                <button id="close-modal-button" class="text-gray-400 hover:text-white text-xl font-bold">&times;</button>
            </div>
            <div class="p-4 max-h-[300px] overflow-y-auto">
                <p class="text-xs font-semibold text-gray-400 uppercase mb-3 tracking-wider">Mijn items</p>
                <div id="cart-items" class="space-y-3"></div>
            </div>
            <div class="border-t border-gray-700 p-4 bg-[#1E1D2A] flex justify-between items-center gap-4">
                <div>
                    <span id="cart-total" class="text-xl font-bold text-yellow-200">€0,00</span>
                    <span class="text-[10px] text-gray-400 block">incl. btw</span>
                </div>
                <button class="bg-yellow-200 text-[#2C2B3C] hover:bg-yellow-300 font-bold py-2 px-4 rounded transition duration-300 text-sm">
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
            <button id="open-modal-button" class="relative text-yellow-200 hover:text-yellow-300 transition duration-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8">
                    <path d="M23 2.13h-2.6a1.49 1.49 0 0 0 -1.46 1.15l-1.12 4.65a0.26 0.26 0 0 1 -0.25 0.2H1.09a1 1 0 0 0 -0.81 0.41 1 1 0 0 0 -0.14 0.9l2.67 8a1 1 0 0 0 0.95 0.69H15.1a0.25 0.25 0 0 1 0.2 0.09 0.26 0.26 0 0 1 0 0.21l-0.11 0.5a0.26 0.26 0 0 1 -0.25 0.2H4.92a2.25 2.25 0 1 0 2.3 2.25 0.25 0.25 0 0 1 0.08 -0.18 0.22 0 0 1 0.17 -0.07h6a0.25 0.25 0 0 1 0.25 0.25 2.25 2.25 0 1 0 3.57 -1.83 0.22 0 0 1 -0.09 -0.25l3.52 -15a0.26 0.26 0 0 1 0.28 -0.17h2a1 1 0 0 0 0 -2Z" fill="currentColor"></path>
                </svg>
                <span id="cart-count" class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">0</span>
            </button>
        </div>
    </header>

    <!-- Timer en indicator -->
    <div class="timer-container" id="timerDisplay">
        <span>⏱️ Volgende foto in</span> <span id="timerMinutes">05</span>:<span id="timerSeconds">00</span>
        <div class="timer-progress" id="timerProgress"></div>
    </div>
    <div class="slide-indicator" id="slideIndicator">
        📸 Set <span id="currentSlideNum">1</span> / <span id="totalSlidesNum"><?php echo $totalSlides; ?></span>
    </div>
    
    

    <div class="mx-auto h-screen bg-[linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url('/img/pattern.jpg')] grid bg-repeat bg-[length:300px_300px] grid-cols-[10%_1fr_10%] grid-rows-[80%]">
        <div class="left-row z-50 flex justify-center items-center">
            ◀
        </div>
        <div class="flex justify-center items-center content overflow-hidden">
            <div id="slider" class="w-full h-full flex transition-transform duration-500">
                <?php if ($totalSlides > 0): ?>
                    <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide min-w-full flex items-center justify-center text-white text-3xl" data-slide-index="<?php echo $index; ?>">
                        <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] grid grid-cols-1 grid-rows-[10%_72%_18%]">
                            <div class="text-white pl-5 pt-3">
                                <h1 class="text-2xl">
                                    📅 Datum: <span><?php echo date('d-m-Y'); ?></span>
                                    <span class="ml-[30%]">⏰ Tijden:</span>
                                </h1>
                                <div class="text-sm mt-1">
                                    <span>Foto 1: <?php echo $slide['tijd1']; ?></span>
                                    <?php if($slide['foto2']): ?>
                                    <span class="ml-5">Foto 2: <?php echo $slide['tijd2']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="span-2 overflow-hidden grid grid-cols-2 justify-between gap-4 p-4">
                                <?php if($slide['foto1']): 
                                    $fotoPath1 = '/img/fotos/' . $huidigeMap . '/' . basename($slide['foto1']);
                                ?>
                                <img class="mx-auto w-full h-[280px] rounded-2xl object-cover shadow-lg" 
                                     src="<?php echo $fotoPath1; ?>" 
                                     alt="Foto <?php echo $index+1; ?> links"
                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=Foto+niet+gevonden'; this.parentElement.innerHTML+='<div class=text-red-400 text-sm>Pad: <?php echo $fotoPath1; ?></div>'">
                                <?php endif; ?>
                                <?php if($slide['foto2']): 
                                    $fotoPath2 = '/img/fotos/' . $huidigeMap . '/' . basename($slide['foto2']);
                                ?>
                                <img class="mx-auto w-full h-[280px] rounded-2xl object-cover shadow-lg" 
                                     src="<?php echo $fotoPath2; ?>" 
                                     alt="Foto <?php echo $index+1; ?> rechts"
                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=Foto+niet+gevonden'; this.parentElement.innerHTML+='<div class=text-red-400 text-sm>Pad: <?php echo $fotoPath2; ?></div>'">
                                <?php else: ?>
                                <div class="flex items-center justify-center bg-gray-800 rounded-2xl">
                                    <span class="text-gray-400">Geen foto</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="w-[130px] h-[40px] mx-auto text-center flex justify-center items-center gap-3">
                                <button class="buy-button inline-block bg-yellow-200 text-[#2C2B3C] font-bold py-2 px-6 rounded hover:bg-yellow-300 transition duration-300"
                                        data-photo-name="Foto set <?php echo $index+1; ?> - <?php echo $slide['tijd1']; ?>"
                                        data-photo-price="2.50"
                                        data-photo-img="<?php echo '/img/fotos/' . $huidigeMap . '/' . basename($slide['foto1']); ?>">
                                    💰 Kopen €2,50  
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="slide min-w-full flex items-center justify-center">
                        <div class="bg-[#2C2B3C] rounded-2xl w-[85%] h-[500px] flex items-center justify-center">
                            <div class="text-center text-white">
                                <h2 class="text-2xl mb-4">⚠️ Geen foto's gevonden</h2>
                                <p class="text-sm">Map: <?php echo $huidigeMap; ?></p>
                                <p class="text-xs mt-4">Zorg dat de foto's in de map 'img/fotos/<?php echo $huidigeMap; ?>/' staan</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="right-row z-50 flex justify-center items-center">
            ▶
        </div>
        <footer class="bg-[#2C2B3C] py-10 px-7 fill text-gray-400 text-sm mt-auto col-span-full">
            <div class="max-w-7xl mx-auto">
                <p>&copy; 2026 Fotokiosk | Nikita-Artem-Berkay | Vandaag: <?php echo $huidigeMap; ?> | <?php echo count($fotos); ?> foto's gevonden</p>
            </div>
        </footer>
    </div>

    <script>
    // -----------------------------
    // MODAL FUNCTIES
    // -----------------------------
    const openBtn = document.getElementById("open-modal-button");
    const closeBtn = document.getElementById("close-modal-button");
    const modal = document.getElementById("my-modal");

    if(openBtn && closeBtn && modal) {
        openBtn.addEventListener("click", () => modal.classList.remove("hidden"));
        closeBtn.addEventListener("click", () => modal.classList.add("hidden"));
        modal.addEventListener("click", (e) => { if(e.target === modal) modal.classList.add("hidden"); });
    }

    // -----------------------------
    // WINKELMAND
    // -----------------------------
    let cart = [];
    const cartCount = document.getElementById("cart-count");
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    function addToCart(product) {
        cart.push(product);
        updateCart();
    }

    function updateCart() {
        if(cartItems) cartItems.innerHTML = "";
        let total = 0;
        cart.forEach((item, idx) => {
            total += item.price;
            if(cartItems) {
                cartItems.innerHTML += `
                    <div class="flex items-center gap-3 bg-[#1E1D2A]/50 p-2 rounded">
                        <img src="${item.img}" class="w-12 h-12 rounded object-cover" onerror="this.src='https://via.placeholder.com/100?text=Foto'">
                        <div class="flex-grow">
                            <p class="text-yellow-200 font-semibold">${item.name}</p>
                            <p class="text-gray-300 text-sm">€${item.price.toFixed(2)}</p>
                        </div>
                    </div>
                `;
            }
        });
        if(cartTotal) cartTotal.textContent = "€" + total.toFixed(2);
        if(cartCount) cartCount.textContent = cart.length;
    }

    // -----------------------------
    // SLIDER & 5-MINUTEN TIMER
    // -----------------------------
    let currentIndex = 0;
    const slider = document.getElementById("slider");
    const slides = document.querySelectorAll(".slide");
    const totalSlides = slides.length;
    
    let timeLeft = 60;
    let timerInterval = null;
    
    const timerMinutesSpan = document.getElementById("timerMinutes");
    const timerSecondsSpan = document.getElementById("timerSeconds");
    const timerProgressDiv = document.getElementById("timerProgress");
    const currentSlideNumSpan = document.getElementById("currentSlideNum");
    
    function updateProgressBar() {
        if(timerProgressDiv) {
            const percent = (timeLeft /  60) * 100;
            timerProgressDiv.style.width = `${percent}%`;
        }
    }
    
    function updateTimerDisplay() {
        if(timerMinutesSpan && timerSecondsSpan) {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerMinutesSpan.textContent = minutes.toString().padStart(2, '0');
            timerSecondsSpan.textContent = seconds.toString().padStart(2, '0');
        }
        updateProgressBar();
    }
    
    function updateSliderPosition() {
        if(slider) {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
        if(currentSlideNumSpan) {
            currentSlideNumSpan.textContent = (currentIndex + 1).toString();
        }
    }
    
    function nextSlide() {

    if(totalSlides === 0) return;

    if(currentIndex >= totalSlides - 1)
    {
        location.reload();
        return;
    }

    currentIndex++;

    updateSliderPosition();
    resetTimer();
}
    
    function prevSlide() {
        if(totalSlides === 0) return;
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSliderPosition();
        resetTimer();
    }
    
    function stopTimer() {
        if(timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }
    }
    
    function resetTimer() {
        stopTimer();
        timeLeft =  60;
        updateTimerDisplay();
        startTimer();
    }
    
    function startTimer() {
        if(totalSlides === 0) return;
        timerInterval = setInterval(() => {
            if(timeLeft <= 1) {
                nextSlide();
            } else {
                timeLeft--;
                updateTimerDisplay();
            }
        }, 1000);
    }
    
    // Event listeners voor pijltjes
    const leftRow = document.querySelector(".left-row");
    const rightRow = document.querySelector(".right-row");
    
    if(leftRow) leftRow.addEventListener("click", () => prevSlide());
    if(rightRow) rightRow.addEventListener("click", () => nextSlide());
    
    // Toetsenbord navigatie
    document.addEventListener("keydown", (e) => {
        if(e.key === "ArrowLeft") { prevSlide(); e.preventDefault(); }
        else if(e.key === "ArrowRight") { nextSlide(); e.preventDefault(); }
    });
    
    // Koopknoppen
    function attachBuyButtons() {
        document.querySelectorAll(".buy-button").forEach(btn => {
            btn.removeEventListener("click", handleBuyClick);
            btn.addEventListener("click", handleBuyClick);
        });
    }
    
    function handleBuyClick(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        addToCart({
            name: btn.getAttribute("data-photo-name") || "Foto",
            price: parseFloat(btn.getAttribute("data-photo-price")) || 2.50,
            img: btn.getAttribute("data-photo-img") || ""
        });
        btn.textContent = "✓ Toegevoegd!";
        setTimeout(() => {
            btn.textContent = "💰 Kopen €2,50";
        }, 1000);
    }
    
    // Start alles
    if(totalSlides > 0) {
        startTimer();
        updateSliderPosition();
        attachBuyButtons();
    }
    
    console.log("✅ Fotokiosk geladen | Totaal slides: " + totalSlides);
    </script>
</body>

</html>
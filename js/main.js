// -----------------------------
// MODAL OPEN/DICHT (jouw code)
// -----------------------------
const openBtn = document.getElementById("open-modal-button");
const closeBtn = document.getElementById("close-modal-button");
const modal = document.getElementById("my-modal");

openBtn.addEventListener("click", () => {
  modal.classList.remove("hidden");
});

closeBtn.addEventListener("click", () => {
  modal.classList.add("hidden");
});

modal.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.classList.add("hidden");
  }
});

// -----------------------------
// WINKELMAND FUNCTIONALITEIT
// -----------------------------
let cart = [];

const cartCount = document.getElementById("cart-count");
const cartItems = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");

// Product toevoegen
function addToCart(product) {
  cart.push(product);
  updateCart();
}

// Winkelmand bijwerken
function updateCart() {
  cartItems.innerHTML = "";
  let total = 0;

  cart.forEach((item) => {
    total += item.price;

    cartItems.innerHTML += `
            <div class="flex items-center gap-3 bg-[#1E1D2A]/50 p-2 rounded">
                <img src="${item.img}" class="w-12 h-12 rounded object-cover">
                <div class="flex-grow">
                    <p class="text-yellow-200 font-semibold">${item.name}</p>
                    <p class="text-gray-300 text-sm">€${item.price.toFixed(2)}</p>
                </div>
            </div>
        `;
  });

  cartTotal.textContent = "€" + total.toFixed(2);
  cartCount.textContent = cart.length;
}

// -----------------------------
// VOORBEELD: AANROEPEN VANUIT SLIDER
// -----------------------------
// addToCart({
//     name: "Foto 10x15",
//     price: 2.50,
//     img: "img/fotos/voorbeeld.jpg"
// });
let index = 0;
const slider = document.getElementById("slider");
const totalSlides = 5;

function updateSlider() {
  slider.style.transform = `translateX(-${index * 100}%)`;
}

document.querySelector(".right-row").addEventListener("click", () => {
  index = (index + 1) % totalSlides;
  updateSlider();
});

document.querySelector(".left-row").addEventListener("click", () => {
  index = (index - 1 + totalSlides) % totalSlides;
  updateSlider();
});

addToCart({
  name: "Achtbaan",
  price: 2.5,
  img: "../../img/fotos/0_Zondag/10_05_30_id8824.jpg",
});

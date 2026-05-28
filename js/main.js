const openBtn = document.getElementById('open-modal-button');
const closeBtn = document.getElementById('close-modal-button');
const modal = document.getElementById('my-modal');


openBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
});


closeBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
});


modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
});
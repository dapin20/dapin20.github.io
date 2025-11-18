
// home.js
// Mengatur perilaku hamburger panel di halaman home

const hamburgerBtn = document.getElementById('hamburgerBtn');
const hamburgerPanel = document.getElementById('hamburgerPanel');
const hamburgerClose = document.getElementById('hamburgerClose');
const hamburgerOverlay = document.getElementById('hamburgerOverlay');

function openPanel() {
  if (hamburgerPanel && hamburgerOverlay) {
    hamburgerPanel.classList.add('open');
    hamburgerOverlay.classList.add('open');
    hamburgerPanel.setAttribute('aria-hidden', 'false');
    hamburgerOverlay.setAttribute('aria-hidden', 'false');
  }
}

function closePanel() {
  if (hamburgerPanel && hamburgerOverlay) {
    hamburgerPanel.classList.remove('open');
    hamburgerOverlay.classList.remove('open');
    hamburgerPanel.setAttribute('aria-hidden', 'true');
    hamburgerOverlay.setAttribute('aria-hidden', 'true');
  }
}

if (hamburgerBtn) {
  hamburgerBtn.addEventListener('click', openPanel);
}
if (hamburgerClose) {
  hamburgerClose.addEventListener('click', closePanel);
}
if (hamburgerOverlay) {
  hamburgerOverlay.addEventListener('click', closePanel);
}

// Tutup panel ketika menekan Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closePanel();
});


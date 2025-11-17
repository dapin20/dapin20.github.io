// CLEAR EMAIL BUTTON
const emailInput = document.getElementById("email");
const clearEmail = document.getElementById("clearEmail");

if (clearEmail && emailInput) {
  clearEmail.addEventListener("click", () => {
    emailInput.value = "";
    emailInput.focus();
  });

  // Sembunyikan tombol X kalau input kosong
  emailInput.addEventListener("input", () => {
    clearEmail.style.display = emailInput.value.length > 0 ? "block" : "none";
  });

  // Awal: sembunyikan jika belum ada teks
  clearEmail.style.display = "none";
}

// TOGGLE PASSWORD BUTTON
const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

if (togglePassword && passwordInput) {
  togglePassword.addEventListener("click", () => {
    const type = passwordInput.type === "password" ? "text" : "password";
    passwordInput.type = type;

    // Ubah icon mata
    togglePassword.textContent = type === "password" ? "👁" : "🙈";
  });
}

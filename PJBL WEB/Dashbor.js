const menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        // Hilangkan active dari semua
        menuItems.forEach(i => i.classList.remove('active'));

        // Tambahkan active pada yang diklik
        item.classList.add('active');
    });
});
const menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        menuItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
    });
});


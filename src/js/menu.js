document.addEventListener('DOMContentLoaded', function() {
const mobileMenu = document.getElementById('mobileMenu');
const menuicon = document.getElementById('menuicon');

function toggleMenu() {
    mobileMenu.classList.toggle('hidden');
    menuicon.classList.toggle('fa-bars');
    menuicon.classList.toggle('fa-x');
}
});

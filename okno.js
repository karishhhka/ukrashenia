const mainImage = document.querySelector('.main-image');
const popup = document.getElementById('popup');

mainImage.addEventListener('mouseover', () => {
    popup.style.display = "block";
});

mainImage.addEventListener('mouseleave', () => {
    popup.style.display = "none";
});

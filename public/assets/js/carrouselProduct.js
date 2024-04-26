const thumbnailsContainer = document.querySelector('.carrousel__thumbnail');
const mainImage = document.getElementById('main-image');

// Selecciona todas las imágenes de miniatura
const thumbnailImgs = document.querySelectorAll('.carrousel__thumbnailIMG');

// Crea y agrega miniaturas
thumbnailImgs.forEach((thumbnailImg, index) => {
    const thumbnail = document.createElement('div');
    thumbnail.classList.add('thumbnail');
    thumbnail.dataset.index = index;
    thumbnail.style.backgroundImage = `url(${thumbnailImg.src})`;

    thumbnail.addEventListener('click', () => {
        // Cambia la imagen principal al hacer clic en la miniatura
        mainImage.src = thumbnailImg.src;

        // Agrega la clase activa a la miniatura correspondiente
        document.querySelector('.thumbnail.active').classList.remove('active');
        thumbnail.classList.add('active');

        // Desplaza las miniaturas para mostrar la miniatura activa en el centro
        const thumbnailsHeight = thumbnailsContainer.offsetHeight;
        const thumbnailHeight = thumbnail.offsetHeight;
        const thumbnailsTop = thumbnailsContainer.scrollTop;
        const thumbnailTop = thumbnail.offsetTop;
        const thumbnailIndex = parseInt(thumbnail.dataset.index);

        if (thumbnailIndex === 0) {
            thumbnailsContainer.scrollTop = 0;
        } else if (thumbnailIndex === thumbnailImgs.length - 1) {
            thumbnailsContainer.scrollTop = thumbnailsHeight;
        } else if (thumbnailTop < thumbnailsTop) {
            thumbnailsContainer.scrollTop = thumbnailTop;
        } else if (thumbnailTop + thumbnailHeight > thumbnailsTop + thumbnailsHeight) {
            thumbnailsContainer.scrollTop = thumbnailTop + thumbnailHeight - thumbnailsHeight;
        }
    });

    thumbnailsContainer.appendChild(thumbnail);
});

// Establece la imagen principal en la primera imagen
mainImage.src = thumbnailImgs[0].src;

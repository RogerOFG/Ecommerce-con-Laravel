document.addEventListener('DOMContentLoaded', function() {
    const modalImage = document.getElementById('modalImage');
    const modalClose = document.getElementById('modalClose');
    const imgPreview = document.getElementById('imgPreview');
    const idProductInput = document.getElementById('idProduct');
    const images = document.querySelectorAll('.form__picture');

    modalClose.addEventListener('click', function() {
        modalImage.classList.remove('modal--active');
    });

    images.forEach(function(item) {
        item.addEventListener('click', function() {
            const urlImage = this.getAttribute('data-image-url');
            const productId = this.getAttribute('data-product-id');

            imgPreview.src = this.src;
            idProductInput.value = productId;
            modalImage.classList.add('modal--active');
        });
    });

    const deleteIcons = document.querySelectorAll('.form__delete-pic');

    deleteIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            const imageName = this.getAttribute('data-image-name');
            const productId = this.parentElement.parentElement.querySelector('.form__picture').getAttribute('data-product-id');

            deleteImage(productId, imageName);
        });
    });

    function deleteImage(productId, imageName) {
        axios.delete('/dashboard/product/' + productId + '/image/' + imageName + '/delete')
            .then(response => {
                console.log(response.data.message);
                // Lógica adicional después de la eliminación
                // Por ejemplo, puedes recargar la página para actualizar la lista de imágenes
                window.location.reload();
            })
            .catch(error => {
                console.error(error.response.data.message);
            });
    }
});
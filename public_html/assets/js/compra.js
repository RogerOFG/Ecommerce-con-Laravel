const checkboxes = document.querySelectorAll('.checkbox__input');
const addressID = document.querySelectorAll('.addressID');
const addressChoose = document.getElementById('addressChoose');

checkboxes.forEach(function(item){
    item.addEventListener("click", function(){
        checkboxes.forEach(function(checkbox){
            if (checkbox !== item) {
                checkbox.checked = false;
                checkbox.closest('.cart__ubi').classList.remove('cart__ubi--checked');
            }
        });

        item.checked = true;
        item.closest('.cart__ubi').classList.add('cart__ubi--checked');

        // Obtenemos el valor del input hermano addressID
        const addressInput = item.closest('.cart__ubi').querySelector('.addressID');
        if (addressInput) {
            const addressText = addressInput.value;
            addressChoose.value = addressText
        }
    });
});

function openFormAddress(){
    const form = document.getElementById('formAddress');
    const glass = document.getElementById('glass');

    if(form.classList.contains('main--show')){
        form.classList.remove('main--show');
        glass.classList.remove('glass--show');
    }else{
        form.classList.add('main--show');
        glass.classList.add('glass--show');
    }
}

function validateAddress(){
    const addressChoose = document.getElementById('addressChoose').value;
    const alertAddress = document.getElementById('alertAddress');
    const alertContinue = document.getElementById('alertContinue');
    
    if(addressChoose == ""){
        window.scrollTo({ top: 0, behavior: 'smooth' });
        alertAddress.classList.add('active-alert');
        
        setTimeout(() => {
            alertAddress.classList.remove('active-alert');
        }, 4000);

        return false;
    }else{
        alertContinue.classList.add('active');

        return false;
    }
}

// Confirmar envio del formulario (finalizar compra)
document.getElementById('confirmYes').addEventListener('click', function() {
    document.querySelector('.footer__submit').submit();
});

// Cancelar envio del formulario (finalizar compra)
document.getElementById('confirmNo').addEventListener('click', function() {
    const alertContinue = document.getElementById('alertContinue');
    alertContinue.classList.remove('active');
});
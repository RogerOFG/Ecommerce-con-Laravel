const checkboxes = document.querySelectorAll('.checkbox__input');

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
    });
<<<<<<< HEAD
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
=======
});
>>>>>>> da6e634 (changes)

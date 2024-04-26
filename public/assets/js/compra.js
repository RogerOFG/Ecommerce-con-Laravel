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
});
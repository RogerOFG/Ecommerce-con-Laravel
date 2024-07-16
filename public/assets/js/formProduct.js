function changeForm() {
    const category = document.getElementById('categoryProduct').value;
    var bisuteriaForm = document.querySelectorAll('.bisuteriaForm');
    var relojeriaForm = document.querySelectorAll('.relojeriaForm');

    if (category == "Relojeria") {
        bisuteriaForm.forEach(function(item) {
            item.classList.add('hidde');
            item.querySelectorAll('input, select, textarea').forEach(function(input) {
                input.removeAttribute('required');
            });
        });

        relojeriaForm.forEach(function(item) {
            item.classList.remove('hidde');
            item.querySelectorAll('input, select, textarea').forEach(function(input) {
                input.setAttribute('required', 'required');
            });
        });
    } else if (category == "Bisuteria") {
        bisuteriaForm.forEach(function(item) {
            item.classList.remove('hidde');
            item.querySelectorAll('input, select, textarea').forEach(function(input) {
                input.setAttribute('required', 'required');
            });
        });

        relojeriaForm.forEach(function(item) {
            item.classList.add('hidde');
            item.querySelectorAll('input, select, textarea').forEach(function(input) {
                input.removeAttribute('required');
            });
        });
    }
}

changeForm();
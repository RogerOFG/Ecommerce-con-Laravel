const headerNav = document.getElementById('headerNav');
const headerUl = document.getElementById('headerUl');
const btnMenu = document.getElementById('btnMenu');

btnMenu.addEventListener('click', function(){
    headerNav.classList.remove('no-animate');
    headerUl.classList.remove('no-animate');

    if(headerNav.classList.contains('active')){
        headerNav.classList.remove('active');
    }else{
        headerNav.classList.add('active');
    }
});

const alert = document.querySelector('.alert-controller');

if(alert){
    setTimeout(() => {
        alert.classList.add('active');

        setTimeout(() => {
            alert.classList.remove('active');
        }, 4000);
    }, 10);
}
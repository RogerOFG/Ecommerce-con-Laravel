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
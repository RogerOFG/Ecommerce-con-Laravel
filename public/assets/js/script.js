const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("container--active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("container--active");
});

// Validar Formulario de Registro
const formRegister = document.getElementById('formularioRegister');
const inputs = document.querySelectorAll('#formularioRegister .form__input');

const expresiones = {
	name: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	surname: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	password: /^.{8,}$/, // 8 a 30 digitos.
}

const campos = {
    name: false,
    surname: false,
    email: false,
    password: false
}

const validarFormulario = (e)=>{
    switch(e.target.name){
        case "name":
            validarCampo(expresiones.name, e.target, 'name');
        break

        case "surname":
            validarCampo(expresiones.surname, e.target, 'surname');
        break

        case "email":
            validarCampo(expresiones.email, e.target, 'email');   
        break

        case "password":
            validarCampo(expresiones.password, e.target, 'password');    
            validarPassword2();    
        break

        case "password2":
            validarPassword2();
        break
    }
}

const validarCampo = (expresion, input, campo)=>{
    if(input.value != ""){
        if(expresion.test(input.value)){
            document.querySelector(`#grupo__${campo} input`).classList.add('valid');
            document.querySelector(`#grupo__${campo} input`).classList.remove('error');

            document.querySelector(`#grupo__${campo} .form__error`).classList.remove('active');
            campos[campo] = true;
        }else{
            document.querySelector(`#grupo__${campo} input`).classList.add('error');
            document.querySelector(`#grupo__${campo} input`).classList.remove('valid');

            document.querySelector(`#grupo__${campo} .form__error`).classList.add('active');
            campos[campo] = false;
        }
    }else{
        document.querySelector(`#grupo__${campo} input`).classList.remove('valid');
        document.querySelector(`#grupo__${campo} input`).classList.remove('error');
        document.querySelector(`#grupo__${campo} .form__error`).classList.remove('active');
    }

}

const validarPassword2 = ()=>{
    const inputPassword1 = document.getElementById('password');
    const inputPassword2 = document.getElementById('password2');

    if(inputPassword1.value !== inputPassword2.value){
        document.querySelector(`#grupo__password2 input`).classList.add('error');
        document.querySelector(`#grupo__password2 input`).classList.remove('valid');

        document.querySelector(`#grupo__password2 .form__error`).classList.add('active');
        campos['password'] = false;
    }else{
        document.querySelector(`#grupo__password2 input`).classList.remove('error');
        document.querySelector(`#grupo__password2 input`).classList.add('valid');

        document.querySelector(`#grupo__password2 .form__error`).classList.remove('active');
        campos['password'] = true;
    }
}

inputs.forEach((input)=> {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
})

formRegister.addEventListener('submit', (e)=>{
    e.preventDefault();

    if(campos.name && campos.surname && campos.email && campos.password){
        formRegister.reset();
    }
});

function showPass(inputId, showId, hideId) {
    const input = document.getElementById(inputId);
    const showPass = document.getElementById(showId);
    const hiddePass = document.getElementById(hideId);

    if (showPass.classList.contains('active')) {
        input.setAttribute('type', 'text');
        showPass.classList.remove('active');
        hiddePass.classList.add('active');
    } else {
        input.setAttribute('type', 'password');
        showPass.classList.add('active');
        hiddePass.classList.remove('active');
    }
}
let showPsw = document.getElementById('showPsw');
let password = document.getElementById('password');

showPsw.addEventListener('click', () =>{
    let eye = showPsw.querySelector('.fa-regular');
    let eyeSlash = showPsw.querySelector('.fa-solid');
    
    if (password.type == "password"){
        password.type = "text";
        eye.classList.add('hide');
        eyeSlash.classList.remove('hide');
    }else{
        password.type = "password";
        eyeSlash.classList.add('gide');
        eye.classList.remove('hide');
    }
})
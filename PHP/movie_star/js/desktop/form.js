window.addEventListener("load", ()=> {
    // Opens the login tab if the user logged out or has just registered -----
    if(document.querySelector(".messageDisplay") != null) {
        if(document.querySelector(".messageDisplay").classList.contains("msgSuccess")) {
            sessionStorage.setItem("type", "login"); 
        }
    }
    // Mantain the form on login or register if the page refreshes -----------
    if(sessionStorage.getItem("type") != "register") {
        document.querySelector("#login").style.display = 'flex';
        document.querySelector("#register").style.display = 'none';
    }
    else{
        document.querySelector("#login").style.display = 'none';
        document.querySelector("#register").style.display = 'flex';
        document.querySelector("#select-checkbox").checked = true;
    }
})

// Changes the form type between login and register --------------------------
document.querySelector(".select-form-button").addEventListener('click', ()=> {
    if(document.querySelector("#select-checkbox").checked) {
        document.querySelector("#login").style.display = 'none';
        document.querySelector("#register").style.display = 'flex';
        sessionStorage.setItem("type", "register");   
    }
    else {
        document.querySelector("#login").style.display = 'flex';
        document.querySelector("#register").style.display = 'none';
        sessionStorage.setItem("type", "login");
    }
})
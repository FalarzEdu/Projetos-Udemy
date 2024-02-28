// Var to store input info in case of the user give up to change it
let inputContent = "";
// Creates an event listener to every pencil icon
document.querySelectorAll(".change-pencil").forEach(element => {
    if(element.name == "pencil-password") {
        element.addEventListener("click", ()=> {
            document.querySelector("#new-pass-group").style.display = "block";
            document.querySelector("#conf-new-pass-group").style.display = "block";
        })
    }
    element.addEventListener("click", (event)=> {
        // Creates a const for the input
        const input = event.target.previousElementSibling;
        // Makes the input editable
        input.readOnly = false;
        // Focus on input
        input.focus();
        // Stores the input value on the global var set previously
        inputContent = input.value;
        // Deletes field value for user input
        input.value = "";
        // Makes the confirm and cancel buttons visible
        event.target.nextElementSibling.style.display = "flex";
        event.target.nextElementSibling.nextElementSibling.style.display = "flex";
        // Turns the pencil invisible
        event.target.style.display = "none";
    })
});

document.querySelector(".bio").addEventListener("click", () => {
    const bio = document.querySelector(".bio");
    inputContent = bio.value;
    bio.readOnly = false;
    const buttons = document.querySelector(".bio").nextElementSibling.childNodes;
    buttons[3].style.visibility = "visible";
    buttons[1].style.visibility = "visible";
})

// Function that creates an event lister for every cancel button
document.querySelectorAll(".deny-change").forEach(element => {
    if(element.name == "x-password") {
        element.addEventListener("click", ()=> {
            document.querySelector("#new-pass-group").style.display = "none";
            document.querySelector("#conf-new-pass-group").style.display = "none";
        })
    }
    if(element.name == "x-bio") {
        element.addEventListener("click", (event) => {
            document.querySelector(".bio").value = inputContent;
            event.target.style.visibility = "hidden";
            event.target.previousElementSibling.style.visibility = "hidden";
        })
    }
    element.addEventListener("click", (event) => {
        // Creates a constf for the pencil SVG.
        const pencilSvg = event.target.previousElementSibling.previousElementSibling;
        // Torna visível o "lápis".
        pencilSvg.style.display = "flex";
        // Makes the confirm and cancel buttons invisible
        event.target.style.display = "none";
        event.target.previousElementSibling.style.display = "none";
        // Returns the original value of the input
        pencilSvg.previousElementSibling.value = inputContent;
        // Makes the input not editable again
        pencilSvg.previousElementSibling.readOnly = true;
    })
})

// Function to open the windows for image change
document.querySelector("#user-photo").addEventListener("click", () => {
    // Makes the windows visible and adds blur to the rest of the page
    document.querySelector(".pop-up").style.display = "block";
    document.querySelector("main").style.filter = "blur(2px)"; 
    // Function to close the windows and remove the page blur
    document.querySelector(".close-popup").addEventListener("click", () => {
        document.querySelector(".pop-up").style.display = "none";
        document.querySelector("main").style.filter = "none";
    })
})
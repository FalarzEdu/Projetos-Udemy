// Activates the burger menu ----------------------------------------------------
document.querySelector(".menu-mobile-icon").addEventListener("click", () => {
    document.querySelector(".menu-mobile").style.display = "flex";

    document.querySelector(".menu-mobile-close").addEventListener("click", () => {
        document.querySelector(".menu-mobile").style.display = "none";
    })
})

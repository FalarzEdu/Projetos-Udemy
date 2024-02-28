// Adds a event listener to every "X" button for movie delete action ------------
document.querySelectorAll(".delete-movie").forEach(element => {
    element.addEventListener("click", (event) => {
        // Activates the confirmation popup -------------------------------------
        document.querySelector(".delete-popup").style.display = "block";
        // Activats blur effect on the rest of the content --------------------
        document.querySelector("main").style.filter = "blur(2px)";
        // Finds the id of the movie which is located inside of a hidden input --
        document.querySelector("#delete-popup-id").value = event.target.parentElement.previousElementSibling.value;
        // If the table "X" is clicked another event listener will be created for the "X" of the popup to close the opened tab
        document.querySelector("#close-delete-popup").addEventListener("click", () => {
            document.querySelector(".delete-popup").style.display = "none";
            document.querySelector("main").style.filter = "none";
        })
    })
})

document.querySelectorAll(".update-movie").forEach(element => {
    element.addEventListener("click", (event) => {
        // Activates the update form popup ------------------------------------
        document.querySelector(".update-popup").style.display = "block";
        // Activats blur effect on the rest of the content --------------------
        document.querySelector("main").style.filter = "blur(2px)";
        // Finds the id of the movie which is located inside of a hidden input --
        document.querySelector("#update-popup-id").value = event.target.parentElement.previousElementSibling.value;

        const parentElement = event.target.parentElement.parentElement;

        document.querySelector("#title").value = parentElement.querySelector(".movie-title").innerText;
        document.querySelector("#length").value = parentElement.querySelector(".movie-length").innerText;

        // If the update icon is clicked another event listener will be created for the "X" of the popup to close the opened tab
        document.querySelector("#close-update-popup").addEventListener("click", () => {
            document.querySelector(".update-popup").style.display = "none";
            document.querySelector("main").style.filter = "none";
        })
    })
})
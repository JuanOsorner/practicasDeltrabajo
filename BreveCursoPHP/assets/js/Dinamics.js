document.addEventListener("DOMContentLoaded", () => {
    const modalContainer = document.getElementById("modalConteiner");
    const saveButton = document.getElementById("saveButton");
    async function loadModal() {
        try{
            // We need to fetch the modal HTML content
            const response = await fetch("../Views/modals.html");
            // We take the text of the response 
            const html = await response.text();
            // Insert the HTML into the modal container
            modalContainer.innerHTML = html;
            // Call the function to show the modal
            showModal();
        }catch(error){
            console.error("Error loading modal:", error);
        }
    }
    function showModal(){
        const modal = document.getElementById("nameModal");
        const closeModalButton = document.getElementById("closeModalButton");
        saveButton.addEventListener("click", (r)=>{
            r.preventDefault();
            modal.style.display = "flex"; // Show the modal
        })
        closeModalButton.addEventListener("click", (r) => {
            r.preventDefault();
            modal.style.display = "none"; // Hide the modal
        });
    }
    // Load the modal when the page is ready
    loadModal();
});
/*
*/
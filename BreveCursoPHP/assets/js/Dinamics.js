document.addEventListener("DOMContentLoaded", () => {
    const saveButton = document.getElementById("saveButton");
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
});
/*
Lets star again whit the code. I want to try modular of the code.

1. Lets start with the DOM of all our website. 

- Remember that we star writing document.addEventListener("DOMContentLoaded", () => {...
  cause we need to load the DOM before we start to manipulate it.

- Remember that a promise is when we are waitng for something to finish before 
  we continue with the code.

- examples: asyc, await, fetch, text.

- asyc makes a fuction asynchronous, meaning it will return a promise.

- await is used to wait for a promise to resolve before continuing with the code.

- fetch is used to make a request to a server and return a promise.

- text is used to convert a response to text.

- There exist other DOM objet like: target, currentTarget, event, etc.

- target is the element that triggered the event.
*/
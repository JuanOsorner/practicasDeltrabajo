// I want to add a modal to show a error if the user dont put a name
// Now we have a modal, so the next step is hide it or show it
// Im creating a dyynamic bettween html and js
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click',()=>{
    if(document.getElementById('name').value === "") {
        //alert("Probando");
        const modal = document.getElementById('nameModal');
        modal.style.display = 'flex';
        return;
    }else{
        const name = document.getElementById('name').value;
        const text = document.getElementById('userName');
        text.classList.add("userNameTag");
        text.textContent = name;
        return;
    }
});
//Now we gonna hide the modal whit a button
const closeModalButton = document.getElementById('closeModalButton');
closeModalButton.addEventListener('click', (e) => {
    e.preventDefault();
    modal.style.display = 'none';
    return;
})
//I have some error but i wanna fix it later
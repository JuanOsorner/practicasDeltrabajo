// Im creating a dyynamic bettween html and js
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click',()=>{
    if(document.getElementById('name').value === "") {
        alert("Por favor, ingrese su nombre");
        return;
    }else{
        const name = document.getElementById('name').value;
        const text = document.getElementById('userName');
        text.classList.add("userNameTag");
        text.textContent = name;
        return;
    }
});
//selectors
const button = document.querySelector(".submit");
const pass = document.getElementById("inputPassword4");
const conpass = document.getElementById("inputPassword5");
const errorElement = document.getElementById("ghalta");
//listners 
button.addEventListener('click',check);
//functions
function check(e){
    if (pass.value === 'password') {
        e.preventDefault();
        errorElement.innerText='Password cannot be "password"';
    } 
    if(pass.value!==conpass.value){
        e.preventDefault();
        errorElement.innerText='Password And Confirmation Are different !';
    }    
}
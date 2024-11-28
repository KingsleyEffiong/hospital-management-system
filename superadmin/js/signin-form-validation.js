
//form Submission
const passwordSubmit = document.getElementById("passwordSubmit");
const submitButton = document.getElementById("submission");


passwordSubmit.addEventListener("submit", function(event){
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;


    if(password !== confirmPassword  ){
        event.preventDefault();
        alert("Please enter a valid password")
    }

})


submitButton.addEventListener("click", function(){
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;


    if(password === confirmPassword && !passwordSubmit.value === '') {
        passwordSubmit.submit(); 
        
    }
})

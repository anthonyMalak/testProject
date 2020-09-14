function validateEmailForm(){
    var email = document.getElementById("email").value;
    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
    if(!email.match(pattern)){
        alert("the filled email is not an email kindly renter a valide email");
        return false;
    }else{
        return true;
    }
}
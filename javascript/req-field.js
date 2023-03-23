window.onload = function(){
    document.getElementById("mainForm").onsubmit = function(e){
        var requiredFields = document.getElementsByClassName("required");
        var invalid = false;
        for(var i = 0; i < requiredFields.length; i++){
            var fieldValue = requiredFields[i].value;
            if(fieldValue == null || fieldValue.trim() == ""){
                e.preventDefault();
                requiredFields[i].classList.add("highlight");
                invalid = true;
            } else {
                requiredFields[i].classList.remove("highlight");
            }
        }   
        if (invalid == true){
            alert("Please fill out the required area. please");
        }
    };
}
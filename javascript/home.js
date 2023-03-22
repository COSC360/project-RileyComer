function selectTop() {
    temp=document.getElementsByClassName("top-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("top-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
    temp=document.getElementsByClassName("new-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("new-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
}

function selectNew() {
    temp=document.getElementsByClassName("new-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("new-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
    temp=document.getElementsByClassName("top-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("top-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
}

function selectText() {
    document.getElementById("text-on").style.display="inline";
    document.getElementById("text-off").style.display="none";
    document.getElementById("image-off").style.display="inline";
    document.getElementById("image-on").style.display="none";
}
function selectImage() {
    document.getElementById("image-on").style.display="inline";
    document.getElementById("image-off").style.display="none";
    document.getElementById("text-off").style.display="inline";
    document.getElementById("text-on").style.display="none";
}

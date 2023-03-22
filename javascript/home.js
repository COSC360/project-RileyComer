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
    temp=document.getElementsByClassName("text-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("text-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
    temp=document.getElementsByClassName("image-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("image-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
}
function selectImage() {
    temp=document.getElementsByClassName("image-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("image-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
    temp=document.getElementsByClassName("text-off");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="inline";
    }
    temp=document.getElementsByClassName("text-on");
    for (var i = 0; i < temp.length; i++ ) {
        temp[i].style.display="none";
    }
}

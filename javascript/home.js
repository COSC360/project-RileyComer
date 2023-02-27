function selectTop() {
    document.getElementById("top-on").style.display="inline";
    document.getElementById("top-off").style.display="none";
    document.getElementById("new-off").style.display="inline";
    document.getElementById("new-on").style.display="none";
}

function selectNew() {
    document.getElementById("new-on").style.display="inline";
    document.getElementById("new-off").style.display="none";
    document.getElementById("top-off").style.display="inline";
    document.getElementById("top-on").style.display="none";
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

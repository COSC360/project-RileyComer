function openNav() {
    document.getElementById("nav-container").style.width = "300px";
    document.getElementById("content").style.marginLeft = "300px";
    document.getElementById("nav-button-opened").style.display="inline";
    document.getElementById("nav-button-closed").style.display="none";
}
  
function closeNav() {
    document.getElementById("nav-container").style.width = "0";
    document.getElementById("content").style.marginLeft = "0";
    document.getElementById("nav-button-opened").style.display="none";
    document.getElementById("nav-button-closed").style.display="inline";
}
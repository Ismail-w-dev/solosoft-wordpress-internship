document.addEventListener("DOMContentLoaded",function(){
    let checkPartner = document.getElementById("check-partner");
    let resellerField = document.querySelector(".condition-checkbox");
    checkPartner.addEventListener("change",function(){
        if(checkPartner.checked){
            resellerField.classList.add("show");
            resellerField.setAttribute("required","required");
        }else{
            resellerField.classList.remove("show");
            resellerField.removeAttribute("required");
        }
    });
});

document.getElementById("downloadForm").addEventListener("submit", function() {
    // Delay to allow file download to trigger first
    setTimeout(() => {
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("phone").value = "";
        document.getElementById("reseller").value = "";
        document.getElementById("check-partner").checked = false;
        document.getElementById("consent").checked = false;
    }, 1000); // 1 second delay — adjust as needed
});

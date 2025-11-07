// Simple attendance toggle
document.getElementById("availabilityToggle").addEventListener("click", function () {
    let btn = this;
    
    // Send request to CONTROLLER
    fetch("../../src/Controllers/TechnicianController.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "action=toggle_availability"
    })
    .then(response => response.text())
    .then(data => {
        if (data === "1") {
            // Available
            btn.innerHTML = '<i class="fas fa-circle-check"></i> <span>Available</span>';
            btn.classList.remove("unavailable");
            btn.classList.add("available");
        } else if (data === "0") {
            // Unavailable
            btn.innerHTML = '<i class="fas fa-circle-xmark"></i> <span>Unavailable</span>';
            btn.classList.remove("available");
            btn.classList.add("unavailable");
        } else {
            alert("Error updating status");
        }
    })
    .catch(error => {
        alert("Error: " + error);
    });
});
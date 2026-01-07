
function validateForm() {

    var patient = document.getElementById("patient").value;
    var speciality = document.getElementById("speciality").value;
    var doctor = document.getElementById("doctor").value;
    var day = document.getElementById("day").value;
    var timeSlot = document.getElementById("timeSlot").value;

    // Check patient
    if (patient === "") {
        alert("Please select a patient.");
        return false;
    }

    // Check speciality
    if (speciality === "") {
        alert("Please select a speciality.");
        return false;
    }

    // Check doctor
    if (doctor === "") {
        alert("Please select a doctor.");
        return false;
    }

    // Check day
    if (day === "") {
        alert("Please select a day.");
        return false;
    }

    // Check time slot
    if (timeSlot === "") {
        alert("Please select a time slot.");
        return false;
    }

    // If everything is filled correctly
    return true;
}

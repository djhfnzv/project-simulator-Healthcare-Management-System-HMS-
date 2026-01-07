function validateBooking() {

    var speciality = document.getElementById("speciality").value;
    var doctor = document.getElementById("doctor").value;
    var day = document.getElementById("day").value;
    var time = document.getElementById("timeSlot").value;

    if (speciality === "") {
        alert("Please select a speciality.");
        return false;
    }

    if (doctor === "") {
        alert("Please select a doctor.");
        return false;
    }

    if (day === "") {
        alert("Please select a day.");
        return false;
    }

    if (time === "") {
        alert("Please select a time slot.");
        return false;
    }

    return true;
}

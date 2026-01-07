
function confirmCancel() {
    return confirm("Are you sure you want to cancel this appointment?");
}

function validateReschedule(form) {

    var day = form.day.value;
    var time = form.timeSlot.value;

    // Check day
    if (day === "") {
        alert("Please select a day.");
        return false;
    }

    // Check time
    if (time === "") {
        alert("Please select a time slot.");
        return false;
    }

    // Confirm reschedule
    return confirm("Are you sure you want to reschedule this appointment?");
}

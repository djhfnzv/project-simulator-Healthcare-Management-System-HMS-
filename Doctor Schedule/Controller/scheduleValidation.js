document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("scheduleForm");
    const dayInput = document.getElementById("day");
    const timeSlotInput = document.getElementById("timeSlot");
    const feeInput = document.getElementById("appointmentFee");
    const errorMsg = document.getElementById("errorMsg");

    form.addEventListener("submit", function (e) {

        errorMsg.textContent = "";

        const day = dayInput.value;
        const timeSlot = timeSlotInput.value;
        const fee = feeInput.value.trim();

        if (day === "") {
            e.preventDefault();
            errorMsg.textContent = "Please select a day.";
            return;
        }

        if (timeSlot === "") {
            e.preventDefault();
            errorMsg.textContent = "Please select a time slot.";
            return;
        }

        if (fee === "") {
            e.preventDefault();
            errorMsg.textContent = "Fee cannot be empty.";
            return;
        }

        for (let ch of fee) {
            if (ch < '0' || ch > '9') {
                e.preventDefault();
                errorMsg.textContent = "Fee must contain only numbers.";
                return;
            }
        }

        if (parseInt(fee) <= 0) {
            e.preventDefault();
            errorMsg.textContent = "Fee must be greater than 0.";
            return;
        }
    });
});

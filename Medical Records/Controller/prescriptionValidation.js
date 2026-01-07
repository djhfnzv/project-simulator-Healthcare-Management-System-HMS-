document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("prescriptionForm");

    const patientName = document.getElementById("patient_name");
    const age = document.getElementById("patient_age");
    const diagnosis = document.getElementById("diagnosis");
    const treatment = document.getElementById("treatment");
    const medication = document.getElementById("medication");

    const errorMsg = document.getElementById("errorMsg");

    form.addEventListener("submit", function (e) {

        errorMsg.textContent = "";

        const nameValue = patientName.value.trim();
        const ageValue = age.value.trim();
        const diagnosisValue = diagnosis.value.trim();
        const treatmentValue = treatment.value.trim();
        const medicationValue = medication.value.trim();

        if (
            nameValue === "" ||
            ageValue === "" ||
            diagnosisValue === "" ||
            treatmentValue === "" ||
            medicationValue === ""
        ) {
            e.preventDefault();
            errorMsg.textContent = "All fields must be filled.";
            return;
        }

        for (let ch of nameValue) {
            const isLetter = (ch >= 'A' && ch <= 'Z') || (ch >= 'a' && ch <= 'z');
            const isSpace = ch === ' ';

            if (!isLetter && !isSpace) {
                e.preventDefault();
                errorMsg.textContent = "Patient name must contain only letters.";
                return;
            }
        }

        for (let ch of ageValue) {
            if (ch < '0' || ch > '9') {
                e.preventDefault();
                errorMsg.textContent = "Age must be a number.";
                return;
            }
        }

        if (parseInt(ageValue) <= 0) {
            e.preventDefault();
            errorMsg.textContent = "Age must be greater than 0.";
            return;
        }

    });

});

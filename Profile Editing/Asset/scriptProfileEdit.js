document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#editForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(form);
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../Controller/checkValid.php', true);
        xhttp.send(formData);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                    document.getElementById('successMessage').innerHTML = response.message;
                    setTimeout(() => {
                        window.location.href = '../../Profile/View/profile.php';
                    }, 1000);
                } else {
                    document.querySelectorAll('.error').forEach(el => el.innerHTML = '');
                    if (response.errors.name) document.getElementById('nameError').innerHTML = response.errors.name;
                    if (response.errors.age) document.getElementById('ageError').innerHTML = response.errors.age;
                    if (response.errors.mobile) document.getElementById('mobileError').innerHTML = response.errors.mobile;
                    if (response.errors.speciality) document.getElementById('specialityError').innerHTML = response.errors.speciality;
                    if (response.errors.password) document.getElementById('passwordError').innerHTML = response.errors.password;
                    if (response.errors.image) document.getElementById('imageError').innerHTML = response.errors.image;
                }
            }
        };
    });
});
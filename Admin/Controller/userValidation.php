<?php

function validateDoctor($data, $isEdit = false)
{
    $errors = [];

    /* Name */
    if (empty(trim($data['name'] ?? ''))) {
        $errors['name'] = "Name is required";
    }

    /* DOB */
    if (empty($data['dob'] ?? '')) {
        $errors['dob'] = "Date of birth is required";
    }

    /* Age */
    if (empty($data['age'] ?? '')) {
        $errors['age'] = "Age is required";
    } elseif (!is_numeric($data['age']) || $data['age'] <= 0) {
        $errors['age'] = "Age must be a valid number";
    }

    /* Email */
    if (empty(trim($data['email'] ?? ''))) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    /* Mobile */
    if (empty(trim($data['mobile'] ?? ''))) {
        $errors['mobile'] = "Mobile number is required";
    } elseif (!is_numeric($data['mobile']) || strlen($data['mobile']) != 11) {
        $errors['mobile'] = "Mobile number must be 11 digits";
    }

    /* Speciality */
    if (empty(trim($data['speciality'] ?? ''))) {
        $errors['speciality'] = "Speciality is required";
    }

    return $errors;
}

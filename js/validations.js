let inputFields = document.querySelectorAll(
  `input[type="text"], input[type="password"], input[type="email"]`
);
let submitButton = document.getElementById(`register-btn`);

let uploadImgInput = document.getElementById(`file-upload`);
function checkEmptyFields() {
  for (let i = 0; i < inputFields.length; i++) {
    if (inputFields[i].value === `` && inputFields[i].id !== `birth`) {
      return `Please fill in all fields`;
    }
  }
}

// function that makes the sure the user has uploaded an image
function checkImageUpload() {
  if (uploadImgInput.value === ``) {
    return `Please upload an image`;
  }
}

// Validate the Full Name Field, Allowed: letters and spaces only
function validateFullName() {
  let fullName = document.getElementById(`full_name`);
  let fullNameRegex = /^[a-zA-Z\s]+$/;
  if (!fullNameRegex.test(fullName.value)) {
    fullName.classList.add("invalid");
    fullName.setAttribute(
      "title",
      "Please enter a valid full name (letters and spaces only)"
    );
    return `Please enter a valid full name`;
  } else {
    fullName.classList.remove("invalid");
    fullName.removeAttribute("title");
  }
}
// Validate the Email Field, Allowed: email format only which uses letters, numbers, @, and .
function validateEmail() {
  let email = document.getElementById(`mail`);
  let emailRegex = /^\S+@\S+\.\S+$/;
  if (!emailRegex.test(email.value)) {
    email.classList.add("invalid");
    email.setAttribute("title", "Please enter a valid email address");
    return `Please enter a valid email address`;
  } else {
    email.classList.remove("invalid");
    email.removeAttribute("title");
  }
}

// Validate the Password Field, Allowed: minimum 8 Characters, At least one digit, atleast one special character
function validatePassword() {
  let password = document.getElementById(`password`);
  let passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z]).{8,}$/;
  if (!passwordRegex.test(password.value)) {
    password.classList.add("invalid");
    password.setAttribute(
      "title",
      "Please enter a valid password (minimum 8 characters, at least one digit, at least one special character"
    );
    return `Please enter a valid password`;
  } else {
    password.classList.remove("invalid");
    password.removeAttribute("title");
  }
}

// Validate the Confirm Password Field, Allowed: Must match the password field
function validateConfirmPassword() {
  let password = document.getElementById(`password`);
  let confirmPassword = document.getElementById(`confirm_password`);
  if (password.value !== confirmPassword.value) {
    confirmPassword.classList.add("invalid");
    confirmPassword.setAttribute("title", "Passwords do not match");
    return `Passwords do not match`;
  } else {
    confirmPassword.classList.remove("invalid");
    confirmPassword.removeAttribute("title");
  }
}

// Validate the Phone Number Field, Allowed: 11 digits only
function validatePhoneNumber() {
  let phoneNumber = document.getElementById(`phone`);
  let phoneNumberRegex = /^\d{11}$/;
  if (!phoneNumberRegex.test(phoneNumber.value)) {
    phoneNumber.classList.add("invalid");
    phoneNumber.setAttribute(
      "title",
      "Please enter a valid phone number (11 digits only)"
    );
    return `Please enter a valid phone number`;
  } else {
    phoneNumber.classList.remove("invalid");
    phoneNumber.removeAttribute("title");
  }
}

// Validate the Username Field, Allowed: letters and digits only
function validateUsername() {
  let username = document.getElementById(`username`);
  let usernameRegex = /^[a-zA-Z0-9]+$/;
  if (!usernameRegex.test(username.value)) {
    username.classList.add("invalid");
    username.setAttribute(
      "title",
      "Please enter a valid username (letters and digits only)"
    );
    return `Please enter a valid username`;
  } else {
    username.classList.remove("invalid");
    username.removeAttribute("title");
  }
}

// Validate the Address Field, Allowed: letters, digits, spaces, commas, apostrophes, and hyphens only
function validateAddress() {
  let address = document.getElementById(`address`);
  let addressRegex = /^[a-zA-Z0-9\s,'-]*$/;
  if (!addressRegex.test(address.value)) {
    address.classList.add("invalid");
    address.setAttribute(
      "title",
      "Please enter a valid address (letters, digits, spaces, commas, apostrophes, and hyphens only)"
    );
    return `Please enter a valid address`;
  } else {
    address.classList.remove("invalid");
    address.removeAttribute("title");
  }
}

// Grouping all the validations together and calling them when the register button is clicked
// If there are any errors, the user will be alerted with the respective error message
submitButton.addEventListener(`click`, (e) => {
  e.preventDefault();
  let error = checkEmptyFields();
  if (error) {
    alert(error);
  } else {
    let fullNameError = validateFullName();
    let emailError = validateEmail();
    let passwordError = validatePassword();
    let confirmPasswordError = validateConfirmPassword();
    let phoneNumberError = validatePhoneNumber();
    let usernameError = validateUsername();
    let addressError = validateAddress();
    let imageError = checkImageUpload();
    if (
      fullNameError ||
      emailError ||
      passwordError ||
      confirmPasswordError ||
      phoneNumberError ||
      usernameError ||
      addressError ||
      imageError
    ) {
      alert(
        fullNameError ||
          emailError ||
          passwordError ||
          confirmPasswordError ||
          phoneNumberError ||
          usernameError ||
          addressError ||
          imageError
      );
    } else {
      alert(`Registration successful`);
    }
  }
});

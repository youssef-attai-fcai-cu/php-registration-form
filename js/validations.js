// Query Selectors for the input fields
// <input type="text" name="full_name" placeholder="Full name">
// <input type="text" name="username" placeholder="Username">
// <input type="email" name="email" placeholder="Email">
// <input type="password" name="password" placeholder="Password">
// <input type="password" name="confirm_password" placeholder="Confirm password">
// <input type="text" name="birthdate" placeholder="Birthdate" onfocus="(this.type='date')" onblur="(this.type='text')">
// <input type="tel" name="phone" placeholder="Phone">
// <input type="text" name="address" placeholder="Address">
const fullNameInput = document.querySelector(`input[name="full_name"]`);
const usernameInput = document.querySelector(`input[name="username"]`);
const emailInput = document.querySelector(`input[name="email"]`);
const passwordInput = document.querySelector(`input[name="password"]`);
const confirmPasswordInput = document.querySelector(
  `input[name="confirm_password"]`
);
const birthdateInput = document.querySelector(`input[name="birthdate"]`);
const phoneInput = document.querySelector(`input[name="phone"]`);
const addressInput = document.querySelector(`input[name="address"]`);

const allInputs = [
  fullNameInput,
  usernameInput,
  emailInput,
  passwordInput,
  confirmPasswordInput,
  birthdateInput,
  phoneInput,
  addressInput,
];

const submitButton = document.querySelector(`button[type="submit"]`);
const imageDiv = document.querySelector(".image");
const uploadImgInput = document.querySelector('input[type="file"]');

function checkEmptyFields() {
  let missing = 0;

  // foreach loop to check if the input fields are empty
  allInputs.forEach((input) => {
    if (input.value === ``) {
      input.classList.add("invalid");
      input.setAttribute("title", "This field is required");
      missing++;
    } else {
      input.classList.remove("invalid");
      input.removeAttribute("title");
    }
  });

  if (uploadImgInput.value === ``) {
    imageDiv.classList.add("invalid");
    imageDiv.setAttribute("title", "You have to upload an image");
    missing++;
  } else {
    imageDiv.classList.remove("invalid");
    imageDiv.removeAttribute("title");
  }

  return missing == 0;
}

// Validate the Full Name Field, Allowed: constters and spaces only
function validateFullName() {
  const fullNameRegex = /^[a-zA-Z\s]+$/;
  if (!fullNameRegex.test(fullNameInput.value)) {
    fullNameInput.classList.add("invalid");
    fullNameInput.setAttribute(
      "title",
      "Please enter a valid full name (constters and spaces only)"
    );
    return false;
  } else {
    fullNameInput.classList.remove("invalid");
    fullNameInput.removeAttribute("title");
    return true;
  }
}
// Validate the Email Field, Allowed: email format only which uses constters, numbers, @, and .
function validateEmail() {
  const emailRegex = /^\S+@\S+\.\S+$/;
  if (!emailRegex.test(emailInput.value)) {
    emailInput.classList.add("invalid");
    emailInput.setAttribute("title", "Please enter a valid email address");
    return false;
  } else {
    emailInput.classList.remove("invalid");
    emailInput.removeAttribute("title");
    return true;
  }
}

// Validate the Password Field, Allowed: minimum 8 Characters, At least one digit, atleast one special character
function validatePassword() {
  const pwd = passwordInput.value;

  let hasDigit = false;
  const specialChars = `!@#$%^&*()_+~\`|}{[]\:;?><,./-="`;
  let hasSpecialChar = false;
  let isVaild = true;

  if (pwd.length < 8) {
    isVaild = false;
  }

  for (let i = 0; i < pwd.length; i++) {
    if (!isNaN(pwd[i])) {
      hasDigit = true;
    } else if (specialChars.includes(pwd[i])) {
      hasSpecialChar = true;
    }
  }

  if (!hasDigit || !hasSpecialChar) {
    isVaild = false;
  }

  if (!isVaild) {
    passwordInput.classList.add("invalid");
    passwordInput.setAttribute(
      "title",
      "Please enter a valid password (minimum 8 characters, at least one digit, at least one special character"
    );
    return false;
  } else {
    passwordInput.classList.remove("invalid");
    passwordInput.removeAttribute("title");
    return true;
  }
}

// Validate the Confirm Password Field, Allowed: Must match the password field
function validateConfirmPassword() {
  if (passwordInput.value !== confirmPasswordInput.value) {
    confirmPasswordInput.classList.add("invalid");
    confirmPasswordInput.setAttribute("title", "Passwords do not match");
    return false;
  } else {
    confirmPasswordInput.classList.remove("invalid");
    confirmPasswordInput.removeAttribute("title");
    return true;
  }
}

// Validate the Phone Number Field, Allowed: 11 digits only
function validatePhoneNumber() {
  const phoneNumberRegex = /^\d{11}$/;
  if (!phoneNumberRegex.test(phoneInput.value)) {
    phoneInput.classList.add("invalid");
    phoneInput.setAttribute(
      "title",
      "Please enter a valid phone number (11 digits only)"
    );
    return `Please enter a valid phone number`;
  } else {
    phoneInput.classList.remove("invalid");
    phoneInput.removeAttribute("title");
  }
}

// Validate the Username Field, Allowed: constters and digits only
function validateUsername() {
  const usernameRegex = /^[a-zA-Z0-9]+$/;
  if (!usernameRegex.test(usernameInput.value)) {
    usernameInput.classList.add("invalid");
    usernameInput.setAttribute(
      "title",
      "Please enter a valid username (constters and digits only)"
    );
    return false;
  } else {
    usernameInput.classList.remove("invalid");
    usernameInput.removeAttribute("title");
    return true;
  }
}

// Validate the Address Field, Allowed: constters, digits, spaces, commas, apostrophes, and hyphens only
function validateAddress() {
  const addressRegex = /^[a-zA-Z0-9\s,'-]*$/;
  if (!addressRegex.test(addressInput.value)) {
    addressInput.classList.add("invalid");
    addressInput.setAttribute(
      "title",
      "Please enter a valid address (letters, digits, spaces, commas, apostrophes, and hyphens only)"
    );
    return false;
  } else {
    addressInput.classList.remove("invalid");
    addressInput.removeAttribute("title");
    return true;
  }
}

// Grouping all the validations together and calling them when the register button is clicked
// If there are any errors, the user will be alerted with the respective error message
submitButton.addEventListener(`click`, (e) => {
  // if there are any no empty fields
  if (checkEmptyFields()) {
    // check validity of each field
    validateFullName();
    validateEmail();
    validatePassword();
    validateConfirmPassword();
    validatePhoneNumber();
    validateUsername();
    validateAddress();
  }
});

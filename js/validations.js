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

// function checkEmptyFields() {
//   let missing = 0;

//   // foreach loop to check if the input fields are empty
//   allInputs.forEach((input) => {
//     if (input.value === ``) {
//       input.classList.add("invalid");
//       input.setAttribute("title", "This field is required");
//       missing++;
//     } else {
//       input.classList.remove("invalid");
//       input.removeAttribute("title");
//     }
//   });

//   if (uploadImgInput.value === ``) {
//     imageDiv.classList.add("invalid");
//     imageDiv.setAttribute("title", "You have to upload an image");
//     missing++;
//   } else {
//     imageDiv.classList.remove("invalid");
//     imageDiv.removeAttribute("title");
//   }

//   return missing == 0;
// }

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
      switch (input.name) {
        case "full_name":
          if (!validateFullName()) {
            input.classList.add("invalid");
            input.setAttribute(
              "title",
              "Please enter a valid full name (letters and spaces only)"
            );
            missing++;
          }
          break;
        case "username":
          if (!validateUsername()) {
            input.classList.add("invalid");
            input.setAttribute(
              "title",
              "Please enter a valid username (letters and digits only)"
            );
            missing++;
          }
          break;
        case "email":
          if (!validateEmail()) {
            input.classList.add("invalid");
            input.setAttribute("title", "Please enter a valid email address");
            missing++;
          }
          break;
        case "password":
          if (!validatePassword()) {
            input.classList.add("invalid");
            input.setAttribute(
              "title",
              "Please enter a valid password (minimum 8 characters, at least one digit, at least one special character"
            );
            missing++;
          }
          break;
        case "confirm_password":
          if (!validateConfirmPassword()) {
            input.classList.add("invalid");
            input.setAttribute("title", "Passwords do not match");
            missing++;
          }
          break;
        case "birthdate":
          // do nothing for birthdate, as we don't need to validate it
          break;
        case "phone":
          if (!validatePhoneNumber()) {
            input.classList.add("invalid");
            input.setAttribute(
              "title",
              "Please enter a valid phone number (11 digits only)"
            );
            missing++;
          }
          break;
        case "address":
          if (!validateAddress()) {
            input.classList.add("invalid");
            input.setAttribute(
              "title",
              "Please enter a valid address (letters, digits, spaces, commas, apostrophes, and hyphens only)"
            );
            missing++;
          }
          break;
        default:
          break;
      }
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

// Validate the Full Name Field, Allowed: letters and spaces only
function validateFullName() {
  const fullNameRegex = /^[a-zA-Z\s]+$/;
  if (!fullNameRegex.test(fullNameInput.value)) {
    fullNameInput.classList.add("invalid");
    fullNameInput.setAttribute(
      "title",
      "Please enter a valid full name (letters and spaces only)"
    );
    return false;
  } else {
    fullNameInput.classList.remove("invalid");
    fullNameInput.removeAttribute("title");
    return true;
  }
}
// Validate the Email Field, Allowed: email format only which uses letters, numbers, @, and .
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

// Validate the Password Field, Allowed: minimum 8 characters, at least one digit, at least one special character
function validatePassword() {
  const passwordRegex = /^(?=.*\d)(?=.*[\W_]).{8,}$/;
  const pwd = passwordInput.value;
  if (!passwordRegex.test(pwd)) {
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
    return false;
  } else {
    phoneInput.classList.remove("invalid");
    phoneInput.removeAttribute("title");
    return true;
  }
}

// Validate the Username Field, Allowed: letters and digits only
function validateUsername() {
  const usernameRegex = /^[a-zA-Z0-9]+$/;
  if (!usernameRegex.test(usernameInput.value)) {
    usernameInput.classList.add("invalid");
    usernameInput.setAttribute(
      "title",
      "Please enter a valid username (letters and digits only)"
    );
    return false;
  } else {
    usernameInput.classList.remove("invalid");
    usernameInput.removeAttribute("title");
    return true;
  }
}

// Validate the Address Field, Allowed: letters, digits, spaces, commas, apostrophes, and hyphens only
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
  checkEmptyFields();
});

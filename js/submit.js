// Get the submit button
const submitBtn = document.querySelector('button[type="submit"]');

/*
Get these elements from the DOM
  <input type="text" name="full_name" placeholder="Full name">
  <input type="text" name="username" placeholder="Username">
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <input type="password" name="confirm_password" placeholder="Confirm password">
  <input type="text" name="birthdate" placeholder="Birthdate" onfocus="(this.type='date')" onblur="(this.type='text')">
  <input type="tel" name="phone" placeholder="Phone">
  <input type="text" name="address" placeholder="Address">
*/

const fullName = document.querySelector('input[name="full_name"]');
const username = document.querySelector('input[name="username"]');
const email = document.querySelector('input[name="email"]');
const password = document.querySelector('input[name="password"]');
const birthdate = document.querySelector('input[name="birthdate"]');
const phone = document.querySelector('input[name="phone"]');
const address = document.querySelector('input[name="address"]');
const successDiv = document.querySelector(".success");
const formDiv = document.querySelector(".form");

// Get the file input
const fileInput = document.querySelector('input[type="file"]');

// Add event listener to the submit button
function submitForm(e) {
  // Send a POST request to index.php using AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      if (xhr.responseText === "success") {
        successDiv.classList.remove("hidden");
        formDiv.classList.add("hidden");
      } else {
        successDiv.classList.add("hidden");
        formDiv.classList.remove("hidden");
        console.log(xhr.responseText);
      }
    }
  };

  // Create a new FormData object
  const formData = new FormData();

  // Append the form data to the FormData object
  formData.append("full_name", fullName.value);
  formData.append("username", username.value);
  formData.append("email", email.value);
  formData.append("password", password.value);
  formData.append("birthdate", birthdate.value);
  formData.append("phone", phone.value);
  formData.append("address", address.value);
  formData.append("user_image", fileInput.files[0]);

  // Send the request
  xhr.send(formData);
}

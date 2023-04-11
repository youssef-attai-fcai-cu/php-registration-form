document.documentElement.setAttribute("theme", "dark");

const toggle = document.querySelector("#toggle");
const sunIcon = document.querySelector(".toggle .bxs-sun");
const moonIcon = document.querySelector(".toggle .bx-moon");

toggle.addEventListener("change", (e) => {
  if (e.target.checked) {
    document.documentElement.setAttribute("theme", "dark");
  } else {
    /* While page in dark mode and checkbox is 
    checked then theme back to change light*/
    document.documentElement.setAttribute("theme", "light");
  }
});

/* Function to change theme */

/* Once checkbox is checked default theme change to dark */

//document.documentElement.setAttribute("theme", "dark");

//toggleSwitch.addEventListener('change', switchTheme, false);

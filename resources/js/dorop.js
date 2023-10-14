
const dropdownBtn = document.getElementById("navbarDropdown");

dropdownBtn.addEventListener("click", function () {
  var dropdownMenu = document.getElementById("dropdownMenu");
  if (dropdownMenu.style.display === "none") {
      dropdownMenu.style.display = "block";
  } else {
      dropdownMenu.style.display = "none";
  }
});
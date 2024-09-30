'use strict';



const overlay = document.querySelector("[data-overlay]");
const navbar = document.querySelector("[data-navbar]");
const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

const navToggleFunc = function () {
  navToggleBtn.classList.toggle("active");
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
}

navToggleBtn.addEventListener("click", navToggleFunc);
overlay.addEventListener("click", navToggleFunc);

for (let i = 0; i < navbarLinks.length; i++) {
  navbarLinks[i].addEventListener("click", navToggleFunc);
}



/**
 * header active on scroll
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  window.scrollY >= 10 ? header.classList.add("active")
    : header.classList.remove("active");
});
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.user-btn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// Toggle the dropdown menu when clicking on the button
document.getElementById("profileButton").addEventListener("click", function() {
  document.getElementById("dropdownContent").classList.toggle("show");
});
function bookmarkLocation() {
  // Get the iframe element
  var iframe = document.getElementById('mapFrame');

  // Get the Google Maps URL from the iframe
  var mapsUrl = new URL(iframe.src);

  // Extract the search query from the URL
  var searchQuery = mapsUrl.searchParams.get('q');

  // Update the location textbox with the search query
  document.getElementById('locationTextbox').value = searchQuery;
}

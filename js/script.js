// This is JavaScipt file for toggle sidebar

document.addEventListener("DOMContentLoaded", function (event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);

    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        // Toggle navbar
        nav.classList.toggle("show");

        // Toggle icon
        toggle.classList.toggle("bx-x");

        // Toggle padding for body
        bodypd.classList.toggle("body-pd");

        // Toggle padding for header
        headerpd.classList.toggle("body-pd");

        // Toggle visibility of links
        const links = document.querySelectorAll(".nav_link");
        links.forEach((link) => link.classList.toggle("show"));
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }

  linkColor.forEach((l) => l.addEventListener("click", colorLink));
});

function search_bar() {
  let input = document.getElementById("search").value;
  input = input.toLowerCase();
  let x = document.getElementsByClassName("filter");

  for (i = 0; i < x.length; i++) {
    if (!x[i].innerHTML.toLowerCase().includes(input)) {
      x[i].style.display = "none";
    } else {
      x[i].style.display = "table-row";
    }
  }
}

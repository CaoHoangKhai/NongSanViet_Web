document.addEventListener('DOMContentLoaded', function () {
  var navbarToggle = document.getElementById('navbarToggle');
  var navbarCollapse = document.getElementById('navbarTogglerDemo01');

  if (navbarToggle && navbarCollapse) {
      navbarToggle.addEventListener('click', function () {
          navbarCollapse.classList.toggle('show');
      });
  }
});

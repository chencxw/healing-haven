/**
 * File services-nav.js.
 *
 */

(function() {
  // subnav title element
  let subnavTitle = document.querySelector('.subnav-title');

  // category list element
  let categoryList = document.querySelector('.category-nav ul');

  let arrow = document.querySelector('.category-nav svg');

  let wholeNav = document.querySelector('.category-nav');

  // Toggle the .active class and the aria-expanded value each time the button is clicked
  subnavTitle.addEventListener('click', function() {

    categoryList.classList.toggle('active');
    arrow.classList.toggle('active');

    if (subnavTitle.getAttribute('aria-expanded') === 'true') {
      subnavTitle.setAttribute('aria-expanded', 'false');
    } else {
      subnavTitle.setAttribute('aria-expanded', 'true');
    }

  });

  // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
  document.addEventListener('click', function(event) {
    const isClickInside = wholeNav.contains(event.target);

    if (!isClickInside) {
      categoryList.classList.remove('active');
      arrow.classList.remove('active');
      subnavTitle.setAttribute('aria-expanded', 'false');

    }
  });

  let menuItems = document.querySelectorAll('.services-menu-link');

  // Add click event listener to each menu item
  menuItems.forEach(function(menuItem) {

    menuItem.addEventListener('click', function() {

      categoryList.classList.remove('active');
      arrow.classList.remove('active');
      subnavTitle.setAttribute('aria-expanded', 'false');

    });
  });

  // Media query to remove toggle class on larger screens
  const mediaQueryList = window.matchMedia('(min-width: 950px)');
  
  mediaQueryList.addEventListener('change', removeActive);

  function removeActive(e) {
    if (e.matches) {
      categoryList.classList.remove('active');
      arrow.classList.remove('active');
    }
  }
})();



  
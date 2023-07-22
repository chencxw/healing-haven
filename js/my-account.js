// Select all elements with the classname 'example-class'
let elementsToDelete = document.querySelectorAll('.woocommerce-MyAccount-navigation');

// Loop through the selected elements and remove them from the DOM
for (let i = 0; i < elementsToDelete.length; i++) {
    elementsToDelete[i].remove();
}

let accordionItems = document.getElementsByClassName('accordion-item');

for (let i = 0; i < accordionItems.length; i++) {
  accordionItems[i].addEventListener('click', function() {
    
    let title = this.querySelector('.accordion-title');
    let content = this.querySelector('.accordion-content');

    content.style.display = (content.style.display === 'block') ? 'none' : 'block';

    let icon = this.querySelector('.accordion-icon');
    icon.classList.toggle('rotate');
  });
}
## Hightlight menu item on scroll

``` javascript

// Get all sections that have an ID defined
const sections = document.querySelectorAll("section[id]");

// Add an event listener listening for scroll
window.addEventListener("scroll", navHighlighter);

function navHighlighter() {
  
  // Get current scroll position
  let scrollY = window.pageYOffset;
  
  // Now we loop through sections to get height, top and ID values for each
  sections.forEach(current => {
    const sectionHeight = current.offsetHeight;
    const sectionTop = current.offsetTop - 100;
    let sectionId = current.getAttribute("id");
    
  
    if (scrollY > sectionTop &&   scrollY <= sectionTop + sectionHeight){
      document.querySelector(".sticky-nav a[href*=" + sectionId + "]").classList.add("active");
    } else {
      document.querySelector(".sticky-nav a[href*=" + sectionId + "]").classList.remove("active");
    }
  });
}
navHighlighter();

```
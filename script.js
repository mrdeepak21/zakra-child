jQuery(document).ready(()=>{
// Intersection Observer
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateWords(entry.target);
            observer.unobserve(entry.target);
        }
    });
});


 // Observe all elements with the "word-slide-container" class
 document.querySelectorAll('.word-slide-container .elementor-heading-title,.word-slide-container .elementor-cta__title,.word-slide-container .elementor-icon-box-title,.word-slide-container .elementor-image-box-title').forEach(container => {
    observer.observe(container);
  });

// Animation function
function animateWords(element) {
    const words = element.querySelectorAll('.word-slide');
    words.forEach((word, index,arr) => {
        setTimeout(() => {
        word.classList.add('visible');            
        setTimeout(()=>{
            word.classList.contains('mark')?(word.classList.add('highlight')):null; 
        },(arr.length-1)*500+100);
        }, index * 500); // Adjust the delay as needed
    });
}
});
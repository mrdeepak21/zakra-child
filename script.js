jQuery(document).ready(function ($){
	// Initialize Intersection Observer
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
			 entry.target.childNodes.forEach((childNode, i,a) =>
             animateWords(childNode, i,a));
          // Unobserve the element to avoid re-triggering the animation
          observer.unobserve(entry.target);
        }
      });
    });

    // Observe all elements with the "word-slide-container" class
    document.querySelectorAll('.word-slide-container .elementor-heading-title,.word-slide-container .elementor-cta__title,.word-slide-container .elementor-icon-box-title,.word-slide-container .elementor-image-box-title').forEach(container => {
      observer.observe(container);
    });

        function animateWords(node, i, a) {
        if (node.nodeType === 3) {
          const words = node.nodeValue.split(/\s+/g);
          const fragment = document.createDocumentFragment();

          words.forEach((word, index) => {
            if(word.length!==0) {
            const span = document.createElement('span');
            span.appendChild(document.createTextNode(`${word}`));
            span.classList.add('word-slide');
            span.style.animationDelay = `${(i+index) * 0.15}s`;
            if (index < words.length - 1 || i < a.length - 1) {
              span.appendChild(document.createTextNode(' '));
            }
            fragment.appendChild(span);
          }
          });
          node.parentNode.replaceChild(fragment, node);
        } else {
          node.setAttribute(
            'style',
            `-webkit-animation: wordSlideUp 1s ease-in-out ${i*0.15}s forwards, highlight 1s normal ${(a.length+1)/2}s forwards;animation: wordSlideUp 1s ease-in-out ${i*0.15}s forwards, highlight 1s normal ${(a.length+1)/2}s forwards;margin-right:${i!==a.length-1?5:0}px`
          );
        }
      }
});
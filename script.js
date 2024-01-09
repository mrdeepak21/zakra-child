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




// ----------------------------------------------------------------------------------------------------------------
/**
 * charCode [48,57]     Numbers 0 to 9
 * keyCode 46           "delete"
 * keyCode 9            "tab"
 * keyCode 13           "enter"
 * keyCode 116          "F5"
 * keyCode 8            "backscape"
 * keyCode 37,38,39,40  Arrows
 * keyCode 10           (LF)
 */
function validate_int(myEvento) {
    if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
      dato = true;
    } else {
      dato = false;
    }
    return dato;
  }
  
  function phone_number_mask() {
    var myMask = "___-___-____";
    var myCaja = document.getElementById("form-field-phone");
    var myText = "";
    var myNumbers = [];
    var myOutPut = ""
    var theLastPos = 1;
    myText = myCaja.value;
    //get numbers
    for (var i = 0; i < myText.length; i++) {
      if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
        myNumbers.push(myText.charAt(i));
      }
    }
    //write over mask
    for (var j = 0; j < myMask.length; j++) {
      if (myMask.charAt(j) == "_") { //replace "_" by a number 
        if (myNumbers.length == 0)
          myOutPut = myOutPut + myMask.charAt(j);
        else {
          myOutPut = myOutPut + myNumbers.shift();
          theLastPos = j + 1; //set caret position
        }
      } else {
        myOutPut = myOutPut + myMask.charAt(j);
      }
    }
    document.getElementById("form-field-phone").value = myOutPut;
    document.getElementById("form-field-phone").setSelectionRange(theLastPos, theLastPos);
  }
  
  document.getElementById("form-field-phone").onkeydown = validate_int;
  document.getElementById("form-field-phone").onkeyup = phone_number_mask;
  document.getElementById("form-field-phone").setAttribute('title','Phone format: ###-###-####');
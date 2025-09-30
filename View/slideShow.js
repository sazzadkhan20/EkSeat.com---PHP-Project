let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");

  // Hide all slides
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }

  // Move to next slide
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    

  // Remove active class from all dots
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  // Show current slide and highlight dot
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";

  // Change slide every 3 seconds
  setTimeout(showSlides, 3000);
}

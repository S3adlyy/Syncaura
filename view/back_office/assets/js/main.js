// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Animated Progress Bar
let circularProgress = document.querySelector(".circular-progress"),
progressValue = document.querySelector(".progress-value");

let progressStartValue = 0,    
progressEndValue = 78,    
speed = 15;

let progress = setInterval(() => {
progressStartValue++;

progressValue.textContent = `${progressStartValue}%`
circularProgress.style.background = `conic-gradient(var(--blue) ${progressStartValue * 3.6}deg, #ededed 0deg)`

if(progressStartValue == progressEndValue){
    clearInterval(progress);
}    
}, speed);
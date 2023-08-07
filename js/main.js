const signUp = document.getElementById("signUp");
const signIn = document.getElementById("signIn");
const signInBox = document.getElementById("signInBox");
const signUpBox = document.getElementById("signUpBox");

signUp.addEventListener("click", () => {
  signInBox.classList.remove("slideIn");
  signInBox.classList.add("slideOut");
  
  setTimeout(() => {
    signUpBox.classList.remove("slideOut");
    signUpBox.classList.add("slideIn");
  }, 300);
});

signIn.addEventListener("click", () => {
  setTimeout(() => {
    signInBox.classList.remove("slideOut");
    signInBox.classList.add("slideIn");
  }, 300);
  signUpBox.classList.remove("slideIn");
  signUpBox.classList.add("slideOut");
});

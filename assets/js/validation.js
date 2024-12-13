const sections = document.querySelectorAll(".form-section");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const playerType = document.getElementById("playerType");
const playerFields = document.getElementById("playerFields");
const goalkeeperFields = document.getElementById("goalkeeperFields");
let currentSection = 0;

function updateForm() {
  
    sections.forEach((section, index) => {
      if (index === currentSection) {
        section.classList.remove("hidden");
      }else {
        section.classList.add("hidden");
      }
    });
  
    if (currentSection === 2) {
      if (playerType.value === "player") {
        playerFields.classList.remove("hidden");
        goalkeeperFields.classList.add("hidden");
        currentSection++;
        document.getElementById("diving").value = '10';
        document.getElementById("handling").value = '10';
        document.getElementById("reflexes").value = '10';
        nextBtn.textContent = "Submit" 
      } else if (playerType.value === "goalkeeper") {
        goalkeeperFields.classList.remove("hidden");
        playerFields.classList.add("hidden");
        document.getElementById("playerPosition").value = 'gk';
        document.getElementById("pace").value = '10';
        document.getElementById("shooting").value ='10';
        document.getElementById("dribbling").value = '10';
        document.getElementById("defending").value = '10';
        document.getElementById("physical").value = '10';
        nextBtn.textContent = "Submit" ;
        }
    }else if (currentSection === 3){
      goalkeeperFields.classList.add("hidden");
      playerFields.classList.add("hidden");
      
    }
  
    
    if (currentSection === 0) {
      prevBtn.classList.add("hidden");
    } else {
      prevBtn.classList.remove("hidden");
    }
   
  }
  
  function validateInput() {
    const inputs = sections[currentSection].querySelectorAll("input, select");
  
    let isValid = true;
   
      inputs.forEach((input) => {
  
        if (input.value.trim() === "") {
          input.classList.add("error");
  
          if (!input.nextElementSibling || !input.nextElementSibling.classList.contains("error-message")) {
            const error = document.createElement("span");
            error.textContent = `${input.previousElementSibling.textContent} is required`;
            error.classList.add("error-message");
            input.parentNode.appendChild(error);
          }
  
          isValid = false;
        } else {
          input.classList.remove("error");
  
          if (input.nextElementSibling && input.nextElementSibling.classList.contains("error-message")) {
            input.nextElementSibling.remove();
          }
        }
  
        if (input.type === "number") {
          const value = input.value;
          if (value < 10 || value > 99) {
            input.classList.add("error");
  
            if (
              !input.nextElementSibling ||
              !input.nextElementSibling.classList.contains("error-message")
            ) {
              const error = document.createElement("span");
              error.textContent = "Please enter a valid number (10-99).";
              error.classList.add("error-message");
              input.parentNode.appendChild(error);
            }
  
            isValid = false;
          } else {
            input.classList.remove("error");
  
            if (
              input.nextElementSibling &&
              input.nextElementSibling.classList.contains("error-message")
            ) {
              input.nextElementSibling.remove();
            }
          }
        }
      });
    
    return isValid;
  }
  
  
  prevBtn.addEventListener("click", () => {
    if (currentSection > 0) {
      currentSection--;
      updateForm();
      if (playerType.value === "player" && currentSection === 3) {
        currentSection-=2;
        updateForm();
      }
    }
  });
  
  nextBtn.addEventListener("click", () => {
    if (validateInput()) {
      if (currentSection < sections.length - 2) {
        currentSection++;
        updateForm();
      } else {
        saveData();
        currentSection = 0;
        updateForm();
        document.getElementById("paginatedForm").reset();
        alert("secuse");
      }
    }
  });
  
  playerType.addEventListener("change", updateForm);
  updateForm();
  
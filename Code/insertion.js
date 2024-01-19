
const links = document.querySelectorAll('a[href^="#"]');
links.forEach(link => {
  link.addEventListener('click', smoothScroll);
});

function smoothScroll(e) {
  e.preventDefault();

  const targetId = this.getAttribute("href");
  const targetPosition = document.querySelector(targetId).offsetTop;

  window.scrollTo({
    top: targetPosition,
    behavior: "smooth"
  });
}

function validateForm() {
  const name = document.getElementById("name").value;
  const age = document.getElementById("age").value;
  const weight = document.getElementById("weight").value;
  const email = document.getElementById("email").value;
  const healthReport = document.getElementById("health-report").value;

  if (name === "") {
    openModal("Please Enter your Name");
    return false;
  }

  if (age === "") {
    openModal("Please Enter your Age");
    return false;
  }

  if (weight === "") {
    openModal("Please Enter your Weight");
    return false;
  }

  if (email === "") {
    openModal("Please Enter your Email");
    return false;
  }

  if (healthReport === "") {
    openModal("Please upload your Health Report");
    return false;
  }
  return true;
}

function openModal(message) {
  const modal = document.getElementById("warning-modal");
  const modalContent = document.getElementById("warning-message");
  modalContent.textContent = message;
  modal.style.display = "block";
}

function closeModal() {
  const modal = document.getElementById("warning-modal");
  modal.style.display = "none";
}

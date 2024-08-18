document.addEventListener("DOMContentLoaded", function () {
  const formOpenBtn = document.querySelector("#form-open"),
    home = document.querySelector(".home"),
    formContainer = document.querySelector(".form_container"),
    formCloseBtn = document.querySelector(".form_close"),
    signupBtn = document.querySelector("#signup"),
    loginBtn = document.querySelector("#login"),
    pwShowHide = document.querySelectorAll(".pw_hide"),
    passwordInputs = document.querySelectorAll('input[type="password"]'),
    signupNowBtn = document.querySelector("#signupNowBtn"),
    weakPasswordMessage = document.querySelector(".weak-password-message"),
    scroll_btn = document.querySelector(".scroll-top");

  formOpenBtn.addEventListener("click", () => home.classList.add("show"));
  formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

  pwShowHide.forEach((icon) => {
    icon.addEventListener("click", () => {
      let getPwInput = icon.parentElement.querySelector("input");
      if (getPwInput.type === "password") {
        getPwInput.type = "text";
        icon.classList.replace("uil-eye-slash", "uil-eye");
      } else {
        getPwInput.type = "password";
        icon.classList.replace("uil-eye", "uil-eye-slash");
      }
    });
  });

  signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active");
  });

  loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.remove("active");
  });

  passwordInputs.forEach((input) => {
    input.addEventListener("input", () => {
      const password = input.value;
      const strengthText =
        input.parentElement.querySelector(".password-strength");

      if (strengthText) {
        const strength = calculatePasswordStrength(password);
        let strengthIndicator = "";
        if (strength === "strong") {
          strengthIndicator = "Strong";
        } else if (strength === "medium") {
          strengthIndicator = "Medium";
        } else {
          strengthIndicator = "Weak";
        }
        strengthText.textContent = `Password Strength: ${strengthIndicator}`;
        if (
          input.parentElement.parentElement.classList.contains("signup_form")
        ) {
          if (strength === "weak") {
            weakPasswordMessage.textContent =
              "Password is weak. Please choose a stronger password.";
            signupNowBtn.disabled = true;
          } else {
            weakPasswordMessage.textContent = "";
            signupNowBtn.disabled = false;
          }
        }
      } else {
        console.error("Strength text element not found!");
      }
    });
  });

  function calculatePasswordStrength(password) {
    const strongRegex = new RegExp(
      "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
    );
    const mediumRegex = new RegExp(
      "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})"
    );
    if (strongRegex.test(password)) {
      return "strong";
    } else if (mediumRegex.test(password)) {
      return "medium";
    } else {
      return "weak";
    }
  }

  scroll_btn.addEventListener("click", () => {
    document.documentElement.scrollIntoView({
      behavior: "smooth",
    });
  });

  window.addEventListener("scroll", () => {
    if (window.scrollY > 200) {
      scroll_btn.classList.add("active");
    } else {
      scroll_btn.classList.remove("active");
    }
  });
});

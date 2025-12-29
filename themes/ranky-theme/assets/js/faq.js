document.addEventListener("DOMContentLoaded", () => {
    const faqItems = document.querySelectorAll(".faq__item");
  
    faqItems.forEach((item) => {
      const question = item.querySelector(".faq__question");
  
      question.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");
  
        faqItems.forEach((i) => i.classList.remove("is-open"));
  
        if (!isOpen) {
          item.classList.add("is-open");
        }
      });
    });
  });
  
document.addEventListener("DOMContentLoaded", () => {
  // Handle regular FAQ items
  const faqItems = document.querySelectorAll(".faq__item");

  faqItems.forEach((item) => {
    const question = item.querySelector(".faq__question");

    if (question) {
      question.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");

        faqItems.forEach((i) => i.classList.remove("is-open"));

        if (!isOpen) {
          item.classList.add("is-open");
        }
      });
    }
  });

  // Handle industry FAQ items
  const industryFaqItems = document.querySelectorAll(".industry-faq__item");

  industryFaqItems.forEach((item) => {
    const question = item.querySelector(".industry-faq__question");
    if (question) {
      question.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");

        industryFaqItems.forEach((i) => i.classList.remove("is-open"));

        if (!isOpen) {
          item.classList.add("is-open");
        }
      });
    }
  });
});

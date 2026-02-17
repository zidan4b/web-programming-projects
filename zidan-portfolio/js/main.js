document.addEventListener("DOMContentLoaded", () => {
  // ===== Active nav link =====
  const page = window.location.pathname.split("/").pop() || "index.html";
  const navLinks = document.querySelectorAll(".nav-links a");
  navLinks.forEach((link) => {
    const href = link.getAttribute("href");
    if (href === page || (page === "" && href === "index.html")) {
      link.classList.add("active");
    }
  });

  // ===== Mobile nav =====
  const navToggle = document.querySelector(".nav-toggle");
  const navMenu = document.querySelector(".nav-links");

  if (navToggle && navMenu) {
    navToggle.addEventListener("click", () => {
      navMenu.classList.toggle("open");
      const expanded = navMenu.classList.contains("open");
      navToggle.setAttribute("aria-expanded", String(expanded));
    });

    navLinks.forEach((link) => {
      link.addEventListener("click", () => navMenu.classList.remove("open"));
    });

    document.addEventListener("click", (e) => {
      if (!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
        navMenu.classList.remove("open");
      }
    });
  }

  // ===== Reveal on scroll =====
  const revealItems = document.querySelectorAll(".reveal");
  if (revealItems.length) {
    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            obs.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 }
    );

    revealItems.forEach((item) => observer.observe(item));
  }

  // ===== Typed text effect on home =====
  const typedEl = document.querySelector("[data-typed]");
  if (typedEl) {
    let words = [];
    try {
      words = JSON.parse(typedEl.getAttribute("data-words") || "[]");
    } catch (e) {
      words = [];
    }

    if (Array.isArray(words) && words.length) {
      let wordIndex = 0;
      let charIndex = 0;
      let isDeleting = false;

      const type = () => {
        const currentWord = words[wordIndex];
        typedEl.textContent = currentWord.substring(0, charIndex);

        if (!isDeleting && charIndex < currentWord.length) {
          charIndex++;
          setTimeout(type, 90);
          return;
        }

        if (isDeleting && charIndex > 0) {
          charIndex--;
          setTimeout(type, 45);
          return;
        }

        isDeleting = !isDeleting;

        if (!isDeleting) {
          wordIndex = (wordIndex + 1) % words.length;
        }

        setTimeout(type, isDeleting ? 1200 : 350);
      };

      type();
    }
  }

  // ===== Projects filter =====
  const filterBtns = document.querySelectorAll(".filter-btn");
  const projectCards = document.querySelectorAll(".project-card");

  if (filterBtns.length && projectCards.length) {
    filterBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        filterBtns.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.getAttribute("data-filter");

        projectCards.forEach((card) => {
          const tags = (card.getAttribute("data-tags") || "").toLowerCase();
          const show = filter === "all" || tags.includes(filter);
          card.classList.toggle("hidden", !show);
        });
      });
    });
  }

  // ===== Contact form (mailto) =====
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const name = document.getElementById("name")?.value.trim();
      const email = document.getElementById("email")?.value.trim();
      const subjectInput = document.getElementById("subject")?.value.trim();
      const message = document.getElementById("message")?.value.trim();

      if (!name || !email || !message) return;

      const subject = subjectInput || `Portfolio Contact from ${name}`;
      const body = `Name: ${name}%0D%0AEmail: ${email}%0D%0A%0D%0AMessage:%0D%0A${encodeURIComponent(message)}`;

      window.location.href = `mailto:zidan4bakari@gmail.com?subject=${encodeURIComponent(subject)}&body=${body}`;
      contactForm.reset();
    });
  }

  // ===== Dynamic year =====
  document.querySelectorAll(".year").forEach((el) => {
    el.textContent = new Date().getFullYear();
  });

  // ===== Back to top =====
  const backToTop = document.getElementById("backToTop");
  if (backToTop) {
    const toggleBackToTop = () => {
      if (window.scrollY > 280) {
        backToTop.classList.add("show");
      } else {
        backToTop.classList.remove("show");
      }
    };

    window.addEventListener("scroll", toggleBackToTop);
    toggleBackToTop();

    backToTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }
});

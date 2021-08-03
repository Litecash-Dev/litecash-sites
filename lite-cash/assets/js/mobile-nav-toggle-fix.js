  // Fix for bootstrap mobile navigation
  const mobileNavLiEl = document.querySelectorAll("#navbarMobile > ul > li > a")
  const mobileNavUlEl = document.querySelector("#navbarMobile > ul")
  const mobileNavUlParentEl = document.querySelector("#navbarMobile")
  mobileNavLiEl.forEach(li => {
      li.addEventListener('click', i => {
          setTimeout(() => {
              mobileNavUlEl.style.display = 'block'
              mobileNavUlParentEl.classList.remove("show")
          }, 500)
      });
  })
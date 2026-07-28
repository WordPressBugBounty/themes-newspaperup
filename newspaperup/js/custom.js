(function($) {
  "use strict";
  /* =================================
  ===     Widget Slider        ====
  =================================== */
  function initializeSwiper(selector, desktopView = 1, tabletView = 1, mobileView = 1) {
    var swiper = new Swiper(selector, {
      direction: 'horizontal',
      loop: true,
      autoplay: {
        delay: 3000,
      },
      speed: 500,
      slidesPerView: desktopView, // Default for desktop
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        240: {
          slidesPerView: mobileView,
          spaceBetween: 0,
        },
        640: {
          slidesPerView: mobileView,
          spaceBetween: 0,
        },
        768: {
          slidesPerView: tabletView,
          spaceBetween: 10,
        },
        991: {
          slidesPerView: desktopView,
          spaceBetween: 24,
        },
      }
    });
  }
  initializeSwiper('.wigethomemain');
  initializeSwiper('.homemain');
  initializeSwiper('.featured_cat_slider');
  initializeSwiper('.colmnthree',3,2,1);
  
  /* =================================
  ===         Tiker SLIDER         ====
  =================================== */
  function newspaperupTicker() {
    var swiper = new Swiper(".bs-latest-news-slider.swipe", {
      direction: "vertical",
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 3000,
      }, 
      speed:1000,
    });
  }
  newspaperupTicker();

  /* =================================
  ===         SCROLL TOP       ====
  =================================== */
  var scrollToTopBtn = document.querySelector(".bs_upscr");
  var rootElement = document.documentElement;
  
  function handleScroll() {
    
    // Do something on scroll
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if (rootElement.scrollTop / scrollTotal > 0.05) {
      // Show button
      scrollToTopBtn.classList.add("showBtn");
    } else {
      // Hide button
      scrollToTopBtn.classList.remove("showBtn");
    }
  }
  
  function scrollToTop(event) {
    // Scroll to top logic
    event.preventDefault();
    rootElement.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
  if (scrollToTopBtn) {
    scrollToTopBtn.addEventListener("click", scrollToTop);
    document.addEventListener("scroll", handleScroll);
  }

  /* =================================
  ===         STICKY HEADER       ====
  =================================== */
  document.addEventListener('DOMContentLoaded', function () {
    let stickyHeader = document.querySelector(".bs-menu-full.sticky-header");
    if(stickyHeader) {
      let scrollDownElement = stickyHeader.offsetTop;

      window.addEventListener("scroll", function () {
        if (window.scrollY > scrollDownElement) {
          stickyHeader.classList.add("header-sticky");
        } else {
          stickyHeader.classList.remove("header-sticky");
        }
      }
      );
    }
  });
  
  var elements = document.getElementsByClassName('bs-sticky');

  for (var i = 0; i < elements.length; i++) {
    new hcSticky(elements[i], {
      stickTo: elements[i].parentNode,
      top: 0,
      bottomEnd: 0,
    });
  }
 
  jQuery(document).ready(function() {
    jQuery('.sm').smartmenus({
      subMenusSubOffsetX: 1,
      subMenusSubOffsetY: -8
    });
  });
  
  /*---------------------------------------
    Off Canvas           
  -----------------------------------------*/
  let clickableAddElementRight = document.querySelectorAll('[bs-data-clickable-end]');
  let clickableRemoveElement = document.querySelector('[bs-data-removable]');
  let clickableRemoveElementTwo = document.querySelector('[bs-remove-overlay]');
  let targetElement = document.querySelector('[bs-data-targeted]'); 
  let targetBody = document.querySelector('body'); 

  // Function to handle the click event
  function handleClickRight() {
    targetElement.classList.add('from-right'); 
    clickableRemoveElementTwo.classList.add('show'); 
    targetBody.style.overflow = 'hidden';
    targetBody.style.paddingRight = '17px';
    if (clickableRemoveElement) {
      clickableRemoveElement.focus();
    }
  }
  
  function handleClickRemove(event) {
    event.preventDefault();
    targetElement.classList.remove('from-right');
    clickableRemoveElementTwo.classList.remove('show'); 
    targetBody.style.overflow = null;
    targetBody.style.paddingRight = null;
    if (clickableAddElementRight.length > 0) {
      clickableAddElementRight[0].focus();
    }
  }

  // Attach the handleClick function to the click event of the clickable element
  if( (clickableAddElementRight !== null) && (clickableAddElementRight !== undefined)) {
    clickableAddElementRight.forEach(function(element) {
      element.addEventListener('click', handleClickRight);
    });
  }

  // Safety checks for the removal elements
  if (clickableRemoveElement) {
    clickableRemoveElement.addEventListener('click', handleClickRemove);
  }
  if (clickableRemoveElementTwo) {
    clickableRemoveElementTwo.addEventListener('click', handleClickRemove);
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && targetElement.classList.contains('from-right')) {
      handleClickRemove(e);
    }
  });

  document.addEventListener('keydown', function(e) {

    if (e.key === 'Tab' && targetElement.classList.contains('from-right')) {

      const firstElement = document.querySelector('[bs-data-removable]');
      const lastElement = document.querySelector('.empty-sidebar-widget-text a');
      // const lastElement = document.querySelector('[bs-data-last]');

      if (!firstElement || !lastElement) return;

      if (document.activeElement === lastElement && !e.shiftKey) {
        e.preventDefault();
        firstElement.focus();
      }

      if (document.activeElement === firstElement && e.shiftKey) {
        e.preventDefault();
        lastElement.focus();
      }
    }
  });

  /* =================================
  ===        Featured Tabs  ====
  =================================== */
  function featuredTabsWidget() {
    document.querySelectorAll('.tab-wrapper').forEach(container => {
      const tabButtons = container.querySelectorAll('.tab-button');
      const tabContents = container.querySelectorAll('.tab-content');

      tabButtons.forEach((button, index) => {
        button.addEventListener('click', function () {
          tabButtons.forEach(btn => btn.classList.remove('active'));
          tabContents.forEach(tab => tab.style.display = 'none');
          tabContents[index].style.display = 'block';
          button.classList.add('active');
        });
      });

      // Initialize first tab as active
      tabButtons[0].classList.add('active');
      tabContents[0].style.display = 'block';
    });
  }
  featuredTabsWidget();

  /*---------------------------------------
    Search           
  -----------------------------------------*/
  let clickAddElementSearch = document.querySelectorAll('[bs-search-clickable]');
  let targetSearchElement = document.querySelector('[bs-search-targeted]'); 
  let targetHideSearch = document.querySelector('[bs-dismiss-search]'); 
 
  // Function to handle the click event
  function openSearch(event) {
    event.preventDefault();
    clickableRemoveElementTwo.classList.add('show');
    targetSearchElement.classList.add('show-search');
    targetBody.style.overflow = 'hidden'; 
    targetBody.style.paddingRight = '17px';
    setTimeout(function () {
      const closeBtn = targetSearchElement.querySelector('[bs-dismiss-search]');
      if (closeBtn) {
        closeBtn.focus();
      }
    }, 10);
  }
  function hideSearch() {
    clickableRemoveElementTwo.classList.remove('show'); 
    targetSearchElement.classList.remove('show-search');
    targetBody.style.overflow = null;
    targetBody.style.paddingRight = null;
    if (clickAddElementSearch.length > 0) {
      clickAddElementSearch[0].focus();
    }
  }
  if(clickAddElementSearch){
    clickAddElementSearch.forEach(function(element) {
      element.addEventListener('click', openSearch);
    });
  }
  // clickableRemoveElementTwo.addEventListener('click', hideSearch);
  targetHideSearch.addEventListener('click', hideSearch);

  clickAddElementSearch.forEach(function(element) {
    element.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        openSearch(e);
      }
    });
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && targetSearchElement.classList.contains('show-search')) {
      hideSearch();
    }
  });
  document.addEventListener('keydown', function(e) {  

    if (e.key !== 'Tab') return;
    if (!targetSearchElement.classList.contains('show-search')) return;

    const firstElement = targetSearchElement.querySelector('[bs-dismiss-search]');
    const lastElement = targetSearchElement.querySelector('.search-popup-content .search-form .search-submit');

    if (!firstElement || !lastElement) return;

    if (document.activeElement === lastElement && !e.shiftKey) {
      e.preventDefault();
      firstElement.focus();
    }
    if (document.activeElement === firstElement && e.shiftKey) {
      e.preventDefault();
      lastElement.focus();
    }

  });

  $(document).ready(function(){
    $(".menu-btn").click(function() {
      console.log('yes');
      $(this).toggleClass("on");
      $("#main-nav").slideToggle();
      $("#menu-header-menu").css("transition", "all 0.8s");
    });
  });

  function addKeydownListener() {
    document.addEventListener('keydown', keydownHandler);
  }

  function removeKeydownListener() {
    document.removeEventListener('keydown', keydownHandler);
  }

  function keydownHandler(event) {
    if (event.key === 'Tab') {
      var focusedElement = document.activeElement;
      var parentElement = document.getElementById('main-nav');
      var ulParent = parentElement.querySelector("ul.sm.sm-clean");
      var lastChild = ulParent.lastElementChild.firstElementChild;

      // Check if the focused element is the last child
      if (focusedElement === lastChild) {
        // Prevent the default tab behavior
        event.preventDefault();

        // Perform your actions here
        const returnFocus = document.querySelector('button.menu-btn');
        returnFocus.click();
        returnFocus.focus();
      }
    }
  }

  function checkWindowSize() {
    if (window.innerWidth < 992) {
      addKeydownListener();
    } else {
      removeKeydownListener();
      document.getElementById('main-nav').style.display = '';
    }
  }

  // Check window size on initial load
  checkWindowSize();

  // Check window size on resize
  window.addEventListener('resize', checkWindowSize);
    
  document.addEventListener('DOMContentLoaded', function() {
    var pageTitle = document.querySelector('.bs-card-box.page-entry-title + .row .page-title');
    if (pageTitle) {
      pageTitle.remove();
    }
  });

})(jQuery);
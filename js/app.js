"use strict";

function App() {
  function offset(el) {
    var rect = el === null || el === void 0 ? void 0 : el.getBoundingClientRect(),
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return {
      top: (rect === null || rect === void 0 ? void 0 : rect.top) + scrollTop
    };
  }
  var tabs = document.querySelectorAll(".js-tab");
  var tabContents = document.querySelectorAll(".js-tab-content");
  var _loop = function _loop(_i) {
    tabs[_i].addEventListener("click", function (event) {
      var tabsChildren = event.target.parentElement.children;
      for (var t = 0; t < tabsChildren.length; t++) {
        tabsChildren[t].classList.remove("tab__active");
      }
      tabs[_i].classList.add("tab__active");
      var tabContentChildrens = event.target.parentElement.nextElementSibling.children;
      for (var c = 0; c < tabContentChildrens.length; c++) {
        tabContentChildrens[c].classList.remove("tab__content-active");
      }
      tabContents[_i].classList.add("tab__content-active");
    });
  };
  for (var _i = 0; _i < tabs.length; _i++) {
    _loop(_i);
  }

  //// slider

  var sliderCompany = new Swiper(".js-company-slider", {
    slidesPerView: "auto",
    spaceBetween: 30,
    loop: true,
    loopFillGroupWithBlank: true,
    speed: 5200,
    simulateTouch: false,
    autoplay: {
      delay: 0,
      disableOnInteraction: false
    },
    breakpoints: {
      1800: {
        spaceBetween: 80
      },
      900: {
        spaceBetween: 50
      }
    }
  });
  var sliderBeyond = new Swiper(".beyond-slider", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    spaceBetween: 10,
    loop: true,
    slidesPerView: 1,
    breakpoints: {
      1800: {
        spaceBetween: 40,
        slidesPerView: 3
      },
      1200: {
        spaceBetween: 20,
        slidesPerView: 3
      },
      768: {
        spaceBetween: 10,
        slidesPerView: 2
      }
    }
  });
  //// faq accordion
  var acc = document.getElementsByClassName("accordion-item");
  var i;
  for (i = 0; i < acc.length; i++) {
    var head = acc[i].querySelector(".accordion-item__head");
    head.addEventListener("click", function () {
      var parentAcc = this.closest(".accordion-item");
      parentAcc.classList.toggle("active");
      var panel = parentAcc.querySelector(".accordion-item__body");
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }

  // scroll header
  var setFixedHeader = function setFixedHeader() {
    if (window.scrollY >= 60 || window.pageYOffset >= 60) {
      document.getElementsByClassName("header")[0].classList.add("scroll-active");
    } else {
      document.getElementsByClassName("header")[0].classList.remove("scroll-active");
    }
  };

  //// parallax

  window.addEventListener("scroll", function () {
    var _window = window,
      scrollY = _window.scrollY;
    var parallaxElem = document.getElementsByClassName("parallax");
    for (var _i2 = 0; _i2 < parallaxElem.length; _i2++) {
      var item = parallaxElem[_i2];
      if (item.scrollTop < scrollY) {
        item.style.top = 0.5 * scrollY - item.scrollTop + "px";
      } else {
        item.style.top = '0px';
      }
    }
  });

  /// header burger

  var burger = document.querySelector(".burger");
  var header = document.querySelector(".header");
  var body = document.querySelector("body");
  function toggleMenu() {
    var burgerClasses = burger.classList.value;
    if (burgerClasses.includes("active")) {
      burger.classList.remove("active");
      header.classList.remove("open-menu");
      body.style.overflow = "visible";
      header.querySelector(".js-dropdown.active").classList.remove("active");
    } else {
      burger.classList.add("active");
      header.classList.add("open-menu");
      body.style.overflow = "hidden";
    }
  }
  burger.addEventListener("click", toggleMenu);

  /// append login
  var login = document.querySelector(".login");
  var nav = document.querySelector(".nav");
  var headerInner = document.querySelector(".header__inner");
  function appendLogin() {
    if (window.innerWidth < 900) {
      nav === null || nav === void 0 ? void 0 : nav.append(login);
    } else {
      headerInner === null || headerInner === void 0 ? void 0 : headerInner.append(login);
      burger.classList.remove("active");
      header.classList.remove("open-menu");
      body.style.overflow = "visible";
    }
  }

  // mobile menu

  var dropdownMenu = document.querySelector(".header");
  dropdownMenu.addEventListener("click", function (event) {
    if (event.target.className.includes("js-dropdown")) {
      event.target.classList.add("active");
    }
    if (event.target.className.includes("js-back")) {
      var parentElem = event.target.closest(".js-dropdown");
      parentElem.classList.remove("active");
    }
  });

  //// scroll down

  document.body.addEventListener("click", function (event) {
    var item = event === null || event === void 0 ? void 0 : event.target;
    if (item.className.includes("js-offset-scroll")) {
      var offsetId = item.dataset.offset;
      var offsetElement = document.querySelector(offsetId);
      offsetElement.scrollIntoView({
        behavior: "smooth"
      });
    }
  });

  // sticky tab header

  var headerItem = document.getElementById("myHeader");
  var parentItem = headerItem === null || headerItem === void 0 ? void 0 : headerItem.closest("section");
  function setTabsSticky() {
    var offsetParent = offset(parentItem);
    if (window.scrollY >= offsetParent.top && parentItem.offsetHeight + offsetParent.top > window.scrollY) {
      headerItem === null || headerItem === void 0 ? void 0 : headerItem.classList.add("sticky");
    } else {
      headerItem === null || headerItem === void 0 ? void 0 : headerItem.classList.remove("sticky");
    }
  }
  function setActiveTab() {
    var activeTab = null;
    var tabBlocks = document.querySelectorAll(".js-tab-block");
    var tabs = document.querySelectorAll(".js-offset-scroll");
    for (var _i3 = 0; _i3 < tabBlocks.length; _i3++) {
      var offsetTab = offset(tabBlocks[_i3]);
      if (window.scrollY >= offsetTab.top) {
        activeTab = tabBlocks[_i3].id;
      }
    }
    for (var j = 0; j < tabs.length; j++) {
      var _tabs$j;
      if ("#".concat(activeTab) === ((_tabs$j = tabs[j]) === null || _tabs$j === void 0 ? void 0 : _tabs$j.dataset.offset)) {
        tabs[j].classList.add("tab__active");
      } else {
        tabs[j].classList.remove("tab__active");
      }
    }
    // console.log(activeTab);
  }

  // gsap plug

  gsap.registerPlugin(MotionPathPlugin);
  var animates = document.getElementsByClassName("js-animate");
  for (var _i4 = 0; _i4 < animates.length; _i4++) {
    var rectSpeed = null;
    var rect = null;
    if (animates[_i4].querySelector(".plane")) {
      rect = animates[_i4].querySelector(".plane");
      rectSpeed = 25;
    } else if (animates[_i4].querySelector(".ship")) {
      rect = animates[_i4].querySelector(".ship");
      rectSpeed = 50;
    }
    var path = animates[_i4].querySelector(".path");
    gsap.set(rect, {
      scaleX: -1,
      duration: 0.5
    });
    if (rect && path) {
      gsap.timeline({
        repeat: -1
      }).from(rect, {
        motionPath: {
          path: path,
          align: path,
          alignOrigin: [0.5, 0.5],
          autoRotate: true
        },
        duration: rectSpeed,
        ease: "none"
      }).to(rect, {
        scaleX: 1,
        duration: 0.5
      }).to(rect, {
        motionPath: {
          path: path,
          align: path,
          alignOrigin: [0.5, 0.5],
          autoRotate: true
        },
        duration: rectSpeed,
        ease: "none"
      }).to(rect, {
        scaleX: -1,
        duration: 0.5
      });
    }
  }

  // running numbers

  var time = 3000;
  var step = 1;
  function outNum(num, elem) {
    var n = 0;
    var t = Math.round(time / (num / step));
    var interval = setInterval(function () {
      n = n + step;
      if (n == num) {
        clearInterval(interval);
      }
      elem.innerHTML = n;
    }, t);
  }
  var executed = false;
  function toVisibleElem(classes, innerClass) {
    var elem = document.getElementsByClassName(classes);
    var visibleArea = window.innerHeight + window.scrollY;
    for (var _i5 = 0; _i5 < (elem === null || elem === void 0 ? void 0 : elem.length); _i5++) {
      var _elem$_i;
      if (visibleArea > ((_elem$_i = elem[_i5]) === null || _elem$_i === void 0 ? void 0 : _elem$_i.offsetTop)) {
        elem[_i5].classList.add("loading");
        if (!executed) {
          executed = true;
          var runningNumbers = document.getElementsByClassName(innerClass);
          for (var j = 0; j < (runningNumbers === null || runningNumbers === void 0 ? void 0 : runningNumbers.length); j++) {
            var _runningNumbers$j;
            if (visibleArea > ((_runningNumbers$j = runningNumbers[j]) === null || _runningNumbers$j === void 0 ? void 0 : _runningNumbers$j.offsetTop)) {
              var num = runningNumbers[j].innerHTML;
              outNum(num, runningNumbers[j]);
            }
          }
        }
      }
    }
  }
  window.onscroll = function () {
    setFixedHeader();
  };
  window.addEventListener("scroll", function () {
    toVisibleElem("js-running-value", "js-running-number");
    setTabsSticky();
    setActiveTab();
  });
  window.addEventListener("resize", function () {
    appendLogin();
  });
  document.addEventListener("DOMContentLoaded", function () {
    appendLogin();
    setFixedHeader();
  });
}
App();
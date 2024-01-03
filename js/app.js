"use strict";

document.addEventListener('DOMContentLoaded', function() {
  AOS.init({
    offset: 200, 
    duration: 1000, 
  });
});

document.addEventListener('DOMContentLoaded', function() {
  var tabs = document.querySelectorAll('.tab');

  openTab(tabs[0].getAttribute('data-tab'));

  tabs.forEach(function(tab) {
      tab.addEventListener('click', function() {
          // Получаем data-атрибут текущей вкладки
          var currentTab = this.getAttribute('data-tab');

          // Открываем текущую вкладку
          openTab(currentTab);
      });
  });

  function openTab(tabId) {
      var tabContents = document.querySelectorAll('.tab-content');
      tabContents.forEach(function(content) {
          content.style.display = 'none';
      });

      tabs.forEach(function(tab) {
          tab.classList.remove('active');
      });

      var currentTabContent = document.getElementById(tabId);
      currentTabContent.style.display = 'block';

      var currentTab = document.querySelector('.tab[data-tab="' + tabId + '"]');
      currentTab.classList.add('active');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var mySwiper = new Swiper('.swiper-container', {
      slidesPerView: 4,
      spaceBetween: 20,
      loop: false,

      // Add navigation
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
  });
});



document.addEventListener('DOMContentLoaded', function () {
    var dropdownBtn = document.getElementById('dropdownBtn');
    var dropdownList = document.getElementById('dropdownList');

    // Показать/скрыть выпадающий список
    dropdownBtn.addEventListener('click', function () {
        dropdownList.style.display = dropdownList.style.display === 'none' ? 'block' : 'none';
    });

    // Обработчик выбора опции
    dropdownList.addEventListener('click', function (event) {
        var target = event.target;
        if (target.tagName === 'LI') {
            dropdownBtn.textContent = target.textContent;
            dropdownList.style.display = 'none';
        }
    });

    // Закрыть выпадающий список при клике вне его
    document.addEventListener('click', function (event) {
        if (!dropdownBtn.contains(event.target) && !dropdownList.contains(event.target)) {
            dropdownList.style.display = 'none';
        }
    });
});

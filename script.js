document.addEventListener('DOMContentLoaded',
    function () {
        const navItems = document.querySelectorAll('.sidebar-list li');
        navItems.forEach(item => {
            item.addEventListener('click',
                function () {
                    navItems.forEach(navItem => navItem.classList.remove('active'));
                    this.classList.add('active');
                });
        });
    });

function filterByText() {
    var input = document.getElementById("search-bar").value.toUpperCase();
    var rows = document.getElementById("table").getElementsByClassName("products-row");
    for (var i = 1; i < rows.length; i++) {
        var rowText = rows[i].innerText.toUpperCase();
        if (rowText.includes(input)) {
            rows[i].style.display = '';
        }
        else {
            rows[i].style.display = 'none';
        }
    }
}

function openAddModal() {
    document.getElementById("add-modal").classList.add("show");
}

function closeAddModal() {
    document.getElementById("add-modal").classList.remove("show");
}

function closeEditModal() {
    document.getElementById("edit-modal").classList.remove("show");
}
document.addEventListener('DOMContentLoaded',
    function () {
        const navItems = document.querySelectorAll('nav li a');
        navItems.forEach(item => {
            item.addEventListener('click',
                function () {
                    navItems.forEach(navItem => navItem.classList.remove('active'));
                    this.classList.add('active');
                });
        });
    });
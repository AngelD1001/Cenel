// Declaramos las variables
var arrow = document.querySelectorAll(".arrow");
var sidebar = document.querySelector(".sidebar");
var sidebarbtn = document.querySelector(".bxs-hot");
var body = document.body;
var menu_side = document.getElementById("menu_side");

// Evento para los botones con clase "arrow"
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showmenu");
    });
}


sidebarbtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    body.classList.toggle("body_move");
    menu_side.classList.toggle("menu_side_move");
});


document.getElementById("btn_open").addEventListener("click", () => {
    body.classList.toggle("body_move");
    menu_side.classList.toggle("menu_side_move");
});


if (window.innerWidth < 760) {
    body.classList.add("body_move");
    menu_side.classList.add("menu_side_move");
}


// Asumiendo que tu contenedor tiene la clase "crud-container"
var crudContainer = document.querySelector('.crud-container');

window.addEventListener('scroll', function() {
    if (window.scrollY > 0) {
        crudContainer.classList.add('scrolled');
    } else {
        crudContainer.classList.remove('scrolled');
    }
});
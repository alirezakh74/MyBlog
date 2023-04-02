const mobile_menu = document.querySelector(".menu-icon .mobile-menu");
const menu_icon_btn = document.querySelector(".menu-icon button");// mobile menu btn
const logo = document.querySelector(".logo");
const nav_items = document.querySelector(".nav-items");
const search_icon = document.querySelector(".search-icon");
const search_icon_btn = document.querySelector(".search-icon button");//mobile search btn
const mobile_search = document.querySelector(".mobile-search"); // mobile search form
const search_container = document.querySelector(".search-container");
//const search_input = document.querySelector(".search-container input");
//const search_button = document.querySelector(".search-container button");
const search_form = document.querySelector(".search-container form");


let is_menu_open = false;
let is_search_open = false;

const TOP = "-51px";
const RIGHT_HIDDEN = "0";
const RIGHT = "0";

// copy navbar items to mobile menu
//mobile_menu.append(nav_items.cloneNode());

if(window.innerWidth <= 768)
{
    nav_items.style.display = "none";
    nav_items.style.position = "absolute";
    mobile_menu.append(nav_items);
    nav_items.style.top = TOP;
    nav_items.style.right = RIGHT_HIDDEN;
    search_container.style.display = "none";
    mobile_search.append(search_form);
    //default should be close and none visible
    mobile_search.style.display = "none";
    search_form.style.display = "fixed";
}
else
{
    nav_items.style.display = "flex";
    nav_items.style.position = "static";
    search_container.style.display = "flex";
    search_container.append(search_form);
}

window.addEventListener("resize", function(event){
    if(event.target.innerWidth <= 768)
    {
        menu_icon_btn.style.display = "flex";
        search_icon_btn.style.display = "flex";
        nav_items.style.display = "none";
        mobile_menu.append(nav_items);
        nav_items.style.position = "absolute";
        nav_items.style.top = TOP;
        nav_items.style.right = RIGHT_HIDDEN;
        search_container.style.display = "none";
        mobile_search.append(search_form);
        search_form.style.position = "fixed"
        mobile_search.style.display = "none";
    }
    else
    {
        menu_icon_btn.style.display = "none";
        search_icon_btn.style.display = "none";
        nav_items.style.display = "flex";
        logo.after(nav_items);
        nav_items.style.position = "static";
        search_container.style.display = "flex";
        search_container.append(search_form);
        search_form.style.position = "static"
        search_form.style.display = "flex";
    }
}
);

menu_icon_btn.addEventListener("click", function(_event){
    //console.log("menu btn clicked");
    toggleMenu();
});

function toggleMenu(){
    is_menu_open = !is_menu_open;
    if(is_menu_open)
    {
        // open menu
        console.log("open menu");
        nav_items.style.display = "flex";
        // nav_items.style.right = RIGHT;
        nav_items.style.top = TOP;
        menu_icon_btn.firstChild.innerHTML = "close";

        search_icon.style.zIndex = "10";
    }
    else
    {
        // close menu
        console.log("close menu");
        nav_items.style.display = "none";
        menu_icon_btn.firstChild.innerHTML = "menu";
        search_icon.style.zIndex = "14";
    }
}

search_icon_btn.addEventListener("click", function(_event){
    //console.log("hiiiii");
    toggleSearch();
});

function toggleSearch()
{
    //console.log("search");
    is_search_open = !is_search_open;
    if(is_search_open)
    {
        menu_icon_btn.style.zIndex = 10;
        search_icon_btn.firstChild.innerHTML = "close";
        mobile_search.style.display = "flex";
        search_form.style.display = "flex";
    }
    else
    {
        menu_icon_btn.style.zIndex = 14;
        search_icon_btn.firstChild.innerHTML = "search";
        mobile_search.style.display = "none";
        search_form.style.display = "none";
    }
}

// document.addEventListener("onscroll", (e) => {
//     if(mobile_search.style.display != "none" && e.target == mobile_search)
//     {
//         mobile_search.style.display = "flex";
//         search_form.style.display = "flex";

//     }
// });

// document.addEventListener("pointermove", (e) => {
//     if(mobile_search.style.display != "none" && e.target == mobile_search)
//     {
//         toggleSearch();
//         toggleMenu();
//     }
// });

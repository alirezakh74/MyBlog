// search stuffs
const search_btn = document.querySelector(".search-close-btn");
const search_icon = document.querySelector(".search-close-btn span");
const search_container = document.querySelector(".search-container");
const search_input = document.querySelector(".search-form input")

// menu stuffs
const menu_btn = document.querySelector(".hamburger");
const menu_items = document.querySelector(".nav-items");
const menu_btn_lines = document.querySelectorAll(".line");

search_icon.addEventListener("click", (e) => {
    if(search_container.classList.contains("active"))
    {
        // search is non active
        search_container.classList.remove("active");
        search_btn.style.zIndex = "1";
        search_icon.innerHTML = "search";
        search_icon.style.color = "black";

        document.body.classList.remove("remove-scrollable");
    }
    else
    {
        //search is active
        search_container.classList.add("active");
        search_btn.style.zIndex = "100";
        search_icon.innerHTML = "close";
        search_icon.style.color = "white";
        search_input.focus();

        menu_btn.style.zIndex = "1";

        document.body.classList.add("remove-scrollable");
    }
});

menu_btn.addEventListener("click", (e) => {
    if(menu_items.classList.contains("active"))
    {
        // menu is none active
        menu_items.classList.remove("active");
        //menu_btn.style.zIndex = "1";
        menu_btn.classList.remove("close");
        menu_btn_lines.forEach((line) => {
            line.style.background = "black";
            line.classList.remove("active");
        });

        document.body.classList.remove("remove-scrollable");
        // scroll items to top after close
        menu_items.scrollTo(0, 0);
    }
    else
    {
        // menu is active
        menu_items.classList.add("active");
        menu_btn.style.zIndex = "100";
        menu_btn.classList.add("close");
        menu_btn_lines.forEach((line) => {
            line.style.background = "white";
            line.classList.add("active");
        });

        document.body.classList.add("remove-scrollable");
    }
});


const search_btn = document.querySelector(".search-close-btn");
const search_icon = document.querySelector(".search-close-btn span");
const search_container = document.querySelector(".search-container");
const search_input = document.querySelector(".search-form input")

search_icon.addEventListener("click", (e) => {
    if(search_container.classList.contains("active"))
    {
        // search is non active
        search_container.classList.remove("active");
        search_btn.style.zIndex = "1";
        search_icon.innerHTML = "search";
        search_icon.style.color = "black";
    }
    else
    {
        //search is active
        search_container.classList.add("active");
        search_btn.style.zIndex = "100";
        search_icon.innerHTML = "close";
        search_icon.style.color = "white";
        search_input.focus();
    }
});

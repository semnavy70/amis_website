let searchBox = document.getElementById('searchbox'),
    searchInput = document.getElementById('search-input'),
    searchClose = document.getElementById('searchbox-close'),
    searchLink = $('.search');
    

let searchToggle = () => {
  if (searchBox.className === 'show') {
    searchBox.className = 'hide';
    searchLink.className = 'nav-link';
    searchInput.value = '';
    searchInput.blur();
  } else {
    searchBox.className = 'show';
    searchLink.className = 'active nav-link';
    searchInput.focus();
  }
}, searchEnter = () => {
    if (event.keyCode == 13) {
      searchToggle();
    }
};

searchLink.click(function(){
    console.log("click me");
    searchToggle();
});

searchClose.addEventListener('click', searchToggle);
searchInput.addEventListener('keyup', searchEnter);
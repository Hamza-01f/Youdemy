//script of searching div

document.addEventListener('DOMContentLoaded', function () {
    const searchResults = document.getElementsByClassName('searchingResults')[0];

    if (searchResults.querySelector('.course-card')) {
        searchResults.classList.remove('hidden'); 
    }
});

function showPage(page) {
    const url = new URL(window.location.href);
    url.searchParams.set('page', page);
    window.location.href = url;
}
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

//chard for stylistics of admin 

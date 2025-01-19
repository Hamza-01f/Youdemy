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

//adding course js here 
function validateForm() {
    let valid = true;

    document.querySelectorAll('.error').forEach(function(element) {
        element.classList.add('hidden');
    });

    const title = document.getElementById('title').value;
    const titleRegex = /^.{3,}$/; 
    if (!title || !titleRegex.test(title)) {
        document.getElementById('titleError').classList.remove('hidden');
        valid = false;
    }

    const description = document.getElementById('description').value;
    const descriptionRegex = /^.{10,}$/; 
    if (!description || !descriptionRegex.test(description)) {
        document.getElementById('descriptionError').classList.remove('hidden');
        valid = false;
    }

    const contentType = document.getElementById('content_type').value;
    if (!contentType) {
        document.getElementById('contentTypeError').classList.remove('hidden');
        valid = false;
    }

    const category = document.getElementById('category_id').value;
    if (!category) {
        document.getElementById('categoryError').classList.remove('hidden');
        valid = false;
    }

    const tags = document.getElementById('tags').selectedOptions;
    if (tags.length === 0) {
        document.getElementById('tagsError').classList.remove('hidden');
        valid = false;
    }

    const courseImage = document.getElementById('courseImage').value;
    const imageRegex = /^(https?:\/\/.*\.(?:png|jpg|jpeg|gif|bmp|svg))$/; 
    if (!courseImage || !imageRegex.test(courseImage)) {
        document.getElementById('courseImageError').classList.remove('hidden');
        valid = false;
    }

    return valid;
}
    new TomSelect("#tags", {
        create: false,
        maxItems: 5,
        placeholder: "Select tags...",
        persist: false,
    });

    document.getElementById('content_type').addEventListener('change', function() {
    if (this.value === 'video') {
        document.getElementById('documentContent').style.display = 'none';
        document.getElementById('videoContent').style.display = 'block';
    } else {
        document.getElementById('documentContent').style.display = 'block';
        document.getElementById('videoContent').style.display = 'none';
    }
    });
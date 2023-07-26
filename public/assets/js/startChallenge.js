const selectBookId = document.querySelector('.books_select');
const selectChapterId = document.querySelector('.chapters_select');

selectBookId.addEventListener('change', setUpBibleBookChapters);

let bibleData = JSON.parse(localStorage.getItem('bible'));

if (!bibleData) {
    getBible().then(data => {
        localStorage.setItem('bible', JSON.stringify(data.original));
        bibleData = data.original;

        bibleData.forEach((book, key) => {
            const option = document.createElement('option');
            option.value = key;
            option.textContent = book.BookName;
            selectBookId.appendChild(option);
        });
        setUpBibleBookChapters();
    });
} else {
    bibleData.forEach((book, key) => {
        const option = document.createElement('option');
        option.value = key;
        option.textContent = book.BookName;
        selectBookId.appendChild(option);
    });
    setUpBibleBookChapters();
}

function setUpBibleBookChapters() {
    selectChapterId.innerHTML = "";
    const bookId = selectBookId.selectedIndex;

    bibleData[bookId]['Chapters'].forEach((chapter, key) => {
        const option = document.createElement('option');
        option.value = key;
        option.textContent = chapter.ChapterId;
        selectChapterId.appendChild(option);
    });
}

async function getBible() {
    const response = await fetch("/account/bible");
    const bible = await response.json();
    return bible;
}


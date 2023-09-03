const selectBookId = document.querySelector('.books_select');
const selectChapterId = document.querySelector('.chapters_select');

selectBookId.addEventListener('change', setUpBibleBookChapters);

let bibleData;

getBible().then(data => {
    bibleData = data;

    bibleData.forEach((book, key) => {
        const option = document.createElement('option');
        option.value = key;
        option.textContent = book.BookName;
        selectBookId.appendChild(option);
    });
    setUpBibleBookChapters();
}).catch(error => {
    alert(error);
});

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
    const response = await fetch("/account/bible", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    });
    const bible = await response.json();
    return bible;
}
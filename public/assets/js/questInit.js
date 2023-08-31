const questTitle = document.querySelectorAll('.user_quest_title');
let bible = JSON.parse(localStorage.getItem('bible'));

if (!bible) {
    getBible().then(data => {
        localStorage.setItem('bible', JSON.stringify(data));
        bible = data;
    });
}

questTitle.forEach(el => {
    let bookId = Number(el.dataset.book) + 1;
    let chapterId = Number(el.dataset.chapter) + 1;

    let bookName = bible[el.dataset.book]['BookName'];

    el.textContent = bookName + ' ' + bookId + ':' + chapterId;
});

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
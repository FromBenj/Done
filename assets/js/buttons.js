const weekButton = document.getElementById('is-of-the-week-button');
weekButton.addEventListener('click', () => {
    if(weekButton.style.backgroundColor === 'white') {
        weekButton.style.backgroundColor = '#28a745';
        weekButton.style.color = '#28a745';
    } else {
        weekButton.style.backgroundColor = 'white';
        weekButton.style.color = 'white';
    }
})

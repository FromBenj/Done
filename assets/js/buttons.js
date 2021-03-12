const weekButton = document.getElementById('is-of-the-week-button');
if(weekButton) {
    weekButton.addEventListener('click', () => {
        if(weekButton.style.backgroundColor === 'white') {
            weekButton.style.backgroundColor = '#28a745';
            weekButton.style.color = '#28a745';
        } else {
            weekButton.style.backgroundColor = 'white';
            weekButton.style.color = 'white';
        }
    })
}
const citationClose = document.getElementById('citation-close');
const citation = document.getElementById('citation')
if(citation) {
    citationClose.addEventListener('click', function() {
        citation.style.display = 'none';
    })
}

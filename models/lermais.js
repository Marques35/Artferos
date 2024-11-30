document.querySelectorAll('.toggle').forEach(button => {
    button.addEventListener('click', function (e) {
        const description = e.target.previousElementSibling;
        const overflow = description.querySelector('.overflow');
        const isExpanded = e.target.dataset.state === 'more';

        description.style.maxHeight = isExpanded ? `${description.scrollHeight}px` : '95px';
        e.target.dataset.state = isExpanded ? 'less' : 'more';
        e.target.innerHTML = isExpanded ? 'Ler menos' : 'Ler mais';

        
        overflow.setAttribute('data-state', isExpanded ? 'hidden' : 'visible');
    });
});

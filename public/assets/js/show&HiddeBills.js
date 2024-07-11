document.addEventListener('DOMContentLoaded', () => {
    const bills = document.querySelectorAll('.content__bill');

    function adjustHeight() {
        const collapsedHeight = window.innerWidth <= 344 ? '80px' : '72px';

        bills.forEach(bill => {
            const parentElement = bill.parentElement;
            if (parentElement.classList.contains('collapsed')) {
                parentElement.style.height = collapsedHeight;
            }
        });
    }

    bills.forEach(bill => {
        bill.addEventListener('click', () => {
            const parentElement = bill.parentElement;
            const collapsedHeight = window.innerWidth <= 344 ? '80px' : '72px';

            if (parentElement.classList.contains('collapsed')) {
                // Expand the parent element
                parentElement.style.height = parentElement.scrollHeight + 'px';

                // Remove the collapsed class after transition
                parentElement.addEventListener('transitionend', () => {
                    parentElement.classList.remove('collapsed');
                    parentElement.style.height = 'auto';
                }, { once: true });
            } else {
                // Collapse the parent element
                parentElement.style.height = parentElement.scrollHeight + 'px';

                // Force reflow to apply the height before collapsing
                parentElement.offsetHeight;

                parentElement.style.height = collapsedHeight;
                parentElement.classList.add('collapsed');
            }
        });
    });

    // Adjust the height when the window is resized
    window.addEventListener('resize', adjustHeight);

    // Initial adjustment
    adjustHeight();
});

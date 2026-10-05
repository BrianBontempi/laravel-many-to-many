const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();

        const entity = form.dataset.entity || 'il progetto';
        const hasConfirmed = confirm(`Sei sicuro di volere eliminare ${entity}?`);
        if (hasConfirmed) form.submit();
    })
})

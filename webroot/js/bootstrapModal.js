const bootstrapModal = document.getElementById('bootstrapModal')

bootstrapModal.addEventListener('show.bs.modal', event => {
    const bootstrapModal = document.getElementById('bootstrapModal')

    const link = event.relatedTarget;

    bootstrapModal.dataset.href = link.href; //data-href

    const confirmMessage = document.getElementById('confirmMessage');

    confirmMessage.textContent = link.dataset.confirmMessage // data-confirm-message
})

const ok = document.getElementById('ok');

ok.addEventListener('click', function () {
    const modal = document.getElementById('bootstrapModal');

    const formName = modal.dataset.formName;

    const href = modal.dataset.href;

    if (formName) {
        document[formName].submit();
    } else if (href) {
        window.location = href;
    }

    const bootstrapModal = bootstrap.Modal.getInstance(modal);

    bootstrapModal.hide();
});


function addToModal(formName) {
    const modal = document.getElementById('bootstrapModal');

    modal.dataset.formName = formName;
}
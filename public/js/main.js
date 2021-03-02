// FAB Button
const btn_create_poll = document.getElementById('btn-create-poll'),
dialog_box =  document.getElementById('dialog_box');
// action to show form
btn_create_poll.addEventListener('click', () => {
    dialog_box.classList.toggle('isVisible');
})
// create a new element for input choice
const btn_cancel = document.getElementById('btn-cancel');
btn_cancel.addEventListener('click', () => {
    dialog_box.classList.toggle('isVisible')
})



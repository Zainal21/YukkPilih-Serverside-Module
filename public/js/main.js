// FAB Button
const btn_create_poll = document.getElementById('btn-create-poll'),
dialog_box =  document.getElementById('dialog_box'),
poll_dialog =  document.getElementById('poll_dialog');

// action to show form
btn_create_poll.addEventListener('click', () => {
    dialog_box.classList.toggle('isVisible');
    poll_dialog.classList.toggle('isVisible');
})

// create a new element for input choice



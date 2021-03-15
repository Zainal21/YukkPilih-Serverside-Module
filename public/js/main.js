
// button create Poll / FAB
const btn_create_poll = document.getElementById('btn-create-poll'),
// Dialog to create poll
dialog_box =  document.getElementById('dialog_box');
// button cancel
const btn_cancel = document.getElementById('btn-cancel');
// form-choice 
const form_input_choice = document.getElementById('form-input-choice');

const btn_add_choice = document.getElementById('add-input-choice')
// action to show form
btn_create_poll.addEventListener('click', () => {
    dialog_box.classList.toggle('isVisible');
})

// create a new element for input choice
btn_cancel.addEventListener('click', () => {
    dialog_box.classList.remove('isVisible')
})

// to create new input form  for create a choice
btn_add_choice.addEventListener('click', (e) => {
    e.preventDefault()
    let choice = document.createElement('input')
    choice.setAttribute('class', 'form-control mt-2');
    choice.setAttribute('name', 'choices[]');
    form_input_choice.appendChild(choice)
})



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
const choice_input = document.getElementById('input-choice'),
addchoice = document.getElementById('addchoice-link');

addchoice.addEventListener('keypress', () => {
    let new_element = `<div class="form-group">
                            <label for="">Choice</label>
                            <input type="text" name="choices[]" id="input-choice" class="form-control">
                        </div>`;
    choice_form.append(new_element)
})


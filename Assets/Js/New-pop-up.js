const new_section = document.querySelector("#new");
const new_section_open_btn = document.getElementById('open');
const new_section_close_btn = document.getElementById('close');

new_section_open_btn.addEventListener('click', () => {
    new_section.classList.add('show-section');
})

new_section_close_btn.addEventListener('click', () => {
    new_section.classList.remove('show-section');
})
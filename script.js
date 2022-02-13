const inputHtml = document.querySelector('input');

inputHtml.addEventListener('change', e => {
    console.log(e.target.value);
    e.target.value = e.target.value.replace('https://www.', '');
    e.target.value = e.target.value.replace('http://www.', '');
    e.target.value = e.target.value.replace('https://', '');
    e.target.value = e.target.value.replace('http://', '');
    e.target.value = e.target.value.replace('www.', '');
});
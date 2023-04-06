window.addEventListener('load', () => {
    let fileInput = document.querySelector('#avatar_file');
    let avatar = document.querySelector('#profile_image');

    fileInput.addEventListener('change', async (e) => {
        let image = e.target.files[0];
        let form = document.querySelector('#avatar_form');

        avatar.classList.add('is-uploading')
        avatar.src = URL.createObjectURL(image);
        let options = {
            method: 'POST',
            body: new FormData(form)
        }
        let response = await fetch(form.action, options);
        if(response.ok) {
            avatar.classList.remove('is-uploading');
        }

    });

})
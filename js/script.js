document.getElementById('imgInput').addEventListener('change', (e) =>{
    const file = e.target.files[0];
    const preview = document.getElementById('imgPreview');
    preview.display = file ? 'block' : 'none';
    if(file) preview.src = URL.createObjectURL(file);
})
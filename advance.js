document.addEventListener("DOMContentLoaded", function () {
    // Add fade-in animation
    document.querySelector('.container').classList.add('visible');
    setTimeout(() => {
        document.querySelector('.result').classList.add('visible');
    }, 300);

    const uploadForm = document.getElementById('uploadForm');
    const loader = document.getElementById('loader');
    const resultDiv = document.getElementById('resultDiv');
    const anagramResult = document.getElementById('anagramResult');

    // Show loader on form submit
    uploadForm.addEventListener('submit', function () {
        loader.style.display = 'block';
        resultDiv.style.opacity = 0.5;
    });

    // Update resultDiv visibility when results are present
    if (anagramResult.innerText.trim() !== "") {
        resultDiv.classList.add('visible');
    }

    // File name preview
    uploadForm.querySelector('input[type="file"]').addEventListener('change', function (e) {
        if (e.target.files.length) {
            let fileName = e.target.files[0].name;
            const fileLabel = document.createElement('p');
            fileLabel.innerText = `Selected file: ${fileName}`;
            fileLabel.style.color = "#4b6cb7";
            uploadForm.insertBefore(fileLabel, loader);
        }
    });
});
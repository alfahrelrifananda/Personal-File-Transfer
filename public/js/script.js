// Upload functionality
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('file-input');
const filePreview = document.getElementById('file-preview');
const fileName = document.getElementById('file-name');
const fileSize = document.getElementById('file-size');
const confirmationArea = document.getElementById('confirmation-area');

// Click to browse
uploadArea.addEventListener('click', () => fileInput.click());

// File input change
fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        showFilePreview(e.target.files[0]);
    }
});

// Drag and drop events
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('drag-over');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('drag-over');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('drag-over');
    if (e.dataTransfer.files.length > 0) {
        fileInput.files = e.dataTransfer.files;
        showFilePreview(e.dataTransfer.files[0]);
    }
});

// Show file preview
function showFilePreview(file) {
    fileName.textContent = file.name;
    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
    const sizeText = sizeInMB > 1 ? `${sizeInMB} MB` : `${(file.size / 1024).toFixed(2)} KB`;
    fileSize.textContent = sizeText;
    filePreview.classList.remove('hidden');
    confirmationArea.classList.remove('hidden');
}

// Copy text functionality
function copyText(button, textId) {
    const textContent = button.closest('.item').querySelector('.item-text-content').textContent;

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(textContent).then(() => {
            showCopiedFeedback(button);
        }).catch(err => {
            fallbackCopy(textContent, button);
        });
    } else {
        fallbackCopy(textContent, button);
    }
}

// Fallback copy method for older browsers
function fallbackCopy(text, button) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();

    try {
        document.execCommand('copy');
        showCopiedFeedback(button);
    } catch (err) {
        alert('Failed to copy text. Please copy manually.');
    }

    document.body.removeChild(textarea);
}

// Show copied feedback
function showCopiedFeedback(button) {
    const originalText = button.innerHTML;
    button.innerHTML = 'Copied!';
    button.classList.add('copied');
    setTimeout(function() {
        button.innerHTML = originalText;
        button.classList.remove('copied');
    }, 2000);
}

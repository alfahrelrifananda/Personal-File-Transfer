@extends('layouts.app')

@section('content')
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --color: #2e2b26;
    --color-soft: #3f3f3f;
    --hover-text: gray;
    --background-color: #ededed;
    --raw-umber: #2e2e2e;
    --silver: #bbbbbb;
    --timberwolf: #d6d6d5;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: var(--background-color);
    min-height: 100vh;
    padding: 30px 20px;
    color: var(--color);
}

.container {
    max-width: 1000px;
    margin: 0 auto;
}

/* Header Section */
.header {
    text-align: center;
    margin-bottom: 40px;
}

.header h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--color);
}

.header p {
    font-size: 16px;
    color: var(--color-soft);
}

/* Network Info Banner */
.network-banner {
    background: white;
    border: 2px solid var(--timberwolf);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.network-icon {
    width: 50px;
    height: 50px;
    background: var(--raw-umber);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    font-weight: 600;
    flex-shrink: 0;
}

.network-info {
    flex: 1;
}

.network-info strong {
    display: block;
    color: var(--color);
    font-size: 14px;
    margin-bottom: 5px;
}

.network-info code {
    background: var(--background-color);
    padding: 8px 12px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 15px;
    color: var(--raw-umber);
    font-weight: 600;
    display: inline-block;
    filter: blur(3px);
    transition: filter 0.3s;
    cursor: pointer;
}

.network-banner:hover code {
    filter: blur(0);
}

/* Alerts */
.alert {
    background: white;
    border-radius: 6px;
    padding: 16px 20px;
    margin-bottom: 20px;
    border: 2px solid;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.alert-success {
    background: #f0f9f0;
    color: #2d5f2d;
    border-color: #4a854a;
}

.alert-error {
    background: #fef2f2;
    color: #991b1b;
    border-color: #ef4444;
}

.alert-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: inherit;
    opacity: 0.5;
    margin-left: auto;
    padding: 0;
    width: 24px;
    height: 24px;
    transition: opacity 0.2s;
}

.alert-close:hover {
    opacity: 1;
}

/* Main Grid Layout */
.main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

/* Cards */
.card {
    background: white;
    border: 2px solid var(--timberwolf);
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.2s;
}

.card:hover {
    border-color: var(--silver);
}

.card-header {
    padding: 20px 24px;
    border-bottom: 2px solid var(--timberwolf);
    background: var(--background-color);
}

.card-header h2 {
    font-size: 18px;
    font-weight: 600;
    color: var(--color);
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-icon {
    width: 32px;
    height: 32px;
    background: var(--raw-umber);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    font-weight: 600;
}

.card-body {
    padding: 24px;
}

/* Text Input */
.text-input {
    width: 100%;
    padding: 14px;
    border: 2px solid var(--timberwolf);
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.2s;
    resize: vertical;
    min-height: 140px;
    background: white;
    color: var(--color);
}

.text-input:focus {
    outline: none;
    border-color: var(--raw-umber);
}

.text-input::placeholder {
    color: var(--silver);
}

/* Upload Area */
.upload-zone {
    border: 2px dashed var(--silver);
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: var(--background-color);
}

.upload-zone:hover {
    border-color: var(--raw-umber);
    background: white;
}

.upload-zone.drag-over {
    border-color: var(--raw-umber);
    background: white;
    border-style: solid;
}

.upload-zone-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    background: var(--raw-umber);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: 700;
}

.upload-zone h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--color);
    margin-bottom: 6px;
}

.upload-zone p {
    color: var(--color-soft);
    font-size: 14px;
}

.file-preview-card {
    background: white;
    border: 2px solid var(--raw-umber);
    border-radius: 6px;
    padding: 16px;
    margin-top: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.2s ease;
}

@keyframes slideIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.file-preview-icon {
    width: 48px;
    height: 48px;
    background: var(--raw-umber);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    font-weight: 600;
    flex-shrink: 0;
}

.file-preview-info {
    flex: 1;
    min-width: 0;
}

.file-preview-name {
    font-weight: 600;
    color: var(--color);
    margin-bottom: 4px;
    word-break: break-word;
}

.file-preview-size {
    font-size: 13px;
    color: var(--color-soft);
}

.upload-ready {
    background: #fff8e1;
    border: 2px solid var(--hover-text);
    border-radius: 6px;
    padding: 16px;
    margin-top: 16px;
    text-align: center;
    color: var(--color);
    font-weight: 500;
}

/* Buttons */
.btn {
    padding: 12px 24px;
    border: 2px solid;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn:active {
    transform: translateY(0);
}

.btn-primary {
    background: var(--raw-umber);
    color: white;
    border-color: var(--raw-umber);
    width: 100%;
    margin-top: 16px;
}

.btn-primary:hover {
    background: var(--hover-text);
    border-color: var(--hover-text);
}

.btn-download {
    background: white;
    color: var(--raw-umber);
    border-color: var(--raw-umber);
}

.btn-download:hover {
    background: var(--raw-umber);
    color: white;
}

.btn-copy {
    background: white;
    color: var(--color-soft);
    border-color: var(--silver);
}

.btn-copy:hover {
    background: var(--color-soft);
    color: white;
    border-color: var(--color-soft);
}

.btn-copy.copied {
    background: var(--color-soft);
    color: white;
    border-color: var(--color-soft);
}

.btn-delete {
    background: white;
    color: #d32f2f;
    border-color: #d32f2f;
}

.btn-delete:hover {
    background: #d32f2f;
    color: white;
}

.btn-upload-confirm {
    width: 100%;
    margin-top: 12px;
}

/* Items List */
.items-section {
    background: white;
    border: 2px solid var(--timberwolf);
    border-radius: 8px;
    overflow: hidden;
}

.items-header {
    padding: 20px 24px;
    background: var(--raw-umber);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.items-header h2 {
    font-size: 20px;
    font-weight: 600;
}

.items-count {
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.items-list {
    max-height: 600px;
    overflow-y: auto;
}

/* Item Card */
.item {
    padding: 20px 24px;
    border-bottom: 2px solid var(--timberwolf);
    transition: background 0.2s;
}

.item:hover {
    background: var(--background-color);
}

.item:last-child {
    border-bottom: none;
}

.item-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 12px;
}

.item-icon {
    width: 48px;
    height: 48px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    flex-shrink: 0;
    border: 2px solid;
}

.icon-pdf { background: #fff5f5; color: #d32f2f; border-color: #d32f2f; }
.icon-doc { background: #f0f4ff; color: #2563eb; border-color: #2563eb; }
.icon-xls { background: #f0fdf4; color: #059669; border-color: #059669; }
.icon-ppt { background: #fff8e1; color: var(--hover-text); border-color: var(--hover-text); }
.icon-img { background: #f0f9ff; color: #0284c7; border-color: #0284c7; }
.icon-vid { background: #faf5ff; color: #9333ea; border-color: #9333ea; }
.icon-aud { background: #f0fdf4; color: #10b981; border-color: #10b981; }
.icon-zip { background: #fff8e1; color: #f59e0b; border-color: #f59e0b; }
.icon-txt { background: var(--background-color); color: var(--raw-umber); border-color: var(--raw-umber); }

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-size: 16px;
    font-weight: 600;
    color: var(--color);
    margin-bottom: 6px;
    word-break: break-word;
}

.item-meta {
    color: var(--color-soft);
    font-size: 13px;
}

.item-text-content {
    background: var(--background-color);
    border: 2px solid var(--timberwolf);
    border-radius: 6px;
    padding: 14px;
    margin: 12px 0;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    color: var(--color);
    white-space: pre-wrap;
    word-break: break-word;
    max-height: 150px;
    overflow-y: auto;
    line-height: 1.6;
}

.item-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: var(--background-color);
    border: 2px solid var(--timberwolf);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 600;
    color: var(--silver);
}

.empty-state h3 {
    font-size: 18px;
    color: var(--color-soft);
    margin-bottom: 8px;
}

.empty-state p {
    color: var(--silver);
    font-size: 14px;
}

.hidden {
    display: none;
}

/* Responsive */
@media (max-width: 768px) {
    body {
        padding: 20px 15px;
    }

    .header h1 {
        font-size: 24px;
    }

    .main-grid {
        grid-template-columns: 1fr;
    }

    .network-banner {
        flex-direction: column;
        text-align: center;
    }

    .item-header {
        flex-direction: column;
    }

    .item-actions {
        width: 100%;
    }

    .btn {
        flex: 1;
        font-size: 13px;
        padding: 10px 16px;
    }

    .items-list {
        max-height: 500px;
    }
}
</style>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>LOCAL SHARE</h1>
        <p>Transfer files and text instantly</p>
    </div>

    <!-- Network Info -->
    <div class="network-banner">
        <div class="network-icon">NET</div>
        <div class="network-info">
            <strong>Access from your phone:</strong>
            <code>http://{{ $localIP }}</code>
            <p style="font-size: 12px; color: var(--color-soft); margin-top: 6px;">
                Make sure your phone is connected to the same WiFi network
            </p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            SUCCESS: {{ session('success') }}
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ERROR: {{ session('error') }}
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            ERROR: @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    <!-- Main Grid -->
    <div class="main-grid">
        <!-- Text Card -->
        <div class="card">
            <div class="card-header">
                <h2><div class="card-icon">TXT</div> Share Text</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('text.save') }}" method="POST">
                    @csrf
                    <textarea
                        name="content"
                        class="text-input"
                        placeholder="Type or paste text here (URLs, notes, code snippets...)"
                        required></textarea>
                    <button type="submit" class="btn btn-primary">
                        Save Text
                    </button>
                </form>
            </div>
        </div>

        <!-- Upload Card -->
        <div class="card">
            <div class="card-header">
                <h2><div class="card-icon">UP</div> Upload File</h2>
            </div>
            <div class="card-body">
                <form id="upload-form" action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="upload-area" class="upload-zone">
                        <div class="upload-zone-icon">+</div>
                        <h3>Drop file here or click to browse</h3>
                        <p>Maximum size: 33MB</p>
                        <input type="file" id="file-input" name="file" class="hidden" required>

                        <div id="file-preview" class="file-preview-card hidden">
                            <div class="file-preview-icon">FILE</div>
                            <div class="file-preview-info">
                                <div class="file-preview-name" id="file-name"></div>
                                <div class="file-preview-size" id="file-size"></div>
                            </div>
                        </div>
                    </div>

                    <div id="confirmation-area" class="hidden">
                        <div class="upload-ready">
                            File ready to upload
                        </div>
                        <button type="submit" class="btn btn-primary btn-upload-confirm">
                            Upload Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Shared Items -->
    <div class="items-section">
        <div class="items-header">
            <h2>Shared Items</h2>
            <div class="items-count">{{ $files->count() + (isset($texts) ? $texts->count() : 0) }}</div>
        </div>
        <div class="items-list">
            @if($files->count() > 0 || (isset($texts) && $texts->count() > 0))
                @php
                    $allItems = collect($files)->map(function($file) {
                        return [
                            'type' => 'file',
                            'data' => $file,
                            'timestamp' => $file['uploaded_at_timestamp'] ?? 0
                        ];
                    });

                    if(isset($texts) && $texts->count() > 0) {
                        $allItems = $allItems->concat(
                            $texts->map(function($text) {
                                return [
                                    'type' => 'text',
                                    'data' => $text,
                                    'timestamp' => $text['created_at_timestamp'] ?? 0
                                ];
                            })
                        );
                    }

                    $allItems = $allItems->sortByDesc('timestamp');
                @endphp

                @foreach($allItems as $item)
                    @if($item['type'] === 'file')
                        @php
                            $file = $item['data'];
                            $ext = strtolower($file['extension']);
                            $iconClass = match($ext) {
                                'pdf' => 'pdf',
                                'doc', 'docx' => 'doc',
                                'xls', 'xlsx' => 'xls',
                                'ppt', 'pptx' => 'ppt',
                                'jpg', 'jpeg', 'png', 'gif' => 'img',
                                'mp4', 'avi', 'mov' => 'vid',
                                'mp3', 'wav' => 'aud',
                                'zip', 'rar' => 'zip',
                                default => 'txt'
                            };
                        @endphp
                        <div class="item">
                            <div class="item-header">
                                <div class="item-icon icon-{{ $iconClass }}">
                                    {{ strtoupper(substr($file['extension'], 0, 3)) }}
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $file['name'] }}</div>
                                    <div class="item-meta">{{ $file['size'] }} • {{ $file['uploaded_at'] }}</div>
                                </div>
                            </div>
                            <div class="item-actions">
                                <a href="{{ route('files.download', basename($file['path'])) }}" class="btn btn-download">
                                    Download
                                </a>
                                <form action="{{ route('files.delete', basename($file['path'])) }}"
                                      method="POST"
                                      style="display: inline;"
                                      onsubmit="return confirm('Delete this file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    @else
                        @php $text = $item['data']; @endphp
                        <div class="item">
                            <div class="item-header">
                                <div class="item-icon icon-txt">TXT</div>
                                <div class="item-details">
                                    <div class="item-name">Text Note</div>
                                    <div class="item-meta">{{ strlen($text['content']) }} characters • {{ $text['created_at'] }}</div>
                                </div>
                            </div>
                            <div class="item-text-content">{{ $text['content'] }}</div>
                            <div class="item-actions">
                                <button class="btn btn-copy" onclick="copyText(this, '{{ $text['id'] }}')">
                                    Copy
                                </button>
                                <form action="{{ route('text.delete', $text['id']) }}"
                                      method="POST"
                                      style="display: inline;"
                                      onsubmit="return confirm('Delete this text?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">EMPTY</div>
                    <h3>No items yet</h3>
                    <p>Share text or upload files to get started</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('file-input');
const filePreview = document.getElementById('file-preview');
const fileName = document.getElementById('file-name');
const fileSize = document.getElementById('file-size');
const confirmationArea = document.getElementById('confirmation-area');

uploadArea.addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        showFilePreview(e.target.files[0]);
    }
});

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

function showFilePreview(file) {
    fileName.textContent = file.name;
    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
    const sizeText = sizeInMB > 1 ? `${sizeInMB} MB` : `${(file.size / 1024).toFixed(2)} KB`;
    fileSize.textContent = sizeText;
    filePreview.classList.remove('hidden');
    confirmationArea.classList.remove('hidden');
}

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

function showCopiedFeedback(button) {
    const originalText = button.innerHTML;
    button.innerHTML = 'Copied!';
    button.classList.add('copied');
    setTimeout(function() {
        button.innerHTML = originalText;
        button.classList.remove('copied');
    }, 2000);
}
</script>
@endsection

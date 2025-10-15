@extends('layouts.app')

@section('content')
<style>
* { box-sizing: border-box; }

body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    line-height: 1.6;
    color: #333;
    background: #f5f5f5;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.alert {
    padding: 15px 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    background: #fff;
    border-left: 4px solid #0066cc;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.alert-success {
    border-left-color: #22c55e;
    background: #f0fdf4;
}

.alert-error {
    border-left-color: #ef4444;
    background: #fef2f2;
}

.alert-close {
    float: right;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #666;
    padding: 0;
    width: 24px;
    height: 24px;
    line-height: 1;
}

.ip-box {
    background: #e3f2fd;
    border-left-color: #2196f3;
}

.ip-box code {
    background: #fff;
    padding: 8px 12px;
    border-radius: 4px;
    display: inline-block;
    margin: 5px 0;
    font-family: 'Courier New', monospace;
    font-size: 14px;
    word-break: break-all;
    filter: blur(5px);
    transition: filter 0.3s ease;
    cursor: pointer;
}

.ip-box:hover code {
    filter: blur(0);
}

.card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.card-header {
    padding: 15px 20px;
    background: #667eea;
    color: #fff;
    font-weight: 600;
    font-size: 18px;
}

.card-body {
    padding: 20px;
}

.upload-area {
    border: 3px dashed #ddd;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #fafafa;
}

.upload-area:hover {
    border-color: #667eea;
    background: #f0f0ff;
}

.upload-area.drag-over {
    border-color: #667eea;
    background: #e8e8ff;
    transform: scale(1.02);
}

.upload-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    border: 3px solid #ddd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 24px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.btn-primary {
    background: #667eea;
    color: #fff;
}

.btn-primary:hover {
    background: #5568d3;
}

.btn-outline {
    background: #fff;
    color: #667eea;
    border: 1px solid #667eea;
}

.btn-outline:hover {
    background: #667eea;
    color: #fff;
}

.btn-danger {
    background: #fff;
    color: #ef4444;
    border: 1px solid #ef4444;
}

.btn-danger:hover {
    background: #ef4444;
    color: #fff;
}

.btn-full {
    width: 100%;
    margin-top: 15px;
}

.file-list-header {
    padding: 15px 20px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
}

.badge {
    background: #667eea;
    color: #fff;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
}

.file-item {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.2s;
    border-left: 3px solid transparent;
}

.file-item:hover {
    background: #f8f9fa;
    border-left-color: #667eea;
}

.file-item:last-child {
    border-bottom: none;
}

.file-content {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}

.file-icon {
    width: 40px;
    height: 40px;
    background: #f3f4f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    flex-shrink: 0;
}

.file-icon.pdf { background: #fee2e2; color: #dc2626; }
.file-icon.doc { background: #dbeafe; color: #2563eb; }
.file-icon.xls { background: #d1fae5; color: #059669; }
.file-icon.ppt { background: #fef3c7; color: #d97706; }
.file-icon.img { background: #dbeafe; color: #0284c7; }
.file-icon.vid { background: #e9d5ff; color: #9333ea; }
.file-icon.aud { background: #d1fae5; color: #10b981; }
.file-icon.zip { background: #fef3c7; color: #f59e0b; }

.file-info {
    flex: 1;
    min-width: 0;
}

.file-info h3 {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 500;
    color: #1f2937;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.file-meta {
    color: #6b7280;
    font-size: 13px;
}

.file-actions {
    display: flex;
    gap: 10px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 15px;
    border: 3px dashed #d1d5db;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #d1d5db;
}

.hidden {
    display: none;
}

.preview-box {
    margin-top: 15px;
    padding: 12px;
    background: #f3f4f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.preview-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #666;
    padding: 0 5px;
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    .file-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .file-actions {
        width: 100%;
    }

    .btn {
        flex: 1;
        padding: 8px 12px;
        font-size: 13px;
    }

    .upload-area {
        padding: 30px 15px;
    }
}
</style>

<div class="container">
    <!-- IP Address Box -->
    <div class="alert ip-box">
        <strong>Access from phone:</strong><br>
        <code>http://{{ $localIP }}</code>
        <p style="margin: 10px 0 0 0; font-size: 13px; color: #666;">
            Connect phone to the same WiFi network
        </p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- Upload Card -->
    <div class="card">
        <div class="card-header">Upload File</div>
        <div class="card-body">
            <form id="upload-form" action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="upload-area" class="upload-area">
                    <div class="upload-icon">↑</div>
                    <p style="margin: 0 0 5px 0; font-weight: 600;">Click to upload or drag and drop</p>
                    <p style="margin: 0; color: #999; font-size: 14px;">Maximum file size: 33MB</p>
                    <input type="file" id="file-input" name="file" class="hidden" required>
                    <div id="file-preview" class="preview-box hidden">
                        <span id="file-name"></span>
                        <button type="button" class="preview-close" onclick="clearFile()">×</button>
                    </div>
                </div>
                <button type="submit" id="upload-btn" class="btn btn-primary btn-full hidden">
                    Upload File
                </button>
            </form>
        </div>
    </div>

    <!-- Files List -->
    <div class="card">
        <div class="file-list-header">
            <strong>Uploaded Files</strong>
            <span class="badge">{{ count($files) }} files</span>
        </div>
        <div>
            @if($files->count() > 0)
                @foreach($files as $file)
                    <div class="file-item">
                        <div class="file-content">
                            @php
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
                                    default => ''
                                };
                            @endphp
                            <div class="file-icon {{ $iconClass }}">
                                {{ strtoupper(substr($file['extension'], 0, 3)) }}
                            </div>
                            <div class="file-info">
                                <h3>{{ $file['name'] }}</h3>
                                <div class="file-meta">
                                    {{ $file['size'] }} • {{ $file['uploaded_at'] }}
                                </div>
                            </div>
                        </div>
                        <div class="file-actions">
                            <a href="{{ route('files.download', basename($file['path'])) }}" class="btn btn-outline">
                                Download
                            </a>
                            <form action="{{ route('files.delete', basename($file['path'])) }}"
                                  method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Delete this file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">□</div>
                    <h3 style="margin: 0 0 5px 0; color: #9ca3af;">No files uploaded yet</h3>
                    <p style="margin: 0; font-size: 14px;">Upload your first file using the form above</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
const uploadArea = document.getElementById('upload-area');
const fileInput = document.getElementById('file-input');
const uploadForm = document.getElementById('upload-form');
const uploadBtn = document.getElementById('upload-btn');
const filePreview = document.getElementById('file-preview');
const fileName = document.getElementById('file-name');

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
    filePreview.classList.remove('hidden');
    uploadBtn.classList.remove('hidden');
}

function clearFile() {
    fileInput.value = '';
    filePreview.classList.add('hidden');
    uploadBtn.classList.add('hidden');
}
</script>
@endsection

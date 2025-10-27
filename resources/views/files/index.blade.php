@extends('layouts.app')

@section('content')
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
@endsection

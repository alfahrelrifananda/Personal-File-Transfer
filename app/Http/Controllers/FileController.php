<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FileController extends Controller
{
    public function index()
    {
        $localIP = trim(shell_exec("ip route get 1.1.1.1 | awk '{print $7}'"));
        $files = collect(Storage::disk('public')->files('uploads'))
            ->map(function ($file) {
                $fullPath = storage_path('app/public/' . $file);
                return [
                    'name' => basename($file),
                    'path' => $file,
                    'size' => $this->formatBytes(filesize($fullPath)),
                    'uploaded_at' => Carbon::createFromTimestamp(filemtime($fullPath))->format('M d, Y H:i'),
                    'extension' => pathinfo($file, PATHINFO_EXTENSION),
                ];
            })
            ->sortByDesc('uploaded_at')
            ->values();

        return view('files.index', compact('files', 'localIP'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:33792',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();

        $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $filename, 'public');

        return redirect()->route('files.index')
            ->with('success', 'File uploaded successfully!');
    }

    public function download($file)
    {
        $filePath = 'uploads/' . $file;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function delete($file)
    {
        $filePath = 'uploads/' . $file;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return redirect()->route('files.index')
                ->with('success', 'File deleted successfully!');
        }

        return redirect()->route('files.index')
            ->with('error', 'File not found!');
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}

?>

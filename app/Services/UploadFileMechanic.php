<?php

namespace App\Services;

use App\Models\TemporaryFile;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class UploadFileMechanic
{
    public function store(
        Request $request
    ): string
    {
        if (app()->bound('debugbar')) {
            Debugbar::disable();
        }

        if ($request->hasFile($requestedFileName = $request->keys()[0])) {
            try {
                $tempFile = $request->file($requestedFileName);
                $noSpacesFileName = str_replace(' ', '_', $tempFile->getClientOriginalName());
                $fileName = str_replace('-', '_', $noSpacesFileName);
                $folder = uniqid() . '-' . now()->timestamp;
                $path = 'excel/' . $folder;

                if ($tempFile->storeAs($path, $fileName, ['disk' => 'public'])) {
                    TemporaryFile::create([
                        'folderName' => $folder,
                        'fileName' => $fileName,
                    ]);

                    return $folder . '/' . $fileName;
                }
            } catch (\Exception $e) {
                throw new \Exception('Error storing temporary image: ' . $e->getMessage());
            }
        }

        return '';
    }
}

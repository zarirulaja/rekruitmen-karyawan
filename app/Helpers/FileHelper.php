<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    /**
     * Get the correct storage path for CV files
     *
     * @param string $filename
     * @return string
     */
    public static function getCVPath($filename)
    {
        return 'public/cv/' . $filename;
    }

    /**
     * Store CV file in the correct location
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $name User's name for filename
     * @return string|false Returns the stored path or false on failure
     */
    public static function storeCV($file, $name)
    {
        try {
            // Generate a unique filename
            $filename = Str::slug($name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store the file in the public/cv directory
            $path = $file->storeAs('public/cv', $filename);
            
            // Return the database-friendly path (without 'public/')
            return $path ? Str::replaceFirst('public/', '', $path) : false;
        } catch (\Exception $e) {
            \Log::error('Error storing CV file', [
                'error' => $e->getMessage(),
                'name' => $name
            ]);
            return false;
        }
    }

    /**
     * Check if CV file exists and is accessible
     *
     * @param string $path
     * @return bool
     */
    public static function cvExists($path)
    {
        if (empty($path)) {
            return false;
        }

        // Ensure path starts with public/
        if (!Str::startsWith($path, 'public/')) {
            $path = 'public/' . $path;
        }

        return Storage::exists($path);
    }

    /**
     * Get full storage path for debugging
     *
     * @param string $path
     * @return string
     */
    public static function getFullPath($path)
    {
        if (!Str::startsWith($path, 'public/')) {
            $path = 'public/' . $path;
        }
        return Storage::path($path);
    }
} 
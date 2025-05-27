<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FileValidationService
{
    /**
     * Maximum allowed file size in bytes (50MB)
     */
    const MAX_FILE_SIZE = 52428800;
    
    /**
     * Allowed MIME types
     */
    const ALLOWED_MIME_TYPES = [
        // Documents
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        // Archives
        'application/zip',
        'application/x-zip-compressed',
        // Videos
        'video/mp4',
        'video/x-msvideo',
        'video/quicktime',
    ];
    
    /**
     * Allowed file extensions
     */
    const ALLOWED_EXTENSIONS = [
        'pdf', 'doc', 'docx', 'ppt', 'pptx', 'zip', 'mp4', 'avi', 'mov'
    ];
    
    /**
     * Validate the file content
     *
     * @param UploadedFile $file
     * @return bool
     * @throws ValidationException
     */
    public function validate(UploadedFile $file)
    {
        $this->validateFileSize($file);
        $this->validateMimeType($file);
        $this->validateFileExtension($file);
        $this->scanForMalware($file);
        
        return true;
    }
    
    /**
     * Store a file securely
     *
     * @param UploadedFile $file
     * @param string $type Publication type
     * @return array File information [path, size, type]
     */
    public function storeSecurely(UploadedFile $file, string $type)
    {
        // Generate a secure filename with timestamp to avoid conflicts
        $timestamp = now()->format('Y/m/d');
        $secureFilename = time() . '_' . hash('sha256', $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        
        // Store in type-specific subfolder with date structure
        $filePath = $file->storeAs(
            "publicacoes/{$type}/{$timestamp}", 
            $secureFilename, 
            'public'
        );
        
        return [
            'path' => $filePath,
            'size' => $file->getSize(),
            'type' => $file->getClientOriginalExtension(),
            'original_name' => $file->getClientOriginalName()
        ];
    }
    
    /**
     * Delete file if it exists
     *
     * @param string|null $path
     * @return bool
     */
    public function deleteFile(?string $path)
    {
        if (!$path || !Storage::disk('public')->exists($path)) {
            return false;
        }
        
        return Storage::disk('public')->delete($path);
    }
    
    /**
     * Validate file size
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    private function validateFileSize(UploadedFile $file)
    {
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw ValidationException::withMessages([
                'conteudo_file' => 'O arquivo excede o tamanho máximo permitido de 50MB.'
            ]);
        }
    }
    
    /**
     * Validate file MIME type
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    private function validateMimeType(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();
        
        if (!in_array($mimeType, self::ALLOWED_MIME_TYPES)) {
            throw ValidationException::withMessages([
                'conteudo_file' => 'O tipo de arquivo não é permitido. Apenas PDF, DOC, DOCX, PPT, PPTX, ZIP, MP4, AVI e MOV são aceitos.'
            ]);
        }
    }
    
    /**
     * Validate file extension
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    private function validateFileExtension(UploadedFile $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw ValidationException::withMessages([
                'conteudo_file' => 'A extensão do arquivo não é permitida. Apenas PDF, DOC, DOCX, PPT, PPTX, ZIP, MP4, AVI e MOV são aceitos.'
            ]);
        }
    }
    
    /**
     * Scan file for potential malware (placeholder for actual implementation)
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    private function scanForMalware(UploadedFile $file)
    {
        // In a real-world implementation, you would integrate with a virus scanning service
        // For now, this is a placeholder that performs basic checks
        
        // Log the file scan for audit purposes
        Log::info('File scanned for security', [
            'filename' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType()
        ]);
        
        // For ZIP files, we could check for suspicious extensions inside
        if ($file->getMimeType() === 'application/zip' || $file->getMimeType() === 'application/x-zip-compressed') {
            // In a real implementation, you would extract and scan the zip contents
            // This is a simplified example
            Log::info('ZIP file detected - would scan contents in production');
        }
    }
}

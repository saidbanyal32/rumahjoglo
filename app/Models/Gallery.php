<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image_path',
        'caption',
        'sort_order',
    ];

    public const CATEGORIES = [
        'Pendopo' => 'Pendopo Utama',
        'Kamar & Penginapan' => 'Kamar & Penginapan',
        'Taman & Outdoor' => 'Taman & Area Outdoor',
        'Acara & Dekorasi' => 'Acara & Dekorasi Wedding',
    ];

    /**
     * URL publik untuk file gambar.
     */
    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        return Storage::url($this->image_path);
    }
}


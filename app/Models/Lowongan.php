<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lowongan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'posisi',
        'tipe_pekerjaan',
        'lokasi',
        'persyaratan',
        'tanggung_jawab',
        'gaji_min',
        'gaji_max',
        'status',
        'tanggal_tutup',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_tutup' => 'datetime',
        'status' => 'boolean',
        'gaji_min' => 'integer',
        'gaji_max' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the lamaran for the lowongan.
     */
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($lowongan) {
            // Log deletion attempt
            \Log::info('Attempting to delete lowongan', [
                'id' => $lowongan->id,
                'posisi' => $lowongan->posisi
            ]);
        });
    }
} 
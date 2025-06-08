<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lamaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pelamar_id',
        'lowongan_id',
        'status',
        'catatan_hrd',
        'tanggal_lamar',
        'pesan_tambahan',
        'jadwal_wawancara',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lamar' => 'date',
        'jadwal_wawancara' => 'datetime',
    ];
    
    /**
     * The valid status values for the application.
     *
     * @var array
     */
    public static $validStatuses = ['pending', 'review', 'wawancara', 'diterima', 'ditolak'];
    
    /**
     * Set the status attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setStatusAttribute($value)
    {
        // Ensure the status is properly formatted
        $value = trim(strtolower($value));
        
        // Only set if it's a valid status
        if (in_array($value, self::$validStatuses)) {
            $this->attributes['status'] = $value;
        }
    }

    /**
     * Get the pelamar that owns the lamaran.
     */
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    /**
     * Get the lowongan that owns the lamaran.
     */
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
} 
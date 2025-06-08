<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelamar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'pendidikan_terakhir',
        'pengalaman_kerja',
        'keahlian',
        'cv_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the user that owns the pelamar profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lamaran for the pelamar.
     */
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
    }
} 
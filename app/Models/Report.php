<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * Daftar atribut yang dapat diisi.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'coordinates',
        'photo_path',
        'status', // ✅ Sudah didokumentasikan di sini
    ];

    /**
     * Relasi ke User (pelapor).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Daftar status yang diizinkan.
     */
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DITINDAKLANJUTI = 'ditindaklanjuti';
    public const STATUS_SELESAI = 'selesai';

    /**
     * Daftar status yang valid.
     *
     * @return array
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_MENUNGGU,
            self::STATUS_DITINDAKLANJUTI,
            self::STATUS_SELESAI,
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    use HasFactory;

    protected $table = 'simulations';
    protected $primaryKey = 'simulasi_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'bank_id',
        'nominal_deposito',
        'jangka_waktu_bulan',
        'bunga_diterima',
        'total_akhir',
        'waktu_simulasi',
    ];

    protected $casts = [
        'nominal_deposito' => 'decimal:2',
        'bunga_diterima' => 'decimal:2',
        'total_akhir' => 'decimal:2',
        'waktu_simulasi' => 'datetime',
    ];

    /**
     * Relationship dengan user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship dengan bank
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'bank_id');
    }
}
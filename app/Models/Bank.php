<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';
    protected $primaryKey = 'bank_id';

    protected $fillable = [
        'nama_bank',
        'pt',
        'logo_url',
        'color_primary',
        'color_secondary',
        'suku_bunga_dasar',
    ];

    protected $casts = [
        'suku_bunga_dasar' => 'decimal:2',
    ];

    /**
     * Relationship dengan simulations  
     */
    public function simulations()
    {
        return $this->hasMany(Simulation::class, 'bank_id', 'bank_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'mom_full_name',
        'cns',
        'cpf',
        'birthday',
        'photo_url'
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}

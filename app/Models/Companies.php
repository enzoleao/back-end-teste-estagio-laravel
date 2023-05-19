<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = ['name', 'cnpj'];

    public function companies()
    {
        return $this->belongsToMany(Role::class, 'companies_and_sectors');
    }
}

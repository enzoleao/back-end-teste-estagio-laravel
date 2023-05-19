<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectors extends Model
{
    protected $fillable = ['name'];

    public function sectors()
    {
        return $this->belongsToMany(Role::class, 'companies_and_sectors');
    }
}

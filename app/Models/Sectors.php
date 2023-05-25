<?php

namespace App\Models;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectors extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $hidden = array('pivot',  'created_at', 'updated_at');
    public function companies()
    {
        return $this->belongsToMany(Companies::class,  'companies_and_sectors', 'company_id', 'sector_id');
    }
}

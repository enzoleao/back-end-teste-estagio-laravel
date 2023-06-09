<?php

namespace App\Models;

use App\Models\Sectors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $hidden = array('pivot');
    protected $fillable = ['name','cnpj'];
    public function sectors()
    {
        return $this->belongsToMany(Sectors::class,  'companies_and_sectors', 'company_id', 'sector_id');
    }
}

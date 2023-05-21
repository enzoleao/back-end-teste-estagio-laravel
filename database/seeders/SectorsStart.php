<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sectors;

class SectorsStart extends Seeder
{
 
    public function run(): void
    {
        $sectors = [
            ['name' => 'Tecnologia da Informação'],
            ['name' => 'Financeiro'],
            ['name' => 'Vendas'],
            ['name' => 'Saúde'],
            ['name' => 'Varejo'],
            ['name' => 'Alimentação'],
            ['name' => 'Transporte'],
            ['name' => 'Construção'],
            ['name' => 'Educação'],
            ['name' => 'Telecomunicações'],
        ];
        Sectors::insert($sectors);
    }
}

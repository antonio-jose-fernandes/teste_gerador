<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DisponibilidadePlanilhasImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            '*' => new CursoPlanilhaImport(),
        ];
    }
}


<?php

namespace App\Imports;

use App\Models\PlanilhaEnsino;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithTitle;

class CursoPlanilhaImport implements ToModel, WithTitle
{

    private $nomeAba;

    public function title(): string
    {
        return $this->nomeAba;
    }

    public function setTitle($title)
    {
        $this->nomeAba = $title;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // calculando horas
        $comprimento = strlen($row[4]);
        $horas = 0;
        switch ($comprimento) {
            case 5:
                $horas = 1;
                break;
            case 8:
                $horas = 2;
                break;
            case 10:
                $horas = 4;
                break;
            case 17:
                $horas = 4;
                break;
            case 13:
                $horas = 3;
                break;
        }

        $count = substr_count(strtolower($row[4]), '(');
        if (($comprimento == 17) && ($count == 3)){
            $horas = 3;
        }

        //saparando se o curso eh superior ou tecnico
        $tresPrimeirasLetras = substr($row[2], 0, 3);
        $tipo_curso = '';
        switch ($tresPrimeirasLetras) {
            case 'EAD':
                $tipo_curso = 'TECNICO';
                break;
            case 'Lic':
                $tipo_curso = 'TECNICO';
                break;
            case 'Tec':
                $tipo_curso = 'TECNICO';
                break;
            case 'Sup':
                $tipo_curso = 'SUPERIOR';
                break;
            case 'Eng':
                $tipo_curso = 'SUPERIOR';
                break;
            case 'FIC':
                $tipo_curso = 'FIC';
                break;
        }

        return new PlanilhaEnsino([
            'siape' => $row[0],
            'professor' => $row[3],
            'curso' => $tipo_curso,
            'disciplina' => $row[1],
            'horas' => $horas,
        ]);

    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            dd($row);
            // Faça o que quiser com cada linha da planilha
        }
    }
}

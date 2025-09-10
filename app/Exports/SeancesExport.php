<?php

namespace App\Exports;

use App\Models\Seance;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SeancesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $filiere_id;
    protected $groupe_id;
    protected $semestre_id;
    protected $filiere;
    protected $groupe;
    protected $semestre;
    protected $joursSemaine;

    public function __construct($filiere_id, $groupe_id, $semestre_id)
    {
        $this->filiere_id = $filiere_id;
        $this->groupe_id = $groupe_id;
        $this->semestre_id = $semestre_id;
        $this->filiere = Filiere::find($filiere_id);
        $this->groupe = Groupe::find($groupe_id);
        $this->joursSemaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    }

    public function title(): string
    {
        return 'Emploi du temps';
    }

public function collection()
{
    $seances = Seance::with(['module', 'salle', 'enseignant', 'groupe'])
        ->where('id_filiere', $this->filiere_id)
        ->where('id_groupe', $this->groupe_id)
        ->where('id_semestre', $this->semestre_id)
        ->orderByRaw("FIELD(jour, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi')")
        ->orderBy('debut')
        ->get();

    $tousLesJours = collect();

    foreach ($this->joursSemaine as $jour) {
        $seancesDuJour = $seances->where('jour', $jour);

        if ($seancesDuJour->isEmpty()) {
            $tousLesJours->push((object)[
                'jour' => $jour,
                'seances' => []
            ]);
        } else {
            $tousLesJours->push((object)[
                'jour' => $jour,
                'seances' => $seancesDuJour->values() // regroupe toutes les séances du jour
            ]);
        }
    }

    return $tousLesJours;
}

public function map($row): array
{
    $creneaux = [
        '08:30-10:30' => ['08:30', '10:30'],
        '10:30-12:30' => ['10:30', '12:30'],
        '14:30-16:30' => ['14:30', '16:30'],
        '16:30-18:30' => ['16:30', '18:30']
    ];

    $rowData = [ucfirst($row->jour)];

    foreach ($creneaux as $creneau => $hours) {
        $content = '';

        foreach ($row->seances as $seance) {
            if (\Carbon\Carbon::parse($seance->debut)->format('H:i') === $hours[0] &&
                \Carbon\Carbon::parse($seance->fin)->format('H:i') === $hours[1]) {
                
                $content .= sprintf(
                    "%s (%s)\n%s\nSalle: %s\nProf: %s\n\n",
                    $seance->module->nom_module ?? 'Module inconnu',
                    $seance->type_seance,
                    $seance->groupe->nom_groupe ?? 'Groupe inconnu',
                    $seance->salle->nom_salle ?? 'Salle inconnue',
                    $seance->enseignant->name ?? 'Inconnu'
                );
            }
        }

        $rowData[] = trim($content);
    }

    return $rowData;
}

    public function headings(): array
    {
        return [
            ['FILIERE : ' . $this->filiere->nom_filiere],
            ['GROUPE : ' . $this->groupe->nom_groupe],
            ['Année Universitaire : ' . date('Y') . '/' . (date('Y') + 1)],
            [''],
            ['Jour', '08:30-10:30', '10:30-12:30', '14:30-16:30', '16:30-18:30']
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style pour l'en-tête
        $sheet->mergeCells('A1:E1');
        $sheet->mergeCells('A2:E2');
        $sheet->mergeCells('A3:E3');
        
        $sheet->getStyle('A1:E5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:E1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2:E3')->getFont()->setBold(true);
        $sheet->getStyle('A5:E5')->getFont()->setBold(true);
        
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD9D9D9');
            
        $sheet->getStyle('A5:E5')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFEEEEEE');

        // Style pour les cellules de contenu
        $sheet->getStyle('A6:E100')->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center')
            ->setWrapText(true);

        // Bordures
        $sheet->getStyle('A5:E100')->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
        ];
    }
}
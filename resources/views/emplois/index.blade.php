
@php
    use Carbon\Carbon;

    $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

    $creneaux = [
        '08:30-10:30',
        '10:30-12:30',
        '14:30-16:30',
        '16:30-18:30',
    ];
@endphp

@extends('layouts.master')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h1 class="mb-4 text-center">Emploi du temps</h1>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filtres</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('emplois.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="filiere_id" class="form-label">Filière</label>
                    <select class="form-select" id="filiere_id" name="filiere_id">
                        <option value="">Toutes les filières</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id_filiere }}" {{ $filiere_id == $filiere->id_filiere ? 'selected' : '' }}>
                                {{ $filiere->nom_filiere }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="groupe_id" class="form-label">Groupe</label>
                    <select class="form-select" id="groupe_id" name="groupe_id" {{ !$filiere_id ? 'disabled' : '' }}>
                        <option value="">Tous les groupes</option>
                        @if($filiere_id)
                            @foreach($groupes as $groupe)
                                <option value="{{ $groupe->id_groupe }}" {{ $groupe_id == $groupe->id_groupe ? 'selected' : '' }}>
                                    {{ $groupe->nom_groupe }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="semestre_id" class="form-label">Semestre</label>
                    <select class="form-select" id="semestre_id" name="semestre_id">
                        <option value="">Tous les semestres</option>
                        @foreach($semestres as $semestre)
                            <option value="{{ $semestre->id_semestre }}" {{ $semestre_id == $semestre->id_semestre ? 'selected' : '' }}>
                                {{ $semestre->nom_semestre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-2">Filtrer</button>
                    <a href="{{ route('emplois.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('emplois.ajouter', [
                'filiere_id' => $filiere_id ?? null,
                'groupe_id' => $groupe_id ?? null,
                'semestre_id' => $semestre_id ?? null
            ]) }}" class="btn btn-primary mb-4">
                Ajouter un emploi
            </a>
            @if($filiere_id && $groupe_id && $semestre_id)
                <form action="{{ route('emplois.exporter') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="filiere_id" value="{{ $filiere_id }}">
                    <input type="hidden" name="groupe_id" value="{{ $groupe_id }}">
                    <input type="hidden" name="semestre_id" value="{{ $semestre_id }}">
                    <button type="submit" class="btn btn-success mb-4 ms-2">
                    </button>
                </form>
            @endif
        </div>
        @if($filiere_id || $groupe_id || $semestre_id)
            <div class="alert alert-info mb-0">
                Filtres actifs : 
                @if($filiere_id) Filière: {{ $filieres->firstWhere('id_filiere', $filiere_id)->nom_filiere }} @endif
                @if($groupe_id) | Groupe: {{ $selectedGroupe ? $selectedGroupe->nom_groupe : 'Non spécifié' }} @endif
                @if($semestre_id) | Semestre: {{ $semestres->firstWhere('id_semestre', $semestre_id)->nom_semestre }} @endif
            </div>
        @endif   
            @if($filiere_id && $groupe_id && $semestre_id)
        <form action="{{ route('emplois.exporter') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="filiere_id" value="{{ $filiere_id }}">
            <input type="hidden" name="groupe_id" value="{{ $groupe_id }}">
            <input type="hidden" name="semestre_id" value="{{ $semestre_id }}">
            <button type="submit" class="btn btn-success mb-4 ms-2">
                <i class="fas fa-file-excel me-2"></i> Exporter en Excel
            </button>
        </form>
    @endif 
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Jours</th>
                    @foreach ($creneaux as $creneau)
                        <th>{{ $creneau }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($jours as $jour)
                    <tr>
                        <td><strong>{{ ucfirst($jour) }}</strong></td>
                        @foreach ($creneaux as $creneau)
                            @php
                                [$debut, $fin] = explode('-', $creneau);
                                $seance = $seances->first(function($s) use ($jour, $debut, $fin) {
                                    return $s->jour === $jour &&
                                           Carbon::parse($s->debut)->format('H:i') === $debut &&
                                           Carbon::parse($s->fin)->format('H:i') === $fin;
                                });
                            @endphp

                            <td>
                                @if ($seance)
                                    <span class="badge bg-info text-dark mb-1">{{ $seance->type_seance }}</span><br>
                                    <strong>{{ $seance->module->nom_module ?? 'Module inconnu' }}</strong><br>
                                    <small>Salle : {{ $seance->salle->nom_salle ?? $seance->id_salle }}</small><br>
                                    <small>Prof : {{ $seance->enseignant->name ?? 'Inconnu' }}</small><br>
                                    <small> {{ $seance->groupe->nom_groupe }}</small><br>
                                    <div class="mt-2">
                                        <a href="{{ route('emplois.edit', $seance->id_seance) }}" class="btn btn-sm btn-warning">Modifier</a>
                                        <form action="{{ route('emplois.destroy', $seance->id_seance) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette séance ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filiereSelect = document.getElementById('filiere_id');
    const groupeSelect = document.getElementById('groupe_id');

    filiereSelect.addEventListener('change', function() {
        if (this.value) {
            groupeSelect.disabled = false;
            this.form.submit();
        } else {
            groupeSelect.disabled = true;
            groupeSelect.value = '';
            this.form.submit();
        }
    });
});
</script>
@endsection
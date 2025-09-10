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

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Consulter les emplois du temps</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('emplois.rechercher') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="filiere" class="form-label">Filière</label>
                        <select class="form-select" id="filiere" name="filiere" required>
                            <option value="">Choisir une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id_filiere }}" {{ old('filiere') == $filiere->id_filiere ? 'selected' : '' }}>{{ $filiere->nom_filiere }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="groupe" class="form-label">Groupe</label>
                        <select class="form-select" id="groupe" name="groupe" required>
                            <option value="">Choisir un groupe</option>
                            @if(old('filiere') && isset($groupes))
                                @foreach($groupes as $groupe)
                                    <option value="{{ $groupe->id_groupe }}" {{ old('groupe') == $groupe->id_groupe ? 'selected' : '' }}>{{ $groupe->nom_groupe }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="semestre" class="form-label">Semestre</label>
                        <select class="form-select" id="semestre" name="semestre" required>
                            <option value="">Choisir un semestre</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre->id_semestre }}" {{ old('semestre') == $semestre->id_semestre ? 'selected' : '' }}>{{ $semestre->nom_semestre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-search me-2"></i> Consulter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(isset($seances) && $seances->isNotEmpty() && isset($filiere_id) && isset($groupe_id) && isset($semestre_id))
    <div class="mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="mb-0">Emploi du temps pour : Filière {{ $filieres->firstWhere('id_filiere', $filiere_id)->nom_filiere ?? 'Inconnue' }} -  {{ $groupes->firstWhere('id_groupe', $groupe_id)->nom_groupe ?? 'Inconnu' }} -  {{ $semestres->firstWhere('id_semestre', $semestre_id)->nom_semestre ?? 'Inconnu' }}</h2>
            <form action="{{ route('emplois.exporter') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="filiere_id" value="{{ $filiere_id }}">
                <input type="hidden" name="groupe_id" value="{{ $groupe_id }}">
                <input type="hidden" name="semestre_id" value="{{ $semestre_id }}">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-file-excel me-2"></i> Exporter en Excel
                </button>
            </form>
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
                                        return strtolower($s->jour) === strtolower($jour) &&
                                               Carbon::parse($s->debut)->format('H:i') === trim($debut) &&
                                               Carbon::parse($s->fin)->format('H:i') === trim($fin);
                                    });
                                @endphp
                                <td>
                                    @if ($seance)
                                        <span class="badge bg-info text-dark mb-1">{{ $seance->type_seance }}</span><br>
                                        <strong>{{ $seance->module->nom_module ?? 'Module inconnu' }}</strong><br>
                                        <small>Salle : {{ $seance->salle->nom_salle ?? $seance->id_salle }}</small><br>
                                        <small>Prof : {{ $seance->enseignant->name ?? 'Inconnu' }}</small><br>
                                        <small>{{ $seance->groupe->nom_groupe ?? 'Inconnu' }}</small>
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
    @elseif(isset($seances) && $seances->isEmpty())
    <div class="alert alert-info mt-4">
        Aucun emploi du temps trouvé pour cette sélection.
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filiereSelect = document.getElementById('filiere');
    const groupeSelect = document.getElementById('groupe');

    filiereSelect.addEventListener('change', function() {
        const filiereId = this.value;
        groupeSelect.innerHTML = '<option value="">Choisir un groupe</option>';

        if (filiereId) {
            fetch(`/api/groupes?filiere_id=${filiereId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(groupe => {
                        const option = document.createElement('option');
                        option.value = groupe.id_groupe;
                        option.textContent = groupe.nom_groupe;
                        groupeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des groupes:', error));
        }
    });
});
</script>
@endsection
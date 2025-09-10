@extends('layouts.master')
@section('main')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i> Ajouter un nouvel emploi du temps</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('emplois.ajouter') }}">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="filiere_id" class="form-label">Filière</label>
                        <select class="form-select" id="filiere_id" name="filiere_id" required>
                            <option value="">Choisir une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id_filiere }}" {{ $filiere_id == $filiere->id_filiere ? 'selected' : '' }}>
                                    {{ $filiere->nom_filiere }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="groupe_id" class="form-label">Groupe</label>
                        <select class="form-select" id="groupe_id" name="groupe_id" required {{ !$filiere_id ? 'disabled' : '' }}>
                            <option value="">Choisir un groupe</option>
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
                        <select class="form-select" id="semestre_id" name="semestre_id" required>
                            <option value="">Choisir un semestre</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre->id_semestre }}" {{ $semestre_id == $semestre->id_semestre ? 'selected' : '' }}>
                                    {{ $semestre->nom_semestre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center">
                </div>
            </form>

            @if(isset($filiere_id) && isset($groupe_id) && isset($semestre_id))
            <hr class="my-4">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> 
                Vous éditez l'emploi du temps pour : 
                <strong>{{ $groupe->nom_groupe ?? 'Groupe inconnu' }}</strong> - 
                Semestre <strong>{{ $semestres->firstWhere('id_semestre', $semestre_id)->nom_semestre ?? 'Inconnu' }}</strong>
            </div>

            <form action="{{ route('emplois.store') }}" method="POST" id="emploiForm">
                @csrf
                <input type="hidden" name="filiere_id" value="{{ $filiere_id }}">
                <input type="hidden" name="groupe_id" value="{{ $groupe_id }}">
                <input type="hidden" name="semestre_id" value="{{ $semestre_id }}">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Jours</th>
                                <th>8h30-10h30</th>
                                <th>10h30-12h30</th>
                                <th>14h30-16h30</th>
                                <th>16h30-18h30</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi','samedi'] as $jour)
                            <tr>
                                <td class="fw-bold">{{ ucfirst($jour) }}</td>
                                @foreach(['08:30 - 10:30', '10:30 - 12:30', '14:30 - 16:30', '16:30 - 18:30'] as $plage)
                                @php
                                    $seanceExistante = null;
                                    if (isset($emploiExistants[$jour]) && isset($emploiExistants[$jour][$plage])) {
                                        $seanceExistante = $emploiExistants[$jour][$plage]->first();
                                    }
                                @endphp
                                <td>
                                    <div class="seance-form">
                                        <select name="seances[{{ $jour }}][{{ $plage }}][module_id]" class="form-select form-select-sm mb-1">
                                            <option value="">Module</option>
                                            @foreach($modules as $module)
                                                <option value="{{ $module->id_module }}"
                                                    {{ $seanceExistante && $seanceExistante->id_module == $module->id_module ? 'selected' : '' }}>
                                                    {{ $module->nom_module }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="seances[{{ $jour }}][{{ $plage }}][salle_id]" class="form-select form-select-sm mb-1">
                                            <option value="">Salle</option>
                                            @foreach($salles as $salle)
                                                <option value="{{ $salle->id_salle }}"
                                                    {{ $seanceExistante && $seanceExistante->id_salle == $salle->id_salle ? 'selected' : '' }}>
                                                    {{ $salle->nom_salle }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="seances[{{ $jour }}][{{ $plage }}][type_seance]" class="form-select form-select-sm mb-1">
                                            <option value="Cours" {{ $seanceExistante && $seanceExistante->type_seance == 'Cours' ? 'selected' : '' }}>Cours</option>
                                            <option value="TD" {{ $seanceExistante && $seanceExistante->type_seance == 'TD' ? 'selected' : '' }}>TD</option>
                                            <option value="TP" {{ $seanceExistante && $seanceExistante->type_seance == 'TP' ? 'selected' : '' }}>TP</option>
                                        </select>
                                        <select name="seances[{{ $jour }}][{{ $plage }}][user_id]" class="form-select form-select-sm">
                                            <option value="">Enseignant</option>
                                            @foreach($enseignants as $enseignant)
                                                <option value="{{ $enseignant->id }}"
                                                    {{ $seanceExistante && $seanceExistante->user_id == $enseignant->id ? 'selected' : '' }}>
                                                    {{ $enseignant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('emplois.index') }}" class="btn btn-secondary px-4 ms-2">
                        <i class="fas fa-times me-2"></i> Annuler
                    </a>
                </div>
            </form>
            @endif
        </div>
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
            this.form.submit();
        }
    });

    document.getElementById('groupe_id').addEventListener('change', function() {
        this.form.submit();
    });

    document.getElementById('semestre_id').addEventListener('change', function() {
        this.form.submit();
    });
});
</script>
@endsection

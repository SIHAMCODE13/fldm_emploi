@extends('layouts.master')
@section('main')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une séance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Modifier une séance</h1>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Détails de la séance</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('emplois.update', $seance->id_seance) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type_seance" class="form-label">Type de séance</label>
                        <select class="form-select @error('type_seance') is-invalid @enderror" id="type_seance" name="type_seance">
                            <option value="Cours" {{ $seance->type_seance == 'Cours' ? 'selected' : '' }}>Cours</option>
                            <option value="TD" {{ $seance->type_seance == 'TD' ? 'selected' : '' }}>TD</option>
                            <option value="TP" {{ $seance->type_seance == 'TP' ? 'selected' : '' }}>TP</option>
                        </select>
                        @error('type_seance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_module" class="form-label">Module</label>
                        <select class="form-select @error('id_module') is-invalid @enderror" id="id_module" name="id_module">
                            <option value="">Sélectionner un module</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id_module }}" {{ $seance->id_module == $module->id_module ? 'selected' : '' }}>
                                    {{ $module->nom_module }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_module')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_salle" class="form-label">Salle</label>
                        <select class="form-select @error('id_salle') is-invalid @enderror" id="id_salle" name="id_salle">
                            <option value="">Sélectionner une salle</option>
                            @foreach($salles as $salle)
                                <option value="{{ $salle->id_salle }}" {{ $seance->id_salle == $salle->id_salle ? 'selected' : '' }}>
                                    {{ $salle->nom_salle }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_salle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Enseignant</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="">Sélectionner un enseignant</option>
                            @foreach($enseignants as $enseignant)
                                <option value="{{ $enseignant->id }}" {{ $seance->user_id == $enseignant->id ? 'selected' : '' }}>
                                    {{ $enseignant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <a href="{{ route('emplois.index', [
                            'filiere_id' => $seance->id_filiere,
                            'groupe_id' => $seance->id_groupe,
                            'semestre_id' => $seance->id_semestre
                        ]) }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
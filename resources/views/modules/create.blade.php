@extends('layouts.master')
@section('main')
<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h4 class="mb-0">
                <i class="fas fa-book me-2 text-primary"></i>Ajouter un nouveau module
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('modules.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom_module" class="form-label">Nom du module</label>
                        <input type="text" class="form-control" id="nom_module" name="nom_module" required>
                        @error('nom_module')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="id_filiere" class="form-label">Filière</label>
                        <select class="form-select" id="id_filiere" name="id_filiere" required>
                            <option value="">Sélectionnez une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id_filiere }}">{{ $filiere->nom_filiere }}</option>
                            @endforeach
                        </select>
                        @error('id_filiere')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="id_semestre" class="form-label">Semestre</label>
                        <select class="form-select" id="id_semestre" name="id_semestre" required>
                            <option value="">Sélectionnez un semestre</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre->id_semestre }}">Semestre {{ $semestre->numero_semestre ?? $semestre->id_semestre }}</option>
                            @endforeach
                        </select>
                        @error('id_semestre')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('modules.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
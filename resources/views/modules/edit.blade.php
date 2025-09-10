@extends('layouts.master')
@section('main')
<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h4 class="mb-0">
                <i class="fas fa-edit me-2 text-primary"></i>Modifier le module
            </h4>
        </div>
        <div class="card-body">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius:8px;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

            <form action="{{ route('modules.update', $module->id_module) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom_module" class="form-label">Nom du module</label>
                        <input type="text" class="form-control" id="nom_module" name="nom_module" 
                               value="{{ old('nom_module', $module->nom_module) }}" required>
                        @error('nom_module')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="id_filiere" class="form-label">Filière</label>
                        <select class="form-select" id="id_filiere" name="id_filiere" required>
                            <option value="">Sélectionnez une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id_filiere }}" 
                                    {{ $module->id_filiere == $filiere->id_filiere ? 'selected' : '' }}>
                                    {{ $filiere->nom_filiere }}
                                </option>
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
                                <option value="{{ $semestre->id_semestre }}" 
                                    {{ $module->id_semestre == $semestre->id_semestre ? 'selected' : '' }}>
                                    Semestre {{ $semestre->numero_semestre ?? $semestre->id_semestre }}
                                </option>
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
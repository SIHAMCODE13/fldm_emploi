@extends('layouts.master')
@section('main')
<div class="content">
    <div class="card border-0" style="
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #5c6bc0;
    ">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0 py-3" style="
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        ">
            <h4 class="mb-0" style="color: #1a237e; font-weight: 600;">
                <i class="fas fa-edit me-2" style="color: #5c6bc0;"></i>Modifier la Filière
            </h4>
            <a href="{{ route('filieres.index') }}" class="btn btn-secondary btn-sm px-3 py-2" style="
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.3s ease;
            ">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('filieres.update', $filiere->id_filiere) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom_filiere" class="form-label" style="color: #1a237e; font-weight: 500;">Nom de la filière <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nom_filiere') is-invalid @enderror" 
                           id="nom_filiere" name="nom_filiere" 
                           value="{{ old('nom_filiere', $filiere->nom_filiere) }}" required style="border-radius: 8px;">
                    @error('nom_filiere')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_departement" class="form-label" style="color: #1a237e; font-weight: 500;">Département <span class="text-danger">*</span></label>
                    <select class="form-select @error('id_departement') is-invalid @enderror" 
                            id="id_departement" name="id_departement" required style="border-radius: 8px;">
                        <option value="">Sélectionnez un département</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id_departement }}" 
                                    {{ old('id_departement', $filiere->id_departement) == $departement->id_departement ? 'selected' : '' }}>
                                {{ $departement->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_departement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-4 py-2" style="
                        background-color: #5c6bc0;
                        border: none;
                        border-radius: 8px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    ">
                        <i class="fas fa-save me-1" style="color: #fff;"></i> Enregistrer
                    </button>
                    <a href="{{ route('filieres.index') }}" class="btn btn-secondary px-4 py-2" style="
                        border-radius: 8px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    ">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 12px;
        border: none;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
    }
    .btn-primary {
        background-color: #5c6bc0;
        border: none;
    }
    .btn-primary:hover {
        background-color: #3949ab;
    }
    .btn-secondary {
        background-color: #fff;
        color: #6c757d;
        border: 1px solid #6c757d;
    }
    .btn-secondary:hover {
        background-color: #e9ecef;
        color: #495057;
    }
</style>
@endsection
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
                <i class="fas fa-plus-circle me-2" style="color: #5c6bc0;"></i>Créer une nouvelle filière
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('filieres.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nom_filiere" class="form-label" style="color: #1a237e; font-weight: 500;">Nom de la filière</label>
                    <input type="text" class="form-control @error('nom_filiere') is-invalid @enderror" 
                           id="nom_filiere" name="nom_filiere" required style="border-radius: 8px;">
                    @error('nom_filiere')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_departement" class="form-label" style="color: #1a237e; font-weight: 500;">Département</label>
                    <select class="form-select @error('id_departement') is-invalid @enderror" 
                            id="id_departement" name="id_departement" required style="border-radius: 8px;">
                        <option value="">Sélectionnez un département</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id_departement }}">
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
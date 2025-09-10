@extends('layouts.master')
@section('main')
<div class="container py-4">
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
                <i class="fas fa-plus-circle me-2" style="color: #5c6bc0;"></i>Créer un nouveau département
            </h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('departements.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nom" class="form-label" style="color: #1a237e; font-weight: 500;">Nom du département</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                           id="nom" name="nom" value="{{ old('nom') }}" required style="border-radius: 8px;">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="responsable" class="form-label" style="color: #1a237e; font-weight: 500;">Responsable</label>
                    <select class="form-select @error('responsable') is-invalid @enderror" 
                            id="responsable" name="responsable" required style="border-radius: 8px;">
                        <option value="" disabled selected>Sélectionnez un professeur</option>
                        @foreach ($professors as $professor)
                            <option value="{{ $professor->name }}" {{ old('responsable') == $professor->name ? 'selected' : '' }}>
                                {{ $professor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('responsable')
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
                    <a href="{{ route('departements.index') }}" class="btn btn-secondary px-4 py-2" style="
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
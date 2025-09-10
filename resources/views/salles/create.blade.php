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
            <div>
                <h4 class="mb-0" style="color: #1a237e; font-weight: 600;">
                    <i class="fas fa-plus-circle me-2" style="color: #5c6bc0;"></i>Créer une nouvelle salle
                </h4>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('salles.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nom_salle" class="form-label" style="color: #1a237e; font-weight: 500;">Nom de la salle</label>
                    <input type="text" class="form-control @error('nom_salle') is-invalid @enderror" 
                           id="nom_salle" name="nom_salle" value="{{ old('nom_salle') }}" required
                           style="border-radius: 8px; border-color: #e0e0e0;">
                    @error('nom_salle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="capacite" class="form-label" style="color: #1a237e; font-weight: 500;">Capacité</label>
                    <input type="number" class="form-control @error('capacite') is-invalid @enderror" 
                           id="capacite" name="capacite" value="{{ old('capacite') }}" min="1" required
                           style="border-radius: 8px; border-color: #e0e0e0;">
                    @error('capacite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label" style="color: #1a237e; font-weight: 500;">Type de salle</label>
                    <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required
                            style="border-radius: 8px; border-color: #e0e0e0;">
                        <option value="">Sélectionnez un type</option>
                        <option value="Amphithéâtre" {{ old('type') == 'Amphithéâtre' ? 'selected' : '' }}>Amphithéâtre</option>
                        <option value="Salle de cours" {{ old('type') == 'Salle de cours' ? 'selected' : '' }}>Salle de cours</option>
                        <option value="Laboratoire" {{ old('type') == 'Laboratoire' ? 'selected' : '' }}>Laboratoire</option>
                        <option value="Salle informatique" {{ old('type') == 'Salle informatique' ? 'selected' : '' }}>Salle informatique</option>
                        <option value="Salle de réunion" {{ old('type') == 'Salle de réunion' ? 'selected' : '' }}>Salle de réunion</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="disponibilite" class="form-label" style="color: #1a237e; font-weight: 500;">Disponibilité</label>
                    <select class="form-select @error('disponibilite') is-invalid @enderror" 
                            id="disponibilite" name="disponibilite" required
                            style="border-radius: 8px; border-color: #e0e0e0;">
                        <option value="1" {{ old('disponibilite') == '1' ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ old('disponibilite') == '0' ? 'selected' : '' }}>Occupée</option>
                    </select>
                    @error('disponibilite')
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
                    "
                    onmouseover="this.style.backgroundColor='#455a9d'" 
                    onmouseout="this.style.backgroundColor='#5c6bc0'">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                    <a href="{{ route('salles.index') }}" class="btn btn-secondary px-4 py-2" style="
                        background-color: #e0e0e0;
                        color: #424242;
                        border-radius: 8px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    "
                    onmouseover="this.style.backgroundColor='#d5d5d5'" 
                    onmouseout="this.style.backgroundColor='#e0e0e0'">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
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
                    <i class="fas fa-edit me-2" style="color: #5c6bc0;"></i>Modifier la salle : {{ $salle->nom_salle }}
                </h4>
            </div>
            <a href="{{ route('salles.index') }}" class="btn btn-sm px-3 py-2" style="
                background-color: #e0e0e0;
                color: #424242;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.3s ease;
            "
            onmouseover="this.style.backgroundColor='#d5d5d5'" 
            onmouseout="this.style.backgroundColor='#e0e0e0'">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
        </div>

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" style="
                    border-radius: 8px;
                    background-color: #ffebee;
                    color: #c62828;
                    border: none;
                ">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Erreurs :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('salles.update', $salle->id_salle) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom_salle" class="form-label" style="color: #1a237e; font-weight: 500;">Nom de la salle *</label>
                            <input type="text" class="form-control @error('nom_salle') is-invalid @enderror" 
                                   id="nom_salle" name="nom_salle" 
                                   value="{{ old('nom_salle', $salle->nom_salle) }}" 
                                   style="border-radius: 8px; border-color: #e0e0e0;"
                                   required>
                            @error('nom_salle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacite" class="form-label" style="color: #1a237e; font-weight: 500;">Capacité *</label>
                            <input type="number" class="form-control @error('capacite') is-invalid @enderror" 
                                   id="capacite" name="capacite" 
                                   value="{{ old('capacite', $salle->capacite) }}" 
                                   min="1" 
                                   style="border-radius: 8px; border-color: #e0e0e0;"
                                   required>
                            @error('capacite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="disponibilite" class="form-label" style="color: #1a237e; font-weight: 500;">Disponibilité *</label>
                            <select class="form-select @error('disponibilite') is-invalid @enderror" 
                                    id="disponibilite" name="disponibilite" 
                                    style="border-radius: 8px; border-color: #e0e0e0;"
                                    required>
                                <option value="1" {{ old('disponibilite', $salle->disponibilite) == 1 ? 'selected' : '' }}>Disponible</option>
                                <option value="0" {{ old('disponibilite', $salle->disponibilite) == 0 ? 'selected' : '' }}>Occupée</option>
                            </select>
                            @error('disponibilite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
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
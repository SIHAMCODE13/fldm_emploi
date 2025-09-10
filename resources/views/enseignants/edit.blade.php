@extends('layouts.master')
@section('main')
<div class="container">
    <div class="card shadow-sm" style="
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
                    <i class="fas fa-edit me-2" style="color: #5c6bc0;"></i> Modifier Enseignant
                </h4>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('enseignants.update', $enseignant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label" style="color: #1a237e; font-weight: 500;">Nom</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $enseignant->name) }}" required
                               style="border-radius: 8px; border-color: #e0e0e0;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label" style="color: #1a237e; font-weight: 500;">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $enseignant->email) }}" required
                               style="border-radius: 8px; border-color: #e0e0e0;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label" style="color: #1a237e; font-weight: 500;">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password"
                               style="border-radius: 8px; border-color: #e0e0e0;">
                        <small class="text-muted">Laisser vide pour ne pas modifier</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label" style="color: #1a237e; font-weight: 500;">Confirmation</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation"
                               style="border-radius: 8px; border-color: #e0e0e0;">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('enseignants.index') }}" class="btn btn-secondary px-4 py-2" style="
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
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
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
                    <i class="fas fa-chalkboard-teacher me-2" style="color: #5c6bc0;"></i>Ajouter un enseignant
                </h4>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('enseignants.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required
                                   style="border-radius: 8px; border-color: #e0e0e0;">
                            <label for="name" style="color: #1a237e; font-weight: 500;">Nom complet</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required
                                   style="border-radius: 8px; border-color: #e0e0e0;">
                            <label for="email" style="color: #1a237e; font-weight: 500;">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required
                                   style="border-radius: 8px; border-color: #e0e0e0;">
                            <label for="password" style="color: #1a237e; font-weight: 500;">Mot de passe</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required
                                   style="border-radius: 8px; border-color: #e0e0e0;">
                            <label for="password_confirmation" style="color: #1a237e; font-weight: 500;">Confirmer le mot de passe</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
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
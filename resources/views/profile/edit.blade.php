@extends('layouts.master')
@section('main')
<div class="content">
    <div class="card border-0" style="border-left: 4px solid #5c6bc0;">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h4 class="mb-0 text-primary">
                <i class="fas fa-user-circle me-2"></i>Mon Profil
            </h4>
            <div class="badge bg-primary rounded-pill">
                {{ Auth::user()->role->nom ??  'Utilisateur' }}
            </div>




        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex align-items-center mb-4">
                <div class="me-4">
                    <img src="{{ asset('images/default-avatar.png') }}" 
                         class="rounded-circle" 
                         width="80" 
                         height="80"
                         style="object-fit: cover; border: 3px solid #5c6bc0;"
                         alt="Avatar">
                </div>
                <div>
                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   placeholder="Nom complet">
                            <label for="name" class="text-muted">Nom complet</label>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   placeholder="Adresse email">
                            <label for="email" class="text-muted">Adresse email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h6 class="mb-0 text-primary">
                            <i class="fas fa-lock me-2"></i>Changer le mot de passe
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-floating position-relative">
                                <input type="password" 
                                       class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" 
                                       name="current_password"
                                       placeholder="Mot de passe actuel">
                                <label for="current_password" class="text-muted">Mot de passe actuel</label>
                                <i class="fas fa-eye position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                                   style="cursor: pointer;"
                                   onclick="togglePasswordVisibility('current_password', this)"></i>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">Nécessaire seulement pour modifier le mot de passe ou l'email</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating position-relative">
                                    <input type="password" 
                                           class="form-control @error('new_password') is-invalid @enderror" 
                                           id="new_password" 
                                           name="new_password"
                                           placeholder="Nouveau mot de passe">
                                    <label for="new_password" class="text-muted">Nouveau mot de passe</label>
                                    <i class="fas fa-eye position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                                       style="cursor: pointer;"
                                       onclick="togglePasswordVisibility('new_password', this)"></i>
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating position-relative">
                                    <input type="password" 
                                           class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                           id="new_password_confirmation" 
                                           name="new_password_confirmation"
                                           placeholder="Confirmez le mot de passe">
                                    <label for="new_password_confirmation" class="text-muted">Confirmation</label>
                                    <i class="fas fa-eye position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                                       style="cursor: pointer;"
                                       onclick="togglePasswordVisibility('new_password_confirmation', this)"></i>
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
@endsection
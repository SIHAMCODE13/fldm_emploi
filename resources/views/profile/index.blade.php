@extends('layouts.master')
@section('main')
<div class="content">
    <div class="card border-0" style="border-left: 4px solid #5c6bc0;">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h4 class="mb-0 text-primary">
                <i class="fas fa-user-circle me-2"></i>Mon Profil
            </h4>
            <div class="badge bg-primary rounded-pill">
                {{ Auth::user()->role->nom ?? 'Utilisateur' }}
            </div>
        </div>

        <div class="card-body">
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

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h6 class="mb-0 text-primary">
                                <i class="fas fa-info-circle me-2"></i>Informations Personnelles
                            </h6>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 text-muted">Nom complet</dt>
                                <dd class="col-sm-7">{{ Auth::user()->name }}</dd>

                                <dt class="col-sm-5 text-muted">Email</dt>
                                <dd class="col-sm-7">{{ Auth::user()->email }}</dd>

                                <dt class="col-sm-5 text-muted">Rôle</dt>
                                <dd class="col-sm-7">{{ Auth::user()->role->nom ?? 'Non défini' }}</dd>

                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h6 class="mb-0 text-primary">
                                <i class="fas fa-shield-alt me-2"></i>Sécurité
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Mot de passe</span>
                                    <span class="badge bg-secondary">Défini</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>

                            <div class="alert alert-light border mt-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    <small class="text-muted">
                                        Dernière mise à jour du mot de passe: 
{{ Auth::user()->updated_at ? Auth::user()->updated_at->diffForHumans() : 'Jamais mis à jour' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">
                    <i class="fas fa-edit me-1"></i> Modifier le profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
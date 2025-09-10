@extends('layouts.master')
@section('main')

<style>
    .main-content {
        margin-left: var(--sidebar-width);
        padding: 2rem;
        min-height: calc(100vh - 70px);
        background-color: #f5f7fa;
    }
    
    .stat-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        padding: 1.75rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        height: 100%;
        border: none;
        position: relative;
        overflow: hidden;
        border-left: 4px solid var(--accent-color);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        background: var(--card-hover);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 1.25rem;
        object-fit: contain;
        filter: drop-shadow(0 3px 6px rgba(0,0,0,0.1));
    }
    
    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0.75rem 0;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }
    
    .btn-outline-primary {
        border-color: var(--accent-color);
        color: var(--accent-color);
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        background-color: var(--accent-color);
        color: white;
    }
    
    .btn-primary {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #3949ab;
        border-color: #3949ab;
        transform: translateY(-2px);
    }
    
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        font-weight: 600;
        color: var(--primary-color);
    }
</style>
<!-- Main Content -->
    
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Bienvenue, <span class="text-primary">{{ Auth::user()->name ?? 'Utilisateur' }}</span></h4>
</div>
        
<div class="row g-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card h-100">
            <img src="{{ asset('/images/dep.png') }}" class="stat-icon" alt="Départements" loading="lazy">
            <h5 class="text-muted mb-3">Départements</h5>
            <div class="stat-number">{{ $departements ?? 0 }}</div>
            <a href="{{ route('departements.index') }}" class="btn btn-sm btn-outline-primary mt-2 stretched-link">
                Voir plus <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="stat-card h-100">
            <img src="{{ asset('/images/filiere.png') }}" class="stat-icon" alt="Filières" loading="lazy">
            <h5 class="text-muted mb-3">Filières</h5>
            <div class="stat-number">{{ $filieres ?? 0 }}</div>
            <a href="{{ route('filieres.index') }}" class="btn btn-sm btn-outline-primary mt-2 stretched-link">
                Voir plus <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="stat-card h-100">
            <img src="{{ asset('/images/salle.png') }}" class="stat-icon" alt="Salles" loading="lazy">
            <h5 class="text-muted mb-3">Salles</h5>
            <div class="stat-number">{{ $salles ?? 0 }}</div>
            <a href="{{ route('salles.index') }}" class="btn btn-sm btn-outline-primary mt-2 stretched-link">
                Voir plus <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="stat-card h-100">
            <img src="{{ asset('/images/prof.png') }}" class="stat-icon" alt="Enseignants" loading="lazy">
            <h5 class="text-muted mb-3">Enseignants</h5>
            <div class="stat-number">{{ $enseignants ?? 0 }}</div>
            <a href="{{ route('enseignants.index') }}" class="btn btn-sm btn-outline-primary mt-2 stretched-link">
                Voir plus <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
        
<!-- Section récentes activités -->
<div class="card mt-4 shadow-sm border-0">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Activités récentes</h5>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            @if($activities->isEmpty())
                <div class="list-group-item border-0 py-3 text-center">
                    <small class="text-muted">Aucune activité récente.</small>
                </div>
            @else
                @foreach($activities as $activity)
                    <div class="list-group-item border-0 py-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas {{ $activity['icon'] }}"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <small class="text-muted float-end">{{ $activity['time'] }}</small>
                                <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                <p class="mb-0 small">
                                    <a href="{{ $activity['link'] }}" class="text-decoration-none">{{ $activity['description'] }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
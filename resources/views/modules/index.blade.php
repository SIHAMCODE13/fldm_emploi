@extends('layouts.master')
@section('main')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0 py-3">
            <div>
                <h4 class="mb-0">
                    <i class="fas fa-book me-2 text-primary"></i>Liste des modules
                </h4>
            </div>
            <a href="{{ route('modules.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Nouveau module
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius:8px;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

            <form action="{{ route('modules.index') }}" method="GET" class="mb-4">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="form-control" placeholder="Rechercher par nom">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Filière</th>
                            <th>Semestre</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modules as $module)
                        <tr>
                            <td>{{ $module->id_module }}</td>
                            <td><strong>{{ $module->nom_module }}</strong></td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $module->filiere->nom_filiere ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info text-white">
                                    S{{ $module->semestre->numero_semestre ?? $module->id_semestre }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('modules.edit', $module->id_module) }}" 
                                       class="btn btn-sm btn-outline-primary px-3">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('modules.destroy', $module->id_module) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger px-3"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?')">
                                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-book fa-3x mb-3" style="opacity: 0.3;"></i>
                                <h5>Aucun module enregistré</h5>
                                <p>Commencez par ajouter un nouveau module</p>
                                <a href="{{ route('modules.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-1"></i> Ajouter un module
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($modules->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $modules->links('pagination::simple-bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Style personnalisé pour les boutons d'action */
    .btn-outline-primary, .btn-outline-danger {
        border-width: 1px;
        transition: all 0.2s ease;
    }
    
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
    
    /* Espacement uniforme entre les boutons */
    .gap-2 {
        gap: 0.5rem;
    }
    
    /* Alignement vertical des icônes */
    .btn i {
        vertical-align: middle;
    }
    
    /* Styles modernes pour la pagination */
    .pagination {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        padding-left: 0;
        list-style: none;
    }
    
    .pagination .page-item {
        margin: 0;
    }
    
    .pagination .page-link {
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0.9rem;
        color: #4a5568;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        text-decoration: none;
        background-color: white;
    }
    
    .pagination .page-link:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e0;
        color: #2d3748;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.3);
    }
    
    .pagination .page-item.disabled .page-link {
        color: #a0aec0;
        background-color: #f8f9fa;
        border-color: #e2e8f0;
        pointer-events: none;
    }
</style>
@endsection
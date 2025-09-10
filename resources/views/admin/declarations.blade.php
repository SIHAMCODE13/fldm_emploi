<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Déclarations - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.master')

    @section('main')
    <div class="container-fluid">
        <!-- Messages de notification -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Gestion des Déclarations de Non-Disponibilité
                </h5>
                <span class="badge bg-light text-primary fs-6">
                    {{ $declarations->count() }} déclaration(s) en attente
                </span>
            </div>
            <div class="card-body">
                @if($declarations->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                        <h4 class="text-muted">Aucune déclaration en attente</h4>
                        <p class="text-muted">Toutes les déclarations ont été traitées.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Enseignant</th>
                                    <th>Période</th>
                                    <th>Type</th>
                                    <th>Raison</th>
                                    <th>Date de déclaration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($declarations as $declaration)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle text-primary me-2"></i>
                                                <div>
                                                    <strong>{{ $declaration->enseignant->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $declaration->enseignant->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($declaration->date_debut->format('Y-m-d') === $declaration->date_fin->format('Y-m-d'))
                                                {{ $declaration->date_debut->format('d/m/Y') }}
                                            @else
                                                {{ $declaration->date_debut->format('d/m/Y') }} - {{ $declaration->date_fin->format('d/m/Y') }}
                                            @endif
                                            @if($declaration->periode)
                                                <br>
                                                <small class="text-muted badge bg-info">{{ $declaration->periode }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $declaration->type_periode === 'journee' ? 'bg-primary' : 'bg-secondary' }}">
                                                {{ $declaration->type_periode === 'journee' ? 'Journée complète' : 'Période spécifique' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="{{ $declaration->raison }}">
                                                {{ Str::limit($declaration->raison, 50) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $declaration->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('admin.declaration.update', $declaration->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="statut" value="approuve">
                                                    <button type="submit" class="btn btn-success btn-sm" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir approuver cette déclaration ?')"
                                                            data-bs-toggle="tooltip" title="Approuver">
                                                        <i class="fas fa-check"></i> Accepter
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.declaration.update', $declaration->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="statut" value="rejete">
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette déclaration ?')"
                                                            data-bs-toggle="tooltip" title="Rejeter">
                                                        <i class="fas fa-times"></i> Rejeter
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Activer les tooltips Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
    @endsection
</body>
</html>
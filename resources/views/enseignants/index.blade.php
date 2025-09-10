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
                    <i class="fas fa-chalkboard-teacher me-2" style="color: #5c6bc0;"></i>Gestion des Enseignants
                </h4>
            </div>
            <a href="{{ route('enseignants.create') }}" class="btn btn-primary btn-sm px-3 py-2" style="
                background-color: #5c6bc0;
                border: none;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.3s ease;
            ">
                <i class="fas fa-plus-circle me-1"></i> Nouvel enseignant
            </a>
        </div>

        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" style="
                    border-radius: 8px;
                    background-color: #e8f5e9;
                    color: #2e7d32;
                    border: none;
                ">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Champ de recherche -->
            <div class="mb-4">
                <form action="{{ route('enseignants.index') }}" method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Rechercher par nom..."
                           style="border-radius: 8px; border-color: #e0e0e0;">
                    <button type="submit" class="btn btn-primary" style="
                        background-color: #5c6bc0;
                        border: none;
                        border-radius: 8px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    "
                    onmouseover="this.style.backgroundColor='#455a9d'" 
                    onmouseout="this.style.backgroundColor='#5c6bc0'">
                        <i class="fas fa-search me-1"></i> Rechercher
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f5f7fa;">
                        <tr>
                            <th class="ps-4" style="font-weight: 600; color: #1a237e;">ID</th>
                            <th style="font-weight: 600; color: #1a237e;">Nom</th>
                            <th style="font-weight: 600; color: #1a237e;">Email</th>
                            <th class="text-end pe-4" style="font-weight: 600; color: #1a237e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enseignants as $enseignant)
                            <tr class="align-middle" style="transition: all 0.2s ease;">
                                <td class="ps-4">{{ $enseignant->id }}</td>
                                <td>
                                    <strong>{{ $enseignant->name }}</strong>
                                </td>
                                <td>
                                    <span class="badge py-2 px-3" style="
                                        background-color: #e8eaf6;
                                        color: #1a237e;
                                        border-radius: 6px;
                                        font-weight: 500;
                                    ">
                                        {{ $enseignant->email }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('enseignants.edit', $enseignant->id) }}" 
                                       class="btn btn-sm px-3 py-2 me-2" 
                                       style="
                                           background-color: #e3f2fd;
                                           color: #1565c0;
                                           border-radius: 8px;
                                           font-weight: 500;
                                           transition: all 0.3s ease;
                                       "
                                       onmouseover="this.style.backgroundColor='#bbdefb'" 
                                       onmouseout="this.style.backgroundColor='#e3f2fd'">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('enseignants.destroy', $enseignant->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm px-3 py-2" 
                                                style="
                                                    background-color: #ffebee;
                                                    color: #c62828;
                                                    border-radius: 8px;
                                                    font-weight: 500;
                                                    transition: all 0.3s ease;
                                                "
                                                onmouseover="this.style.backgroundColor='#ffcdd2'" 
                                                onmouseout="this.style.backgroundColor='#ffebee'"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">
                                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5" style="color: #5c6bc0;">
                                    <div style="font-size: 5rem; opacity: 0.3;">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <h5 class="mt-3" style="font-weight: 600;">Aucun enseignant enregistré</h5>
                                    <p class="text-muted">Commencez par ajouter un nouvel enseignant</p>
                                    <a href="{{ route('enseignants.create') }}" class="btn btn-primary mt-2 px-4 py-2">
                                        <i class="fas fa-plus-circle me-1"></i> Ajouter un enseignant
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
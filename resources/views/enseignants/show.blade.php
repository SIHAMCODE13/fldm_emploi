@extends('layouts.master')
@section('main')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-user-tie me-2"></i> Fiche Enseignant
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $enseignant->name }}</h3>
                    <p class="text-muted mb-4">
                        <i class="fas fa-envelope me-2"></i> {{ $enseignant->email }}
                    </p>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>
                <form action="{{ route('enseignants.destroy', $enseignant->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?')">
                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
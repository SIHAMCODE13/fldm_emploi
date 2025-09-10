<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Historique Rattrapages - Enseignant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <style>
    :root {
      --primary-color: #133b85;
      --secondary-color: #1e4a9e;
      --accent-color: #4e73df;
      --light-bg: #f8f9fc;
      --text-dark: #5a5c69;
      --text-light: #858796;
      --success-color: #1cc88a;
      --warning-color: #f6c23e;
      --danger-color: #e74a3b;
    }
    
    body {
      font-family: "Segoe UI", sans-serif;
      background-color: var(--light-bg);
      color: var(--text-dark);
      overflow-x: hidden;
    }

    /* Sidebar */
    #sidebar {
      width: 270px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      z-index: 1000;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-logo {
      text-align: center;
      padding: 20px 15px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-logo img {
      max-width: 160px;
      filter: brightness(0) invert(1);
      transition: transform 0.3s ease;
    }

    .sidebar-logo img:hover {
      transform: scale(1.05);
    }

    .sidebar-item {
      display: flex;
      align-items: center;
      padding: 12px 25px;
      color: rgba(255, 255, 255, 0.85);
      font-size: 15px;
      text-decoration: none;
      transition: all 0.2s ease;
      position: relative;
    }

    .sidebar-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      padding-left: 30px;
    }

    .sidebar-item.active {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      font-weight: 500;
    }

    .sidebar-item.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background-color: white;
    }

    .sidebar-submenu {
      padding-left: 40px;
      font-size: 14px;
    }

    .sidebar-item i {
      width: 20px;
      margin-right: 10px;
      text-align: center;
    }

    .footer-text {
      position: absolute;
      bottom: 15px;
      left: 0;
      width: 100%;
      text-align: center;
      font-size: 12px;
      color: rgba(255, 255, 255, 0.6);
    }

    /* Content */
    #content {
      margin-left: 270px;
      padding: 30px 40px;
      transition: margin-left 0.3s;
      animation: fadeSlide 0.6s ease-in-out;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .topbar {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-bottom: 25px;
      padding: 10px 0;
    }

    .topbar .profil {
      display: flex;
      align-items: center;
      margin-left: 20px;
      padding: 8px 15px;
      background-color: white;
      border-radius: 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      cursor: pointer;
      transition: all 0.2s;
      position: relative;
    }

    .topbar .profil:hover {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .topbar .profil i {
      margin-left: 8px;
      font-size: 18px;
      color: var(--accent-color);
    }

    .profile-dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 10px 0;
      min-width: 180px;
      z-index: 1000;
      display: none;
    }

    .profile-dropdown.show {
      display: block;
    }

    .profile-dropdown-item {
      padding: 8px 15px;
      color: var(--text-dark);
      text-decoration: none;
      display: block;
      transition: background-color 0.2s;
      font-size: 14px;
    }

    .profile-dropdown-item:hover {
      background-color: #f8f9fa;
    }

    .profile-dropdown-divider {
      height: 1px;
      background-color: #e9ecef;
      margin: 5px 0;
    }

    /* Welcome Banner */
    .welcome-box {
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      color: white;
      padding: 20px 25px;
      border-radius: 12px;
      margin-bottom: 30px;
      font-size: 18px;
      font-weight: 500;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Alert Styles */
    .alert {
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 20px;
      border: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
      background-color: rgba(28, 200, 138, 0.2);
      color: var(--success-color);
    }

    .alert-danger {
      background-color: rgba(231, 74, 59, 0.2);
      color: var(--danger-color);
    }

    /* Notification Styles */
    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--danger-color);
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: bold;
    }

    .dropdown-notification {
      max-height: 300px;
      overflow-y: auto;
    }

    .notification-item.unread {
      background-color: rgba(78, 115, 223, 0.1);
    }

    /* Card Styles */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      border-radius: 15px 15px 0 0 !important;
      padding: 15px 20px;
    }

    /* Table Styles */
    .table-responsive {
      border-radius: 0 0 15px 15px;
    }

    .table th {
      border-top: none;
      font-weight: 600;
      color: var(--text-dark);
      background-color: #f8f9fc;
    }

    .badge {
      padding: 8px 12px;
      border-radius: 20px;
      font-weight: 500;
    }

    .badge-en-attente {
      background-color: rgba(246, 194, 62, 0.2);
      color: var(--warning-color);
    }

    .badge-approuve {
      background-color: rgba(28, 200, 138, 0.2);
      color: var(--success-color);
    }

    .badge-rejete {
      background-color: rgba(231, 74, 59, 0.2);
      color: var(--danger-color);
    }

    /* Search and Filter */
    .search-filter-container {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    /* Action buttons */
    .btn-action {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
      #sidebar {
        width: 80px;
        overflow: hidden;
      }
      
      #sidebar .sidebar-logo img {
        max-width: 40px;
      }
      
      #sidebar .sidebar-item span {
        display: none;
      }
      
      #sidebar .sidebar-submenu {
        padding-left: 25px;
      }
      
      #content {
        margin-left: 80px;
        padding: 20px;
      }
    }

    @media (max-width: 768px) {
      #content {
        padding: 15px;
        margin-left: 0;
      }
      
      #sidebar {
        left: -80px;
      }
      
      .topbar {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
<div id="sidebar">
  <div class="sidebar-logo">
            <img src="{{ asset('/images/USMBA (3).png') }}" width="160" alt="Logo FLDM" class="img-fluid" loading="lazy">
  </div>
  <a href="{{ route('enseignant.dashboard') }}" class="sidebar-item {{ request()->routeIs('enseignant.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> <span>Home</span></a>
  <a href="{{ route('enseignant.emplois-temps') }}" class="sidebar-item {{ request()->routeIs('enseignant.emplois-temps') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> <span>Emplois de temps</span></a>
  
  <!-- Menu déroulant pour Non disponibilités -->
  <a href="#non-dispo" class="sidebar-item {{ request()->routeIs('enseignant.declaration*') || request()->routeIs('enseignant.historique') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false">
    <i class="fas fa-book"></i> <span>Non disponibilités</span>
    <i class="fas fa-chevron-down ms-auto"></i>
  </a>
  
  <div class="collapse {{ request()->routeIs('enseignant.declaration*') || request()->routeIs('enseignant.historique') ? 'show' : '' }}" id="non-dispo">
    <a href="{{ route('enseignant.declaration') }}" class="sidebar-item sidebar-submenu {{ request()->routeIs('enseignant.declaration') ? 'active' : '' }}">
      <i class="fas fa-pen"></i> <span>Declaration</span>
    </a>
    <a href="{{ route('enseignant.historique') }}" class="sidebar-item sidebar-submenu {{ request()->routeIs('enseignant.historique') ? 'active' : '' }}">
      <i class="fas fa-history"></i> <span>Historiques</span>
    </a>
  </div>
  
  <!-- Menu déroulant pour Rattrapages -->
  <a href="#rattrapages" class="sidebar-item {{ request()->routeIs('enseignant.rattrapage*') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false">
    <i class="fas fa-calendar-plus"></i> <span>Rattrapages</span>
    <i class="fas fa-chevron-down ms-auto"></i>
  </a>
  
  <div class="collapse {{ request()->routeIs('enseignant.rattrapage*') ? 'show' : '' }}" id="rattrapages">
    <a href="{{ route('enseignant.rattrapage') }}" class="sidebar-item sidebar-submenu {{ request()->routeIs('enseignant.rattrapage') ? 'active' : '' }}">
      <i class="fas fa-pen"></i> <span>Déclaration</span>
    </a>
    <a href="{{ route('enseignant.rattrapage.historique') }}" class="sidebar-item sidebar-submenu {{ request()->routeIs('enseignant.rattrapage.historique') ? 'active' : '' }}">
      <i class="fas fa-history"></i> <span>Historiques</span>
    </a>
  </div>
  
  <div class="footer-text">© FLDM | Tous droits réservés 2025</div>
</div>

<!-- Content -->
<div id="content">
  <!-- Topbar avec notifications -->
  <div class="topbar">
    <!-- Notifications Dropdown -->
    <div class="dropdown me-3">
      <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ auth()->user()->unreadNotifications->count() }}
          </span>
        @endif
      </button>
      <ul class="dropdown-menu dropdown-menu-end dropdown-notification" aria-labelledby="notificationDropdown" style="min-width: 300px;">
        <li><h6 class="dropdown-header">Notifications</h6></li>
        @if(auth()->user()->notifications->count() > 0)
          @foreach(auth()->user()->notifications->take(5) as $notification)
            <li>
              <a class="dropdown-item d-flex align-items-center notification-item {{ $notification->read_at ? '' : 'unread' }}" 
                 href="/enseignant/notification/{{ $notification->id }}/read" 
                 data-notification-id="{{ $notification->id }}">
                <div class="me-2">
                  <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }} text-{{ $notification->data['type'] ?? 'info' }}"></i>
                </div>
                <div class="flex-grow-1">
                  <div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                  <span class="{{ $notification->read_at ? '' : 'fw-bold' }}">
                    {{ $notification->data['message'] }}
                  </span>
                </div>
              </a>
            </li>
          @endforeach
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-center small" href="{{ route('enseignant.historique') }}">Voir toutes les notifications</a></li>
        @else
          <li><span class="dropdown-item text-muted">Aucune notification</span></li>
        @endif
      </ul>
    </div>

    <div class="profil" id="profile-dropdown-trigger">
      {{ auth()->user()->name }} <i class="fas fa-user-circle"></i>
      <div class="profile-dropdown" id="profile-dropdown">
        <a href="{{ route('enseignant.dashboard') }}" class="profile-dropdown-item">
          <i class="fas fa-user me-2"></i> Mon profil
        </a>
        <div class="profile-dropdown-divider"></div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="profile-dropdown-item" style="width: 100%; text-align: left; background: none; border: none;">
            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Messages de notification -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Welcome Banner -->
  <div class="welcome-box">
    <h4>Historique des rattrapages, <span>{{ auth()->user()->name }}</span> </h4>
  </div>

  <!-- Historique des rattrapages -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-white">Historique des Rattrapages</h6>
      <a href="{{ route('enseignant.rattrapage') }}" class="btn btn-light btn-sm">
        <i class="fas fa-plus me-1"></i> Nouveau Rattrapage
      </a>
    </div>
    <div class="card-body">
      <!-- Barre de recherche et filtres -->
      <div class="search-filter-container">
        <form method="GET" action="{{ route('enseignant.rattrapage.historique') }}">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="search" class="form-label">Recherche</label>
              <input type="text" class="form-control" id="search" name="search" 
                     placeholder="Rechercher par module, groupe..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4 mb-3">
              <label for="filter" class="form-label">Statut</label>
              <select class="form-select" id="filter" name="filter">
                <option value="tous" {{ request('filter') == 'tous' ? 'selected' : '' }}>Tous les statuts</option>
                <option value="en_attente" {{ request('filter') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="approuve" {{ request('filter') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                <option value="rejete" {{ request('filter') == 'rejete' ? 'selected' : '' }}>Rejeté</option>
              </select>
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> Filtrer
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Tableau des rattrapages -->
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Période</th>
              <th scope="col">Type</th>
              <th scope="col">Module</th>
              <th scope="col">Groupe</th>
              <th scope="col">Statut</th>
              <th scope="col">Salle</th>
              <th scope="col">Date de demande</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($rattrapages as $rattrapage)
              <tr>
                <td>{{ $rattrapage->date->format('d/m/Y') }}</td>
                <td>{{ $rattrapage->periode }}</td>
                <td>{{ $rattrapage->type_seance }}</td>
                <td>{{ $rattrapage->module }}</td>
                <td>{{ $rattrapage->groupe }}</td>
                <td>
                  @if($rattrapage->statut == 'en_attente')
                    <span class="badge badge-en-attente">En attente</span>
                  @elseif($rattrapage->statut == 'approuve')
                    <span class="badge badge-approuve">Approuvé</span>
                  @else
                    <span class="badge badge-rejete">Rejeté</span>
                  @endif
                </td>
                <td>
                  @if($rattrapage->salle_attribuee)
                    {{ $rattrapage->salle->nom_salle ?? $rattrapage->salle_attribuee }}
                  @else
                    -
                  @endif
                </td>
                <td>{{ $rattrapage->created_at->format('d/m/Y H:i') }}</td>
                <td>
                  @if($rattrapage->statut == 'en_attente')
                    <div class="btn-group" role="group">
                      <a href="{{ route('enseignant.rattrapage.edit', $rattrapage->id) }}" class="btn btn-primary btn-sm btn-action" title="Modifier">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('enseignant.rattrapage.delete', $rattrapage->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-action" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rattrapage ?')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  @else
                    <span class="text-muted">Aucune action</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center py-4">
                  <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                  <p class="text-muted">Aucun rattrapage déclaré</p>
                  <a href="{{ route('enseignant.rattrapage') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Déclarer un rattrapage
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Gestion des notifications
  document.addEventListener('DOMContentLoaded', function() {
    // Gestion du dropdown du profil
    const profileDropdownTrigger = document.getElementById('profile-dropdown-trigger');
    const profileDropdown = document.getElementById('profile-dropdown');
    
    if (profileDropdownTrigger) {
      profileDropdownTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('show');
      });
    }

    // Fermer le dropdown quand on clique ailleurs
    document.addEventListener('click', function(e) {
      if (profileDropdownTrigger && !profileDropdownTrigger.contains(e.target) && profileDropdown && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.remove('show');
      }
    });

    // Marquer les notifications comme lues
    const notificationLinks = document.querySelectorAll('.notification-item');
    notificationLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const notificationId = this.getAttribute('data-notification-id');
        if (notificationId) {
          fetch(`/enseignant/notification/${notificationId}/read`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json'
            }
          });
        }
      });
    });
  });
</script>
</body>
</html>
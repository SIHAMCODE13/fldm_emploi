# 🎓 Gestion des Emplois du Temps — FLDM

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-yellow)
![Status](https://img.shields.io/badge/Status-In_Development-orange)

**Gestion des Emplois du Temps — FLDM** est une application web développée avec Laravel, destinée à faciliter la gestion et l'organisation des emplois du temps universitaires, notamment la planification des cours, la gestion des salles et le suivi des disponibilités des enseignants.


## ✨ Fonctionnalités

- 📅 Gestion et organisation des emplois du temps.
- 👨‍🏫 Gestion des enseignants et de leurs disponibilités.
- 🏫 Gestion des salles de cours et des amphithéâtres.
- 👥 Organisation des groupes et des filières.
- 📄 Export des emplois du temps au format PDF.
- 📊 Export des données au format Excel.
- 🔐 Authentification et gestion des rôles utilisateurs.

*Remarque : les fonctionnalités listées sont celles prévues dans la description du projet et doivent être vérifiées par rapport à l'implémentation actuelle.*

## 🏗️ Architecture du projet

Le projet suit l'architecture MVC (Modèle-Vue-Contrôleur) proposée par Laravel.

```text
fldm_emploi/
├── app/              # Logique métier, modèles et contrôleurs
├── bootstrap/        # Initialisation de l'application
├── config/           # Fichiers de configuration
├── database/         # Migrations, seeders et factories
├── public/           # Point d'entrée et ressources publiques
├── resources/        # Vues et ressources frontend
├── routes/           # Définition des routes
├── storage/          # Journaux et fichiers générés
├── tests/            # Tests automatisés
├── .env.example      # Exemple de configuration
├── artisan           # Interface CLI de Laravel
├── composer.json     # Dépendances PHP
├── package.json      # Dépendances frontend
└── vite.config.js    # Configuration de Vite
```

## 🛠️ Technologies utilisées

| Composant | Technologie |
|---|---|
| Backend | Laravel / PHP |
| Frontend | Blade, Bootstrap et JavaScript, selon l'implémentation |
| Base de données | MySQL |
| Gestion des dépendances PHP | Composer |
| Outils frontend | Node.js, NPM et Vite |
| Tests | PHPUnit / outils de test Laravel |

## 🚀 Installation et exécution

### Prérequis

- PHP et les extensions requises par Laravel
- Composer
- MySQL
- Node.js et NPM

### 1. Cloner le dépôt

```bash
git clone https://github.com/SIHAMCODE13/fldm_emploi.git
cd fldm_emploi
```

### 2. Installer les dépendances

```bash
composer install
npm install
```

### 3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Sous Windows, tu peux également copier `.env.example` vers `.env` depuis l'Explorateur de fichiers ou utiliser PowerShell :

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 4. Configurer la base de données

Crée une base de données MySQL, puis renseigne les paramètres suivants dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fldm_emploi
DB_USERNAME=root
DB_PASSWORD=
```

Adapte les identifiants à ta configuration MySQL.

### 5. Initialiser la base de données

```bash
php artisan migrate
```

Si le projet dispose de seeders adaptés, tu peux également utiliser :

```bash
php artisan migrate --seed
```

### 6. Compiler les ressources frontend

Pour le développement :

```bash
npm run dev
```

### 7. Démarrer l'application

Dans un terminal :

```bash
php artisan serve
```

L'application sera accessible à l'adresse suivante :

http://localhost:8000

## 🗄️ Gestion de la base de données

Exécuter les migrations :

```bash
php artisan migrate
```

Exécuter les migrations et les seeders :

```bash
php artisan migrate --seed
```

Réinitialiser la base de données et exécuter les seeders — **attention, cette commande supprime les tables existantes** :

```bash
php artisan migrate:fresh --seed
```

## 🧪 Tests

Pour exécuter les tests automatisés :

```bash
php artisan test
```

Les tests permettent de vérifier le comportement de l'application, les règles métier, les validations des données et les fonctionnalités couvertes par la suite de tests.

## 👩‍💻 Auteur

**Siham Talbi**

Élève-ingénieure en Intelligence Artificielle et Confiance Numérique.

- GitHub : [SIHAMCODE13](https://github.com/SIHAMCODE13)
- Dépôt du projet : [fldm_emploi](https://github.com/SIHAMCODE13/fldm_emploi)

## 📄 Licence

Le projet peut être distribué sous licence MIT si le dépôt contient effectivement une licence MIT. Vérifie la présence du fichier `LICENSE` avant de conserver cette mention.

---

*Développé par Siham Talbi — Projet de gestion des emplois du temps universitaires.*

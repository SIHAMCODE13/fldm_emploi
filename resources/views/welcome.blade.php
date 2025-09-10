<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Université Sidi Mohamed Ben Abdellah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .header {
            background-color: #003366;
            padding: 10px;
            text-align: center;
        }
        
        .header img {
            height: 80px;
        }
        
        .container {
            display: flex;
            flex: 1;
        }
        
        .left {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        
        .right img {
            max-width: 80%;
            height: auto;
        }
        
        .title-container {
            margin-bottom: 20px;
        }
        
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #003366;
            margin-bottom: 15px;
        }
        
        .sub-title {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 40px;
        }
        
        .buttons-container {
            margin-top: 20px;
        }
        
        .btn-custom {
            display: inline-block;
            padding: 12px 30px;
            background-color: #003366;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        
        .btn-custom:hover {
            background-color: #002244;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3 style="color: white; margin: 0;">جامعة سيدي محمد بن عبد الله بفاس</h3>
        <h4 style="color: white; margin: 5px 0;">كلية الآداب والعلوم الإنسانية - ظهر الهرار</h4>
        <p style="color: white; margin: 5px 0;">Faculté des Lettres et des Sciences Humaines Dhar El Mahraz</p>
        <p style="color: white; margin: 5px 0;">Université Sidi Mohamed Ben Abdellah de Fès</p>
    </div>

    <div class="container">
        <div class="left">
            <div class="title-container">
                <div class="title">Plateforme de gestion des enseignements et emplois de temps</div>
            </div>
            <div class="sub-title">Transformez la gestion manuelle de vos emplois du temps en une gestion automatisée et efficace</div>
            
            <div class="buttons-container">
                <a href="{{ route('login') }}" class="btn-custom">Se connecter</a>
                <a href="{{ route('emplois.consulter1') }}" class="btn-custom">Consulter emploi</a>
            </div>
        </div>
        
        <div class="right">
            <img src="/images/logo.png" alt="Logo Université">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

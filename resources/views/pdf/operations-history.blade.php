<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des opérations</title>
    <style>
        /* General Page Styling */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
            color: #333;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        h1 {
            font-size: 22px;
            font-weight: bold;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        h3 {
            font-size: 16px;
            font-weight: normal;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            padding: 12px 8px;
        }

        td {
            padding: 12px 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Header Styling */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 120px;
            margin-bottom: 10px;
        }

        /* Footer Styling */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .footer img {
            width: 60px;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            body {
                margin: 10px;
            }

            h1 {
                font-size: 18px;
            }

            h2 {
                font-size: 16px;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 8px 5px;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                margin: 5px;
            }

            h1 {
                font-size: 16px;
            }

            h2 {
                font-size: 14px;
            }

            table {
                font-size: 10px;
            }

            th,
            td {
                padding: 6px 4px;
            }
        }
    </style>
</head>

<body>
    <!-- Page Header -->
    <div class="header">
        <img src="{{ public_path('images/fixi.png') }}" alt="Logo">
        <h1>Bonjour, {{ Auth::user()->name }} </h1>
        <h2>Historique de toutes les opérations</h2>
        <p>Ceci est le document détaillé des opérations effectuées sur votre véhicule.</p>
    </div>

    <!-- Operations Table -->
    <table>
        <thead>
            <tr>
                <th>Voiture</th>
                <th>Numéro d'immatriculation</th>
                <th>Catégorie</th>
                <th>Opération</th>
                <th>Garage</th>
                <th>Kilométrage</th>
                <th>Description</th>
                <th>Date d'opération</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operations as $operation)
            <tr>
                <td>{{ $operation->voiture->marque }} {{ $operation->voiture->modele }}</td>
                <td>{{ $operation->voiture->numero_immatriculation }}</td>
                <td>{{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}</td>
                <td>
                    {{
                        $operation->nom === 'Autre' 
                        ? 'Autre' 
                        : ($opers->where('id', $operation->nom)->first()->nom_operation ?? 'N/A')
                    }}
                </td>
                <td>{{ $operation->garage->name ?? 'N/A' }}</td>
                <td>{{ $operation->kilometrage ? $operation->kilometrage . ' KM' : 'N/A' }}</td>
                <td>{{ $operation->description ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($operation->date_operation)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('images/fixi.png') }}" alt="Logo">
        <p>Document généré par MyFIXI | {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
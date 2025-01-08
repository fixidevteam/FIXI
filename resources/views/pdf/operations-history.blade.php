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
            color: #444;
        }

        h1 {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
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
            font-size: 12px;
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
            text-transform: uppercase;
            text-align: center;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Row Hover Effect */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Header Styling */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
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
            width: 50px;
            margin-top: 10px;
        }

        /* Custom Greetings */
        .greeting {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {

            .header h1,
            .header h2 {
                font-size: 18px;
            }

            table {
                font-size: 12px;
            }

            table th,
            table td {
                padding: 6px;
            }
        }

        @media screen and (max-width: 480px) {

            .header h1,
            .header h2 {
                font-size: 16px;
            }

            table {
                font-size: 10px;
            }

            table th,
            table td {
                padding: 4px;
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
        <p>Ceci est le document détaillé des opérations effectuées sur votre véhicules..</p>
    </div>

    <table>
        <thead>
            <tr>
                <th scope="col">voiture</th>
                <th scope="col">Numero d'immatriculation</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Opération</th>
                <th scope="col">Garage</th>
                <th scope="col">Description</th>
                <th scope="col">Date d'opération</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operations as $operation)
            <tr>
                <!-- Catégorie -->
                <td>
                    {{ $operation->voiture->marque}} {{ $operation->voiture->modele}}
                </td>
                <td>
                    {{ $operation->voiture->numero_immatriculation}}
                </td>
                <td>
                    {{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}
                </td>

                <!-- Opération -->
                <td>
                    {{
                        $operation->nom === 'Autre' 
                        ? 'Autre' 
                        : ($opers->where('id', $operation->nom)->first()->nom_operation ?? 'N/A')
                    }}
                </td>

                <!-- Garage -->
                <td>
                    {{ $operation->garage->name ?? 'N/A' }}
                </td>

                <!-- Description -->
                <td>
                    {{ $operation->description ?? 'N/A' }}
                </td>

                <!-- Date d'opération -->
                <td>
                    {{ \Carbon\Carbon::parse($operation->date_operation)->format('d/m/Y') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Operations Table -->

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('images/fixi.png') }}" alt="Logo">
        <p>Document généré par MyFIXI | {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
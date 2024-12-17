<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des opérations</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 10px;
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
            background-color: #f4f4f4;
            color: #555;
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
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Footer Styling */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- Page Header -->
    <div class="header">
        <img src="{{ public_path('images/fixi.png') }}" alt="Logo" style="width: 100px;">

        <h3>Historique des opérations pour le véhicule: {{ $voiture->marque }} {{ $voiture->modele }}</h3>
    </div>

    <!-- Operations Table -->
    <table>
        <thead>
            <tr>
                <th scope="col">Catégorie</th>
                <th scope="col">Opération</th>
                <th scope="col">Garage</th>
                <th scope="col">Description</th>
                <th scope="col">Date d'opération</th>
            </tr>
        </thead>
        <tbody>
            @foreach($voiture->operations as $operation)
            <tr>
                <!-- Catégorie -->
                <td>
                    {{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}
                </td>

                <!-- Opération -->
                <td>
                    {{
                        $operation->nom === 'Autre' 
                        ? 'Autre' 
                        : ($operations->where('id', $operation->nom)->first()->nom_operation ?? 'N/A')
                    }}
                </td>

                <!-- Description -->
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

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('images/fixi.png') }}" alt="Logo" style="width: 50px;">

        <p>Document généré par MyFIXI | {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
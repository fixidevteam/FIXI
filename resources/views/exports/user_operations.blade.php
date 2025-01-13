<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des opérations</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            text-align: left;
            background-color: #f2f2f2;
        }
        .header-logo {
            text-align: center;
            vertical-align: middle;
            height: 100px;
        }
        .header-logo img {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
    <table>
        <caption class="sr-only">Suivi des opérations</caption>
        <thead>
            <tr>
                <th scope="col" colspan="6" class="header-logo">
                    <img src="{{ $logoPath }}" alt="FIXIPRO Logo" width="100">
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="6" style="text-align: center;">Suivi des Opérations</th>
            </tr>
            <tr>
                <th scope="col" colspan="6" style="text-align: center;">
                    Généré par {{ $user->name }} le {{ now()->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <th scope="col">Numero d'immatriculation</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Nom de l'opération</th>
                <th scope="col">Garage</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operations as $operation)
                <tr>
                    <td>{{ $operation->voiture->numero_immatriculation }}</td>
                    <td>{{ $categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}</td>
                    <td>{{ $operation->nom === 'Autre' ? $operation->autre_operation : ($operationsAll->where('id', $operation->nom)->first()->nom_operation ?? 'N/A') }}</td>
                    <td>{{ $garages->where('id', $operation->garage_id)->first()->name ?? 'N/A' }}</td>
                    <td>{{ $operation->date_operation ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
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
        <thead>
            <tr>
                <th colspan="6" class="header-logo">
                    <img src="{{ $logoPath }}" alt="FIXIPRO Logo" width="100">
                </th>
            </tr>
            <tr>
                <th colspan="6" style="text-align: center;">Suivi des Opérations</th>
            </tr>
            <tr>
                <th colspan="6" style="text-align: center;">
                    Généré par {{ $user->name }} le {{ now()->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <th>Numero d'immatriculation</th>
                <th>Catégorie</th>
                <th>Nom de l'opération</th>
                <th>Garage</th>
                <th>Date</th>
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

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        th[colspan] {
            text-align: center;
            background-color: #ffffff;
            border: none;
            padding: 10px 0;
        }
        .header-logo {
            text-align: center;
            vertical-align: middle
        }
        img {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="4" class="header-logo">
                    <img src="{{ $logoPath }}" alt="FIXIPRO Logo" width="100">
                </th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Suivi des opérations</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">
                    Généré par {{ $user->name }} le {{ now()->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">
                    Voiture numero immatriculation : {{ $voiture->numero_immatriculation ?? 'N/A' }}
                </th>
            </tr>
            <tr>
                <th>Date d'opération</th>
                <th>Catégorie opération</th>
                <th>Nom de l'opération</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operations as $operation)
                <tr>
                    <td>{{ $operation->date_operation }}</td>
                    <td>{{ $nom_categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A' }}</td>
                    <td>{{ $operation->nom === 'Autre' ? $operation->autre_operation : ($nom_operations->where('id', $operation->nom)->first()->nom_operation ?? 'N/A') }}</td>
                    <td>{{ $operation->description ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

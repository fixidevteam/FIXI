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
    </style>
</head>
<body>
    <h3>Suivi des opérations</h3>
    <p>Immatricule de voiture: {{ $voiture->numero_immatriculation ?? 'N/A' }}</p>
    <table>
        <thead>
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
                    <td>
                        {{$nom_categories->where('id', $operation->categorie)->first()->nom_categorie ?? 'N/A'}}
                    </td>
                    <td>
                        {{$operation->nom === 'Autre' ? $operation->autre_operation : ($nom_operations->where('id', $operation->nom)->first()->nom_operation ?? 'N/A')}}
                    </td>
                    <td>{{ $operation->description ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <style>
        .facture {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="facture">
        <h1>Facture Payée #{{ $data['numD'] }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data['desM'] }}</td>
                    <td>{{ $data['quantite'] }}</td>
                    <td>{{ $data['PrixU'] }}</td>
                    <td>{{ $data['date'] }}</td>
                </tr>
            </tbody>
        </table>
        <p><strong>Total:</strong> ({{ $data['quantite'] }} x {{ $data['PrixU'] }})</p>
        <p><strong>Status:</strong> {{ $data['status'] }}</p> <!-- Afficher le statut ici -->
    </div>
</body>
</html>

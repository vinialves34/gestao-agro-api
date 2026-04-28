<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Rebanhos por Produtor</title>
    <style>
        body { font-family: DejaVu Sans; }
        h2 { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>

<h1>Relatório de Rebanhos por Produtor</h1>

@foreach($herds as $producer => $items)
    <h2>{{ $producer }}</h2>

    <table>
        <thead>
            <tr>
                <th>Propriedade</th>
                <th>Espécie</th>
                <th>Quantidade</th>
                <th>Finalidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $herd)
                <tr>
                    <td>{{ $herd->property->name }}</td>
                    <td>{{ $herd->species->name }}</td>
                    <td>{{ $herd->quantity }}</td>
                    <td>{{ $herd->purpose }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

</body>
</html>

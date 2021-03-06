<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        tr td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            @foreach ($chunked as $arr)
                <tr>
                    @foreach($arr as $data)
                        <td>
                            <table>
                                <tr><td>Name: {{ $data['name'] }}</td></tr>
                            </table>
                        </td>
                        <td><img src="data:image/svg;base64, {{ base64_encode(QrCode::format('svg')->size(120)->generate(config('app.url').'/users/qrcode/read/'.$data['id'])) }}"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


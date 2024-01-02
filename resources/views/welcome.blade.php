<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Input Data Pengguna</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <form method="POST" action="/store-data">
        @csrf
        <label for="data">Masukkan Data Pengguna:</label>
        <input type="text" id="data" name="data" placeholder="NAMA USIA KOTA">
        <input type="submit" value="Simpan">
        @if (Session::has('message'))
            <script>
                alert("{{ Session::get('message') }}");
            </script>
        @endif

    </form>
</body>

</html>

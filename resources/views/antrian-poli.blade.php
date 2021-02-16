<!DOCTYPE html>
<html lang="en">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" /> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Antrian Poli</title>
</head>
<body>
    <br>
    <h3 class="text-center">ANTRIAN POLI</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-6  text-right">
                <form action="{{ route('antrian') }}" method="post">
                    @csrf
                    <input type="text" name="kunci" value="paru" hidden>
                    <button class="btn btn-warning" type="submit">Poli Paru</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('antrian') }}" method="post">
                    @csrf
                    <input type="text" name="kunci" value="mata" hidden>
                    <button class="btn btn-danger" type="submit">Poli Mata</button>
                </form>
            </div>
        </div>
        <a class="btn btn-dark" href="{{ route('tampil.antrian') }}">TAMPIL</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
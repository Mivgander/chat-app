<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatting app</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="w-100 min-vh-100 bg-gray-200 position-relative">
        <div class="w-100 bg-white py-4 px-6 position-absolute top-50 start-50 translate-middle shadow" style="max-width: 520px; border-radius: 1rem;">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2" style="border-color: #a3a3a3;">
                <h2 class="fw-bold">Zaloguj się</h2>
            </div>
            <div class="w-100 mt-3">
                @if(session()->has('logowanieError'))
                    <div class="border border-1 border-danger bg-red-300 p-2">
                        <span class="fs-7">{{ session('logowanieError') }}</span>
                    </div>
                @endif
                <form action="{{ url('logowanie') }}" method="POST" class="row">
                    @csrf
                    <div class="col-12 mt-3">
                        <label for="formEmail" class="form-label fs-5">Email</label>
                        @if($errors->has('email'))
                            <input type="email" class="form-control is-invalid" id="formEmail" name="email" placeholder="Podaj email" required>
                            <div id="formEmailFeedback" class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @else
                            <input type="email" class="form-control" id="formEmail" name="email" placeholder="Podaj email" required>
                        @endif
                    </div>
                    <div class="col-12 mt-3">
                        <label for="formHaslo" class="form-label fs-5">Hasło</label>
                        @if($errors->has('haslo'))
                            <input type="password" class="form-control is-invalid" id="formHaslo" name="haslo" placeholder="Podaj hasło" required>
                            <div id="formHasloFeedback" class="invalid-feedback">
                                {{ $errors->first('haslo') }}
                            </div>
                        @else
                            <input type="password" class="form-control" id="formHaslo" name="haslo" placeholder="Podaj hasło" required>
                        @endif
                    </div>
                    <div class="col-12 mt-3">
                        <input type="checkbox" class="form-check-input" id="formZapamietaj" name="zapamietaj"><label for="formZapamietaj" class="form-label fs-6 ms-2">Zapamiętaj mnie</label>
                    </div>
                    <div class="col-12 mt-6 d-grid gap-2">
                        <button type="submit" class="btn btn-dark">Zaloguj się</button>
                        <p class="fs-7 mb-0 text-center">Nie masz konta? <a href="{{ url('rejestracja') }}">Zarejestruj się</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

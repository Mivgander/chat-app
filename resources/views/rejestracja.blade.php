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
                <h2 class="fw-bold">Zarejestruj się</h2>
            </div>
            <div class="w-100 mt-3">
                @if(session()->has('zarejestrowano'))
                    <div class="border border-1 border-success bg-green-300 p-2 mb-4">
                        <span class="fs-7">Rejestracja przebiegła pomyślnie. Możesz się teraz <a href="{{ url('logowanie') }}">zalogować</a></span>
                    </div>
                @endif
                <form action="{{ url('rejestracja') }}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-6">
                        <label for="formImie" class="form-label fs-5">Imię</label>
                        @if($errors->has('imie'))
                            <input type="text" class="form-control is-invalid" id="formImie" name="imie" placeholder="Imię" required>
                            <div id="formImieFeedback" class="invalid-feedback">
                                {{ $errors->first('imie') }}
                            </div>
                        @else
                            <input type="text" class="form-control" id="formImie" name="imie" value="{{ old('imie') }}" placeholder="Imię" required>
                        @endif
                    </div>
                    <div class="col-6">
                        <label for="formNazwisko" class="form-label fs-5">Nazwisko</label>
                        @if($errors->has('nazwisko'))
                            <input type="text" class="form-control is-invalid" id="formNazwisko" name="nazwisko" placeholder="Nazwisko" required>
                            <div id="formNazwiskoFeedback" class="invalid-feedback">
                                {{ $errors->first('nazwisko') }}
                            </div>
                        @else
                            <input type="text" class="form-control" id="formNazwisko" name="nazwisko" value="{{ old('nazwisko') }}" placeholder="Nazwisko" required>
                        @endif
                    </div>
                    <div class="col-12 mt-3">
                        <label for="formEmail" class="form-label fs-5">Email</label>
                        @if($errors->has('email'))
                            <input type="email" class="form-control is-invalid" id="formEmail" name="email" placeholder="Podaj email" required>
                            <div id="formEmailFeedback" class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @else
                            <input type="email" class="form-control" id="formEmail" name="email" value="{{ old('email') }}" placeholder="Podaj email" required>
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
                        <label for="formPlik" class="form-label fs-5">Zdjęcie</label>
                        @if($errors->has('zdjecie'))
                            <input type="file" id="formPlik" name="zdjecie" required class="form-control is-invalid">
                            <div id="formPlikFeedback" class="invalid-feedback">
                                {{ $errors->first('zdjecie') }}
                            </div>
                        @else
                            <input type="file" id="formPlik" name="zdjecie" required class="form-control">
                        @endif
                    </div>
                    <div class="col-12 mt-6 d-grid gap-2">
                        <button type="submit" class="btn btn-dark">Zarejestruj się</button>
                        <p class="fs-7 text-center mb-0">Masz już konto? <a href="{{ url('logowanie') }}">Zaloguj się</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

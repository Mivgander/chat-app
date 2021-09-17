<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szukaj</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .user:hover
        {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <main class="w-100 min-vh-100 bg-gray-200 position-relative">
        <div class="w-100 bg-white py-4 px-6 position-absolute top-50 start-50 translate-middle shadow" style="max-width: 520px; border-radius: 1rem;">
            <div class="w-100">
                <div class="d-flex align-items-center border-bottom pb-2" style="border-color: #a3a3a3;">
                    <a href="{{ url('/') }}" class="d-flex align-items-center me-3" style="text-decoration: none; color: black;">
                        <span class="fs-2 h-100 d-flex align-items-center"><i class="fas fa-arrow-left"></i></span>
                    </a>
                    <h2 class="m-0">Wyniki wyszukiwania</h2>
                </div>

                <div class="mt-4">
                    <form method="get" action="{{ url('szukaj') }}" class="d-flex w-100">
                        @csrf

                        <div class="input-group mb-3">
                            @error('userName')
                                <input type="search" name="userName" id="formUserName" value="{!! $szukane !!}" class="form-control is-invalid" placeholder="Dodaj rozmówcę" required aria-label="Dodaj rozmówcę" aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                <div id="formUserNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @else
                                <input type="search" name="userName" id="formUserName" class="form-control" value="{!! $szukane !!}" placeholder="Dodaj rozmówcę" aria-label="Dodaj rozmówcę" required aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                            @enderror
                        </div>
                    </form>
                </div>

                <div style="max-height: 400px; overflow-y: auto;">
                    @if(count($users) > 0)
                        @foreach ($users as $user)
                            <a @if($utworzone_rozmowy[$user->id] == null) href="{{ url('rozmowa/stworz/'.$user->id) }}" @else href="{{ url('rozmowa/'.$utworzone_rozmowy[$user->id]) }}" @endif class="user d-flex justify-content-between align-items-center text-decoration-none px-2 py-1 mt-2" style="border-color: #a3a3a3; border-radius: 0.6rem;">
                                <div class="w-100 d-flex align-items-center">
                                    <div style="height: 40px; width: 40px;" class="position-relative">
                                        <img src="{{ url('img/'.$user->zdjecie) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-between ms-3">
                                        <span class="fs-5 fw-bold text-dark">{{ $user->imie . ' ' . $user->nazwisko }}</span>
                                        @if($utworzone_rozmowy[$user->id] == null)
                                            <p class="m-0 fs-5 fw-bold">Utwórz rozmowę</p>
                                        @else
                                            <p></p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p class="text-center fs-2 mt-2 m-0">Nie znaleziono nikogo :(</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>

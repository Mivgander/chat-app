<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatting app</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        a:hover
        {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <main class="w-100 min-vh-100 bg-gray-200 position-relative">
        <div class="w-100 bg-white py-4 px-6 position-absolute top-50 start-50 translate-middle shadow" style="max-width: 520px; border-radius: 1rem;">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-4" style="border-color: #a3a3a3;">
                <div class="w-100 d-flex align-items-center">
                    <img src="{{ url('img/'.Auth::user()->zdjecie) }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%;">
                    <div class="d-flex align-items-center ms-3">
                        <span class="fs-2 fw-bold">{{Auth::user()->imie . ' ' . Auth::user()->nazwisko}}</span>
                    </div>
                </div>
                <div style="float: right;">
                    <a href="{{ url('wyloguj') }}" class="btn btn-dark fs-5">Wyloguj</a>
                </div>
            </div>
            <div class="w-100">
                <div class="w-100 p-2 mt-6">
                    <h2>Rozmowy</h2>
                </div>
                    <form method="get" action="{{ url('szukaj') }}" class="d-flex w-100">
                        @csrf

                        <div class="input-group mb-3">
                            @error('userName')
                                <input type="search" name="userName" id="formUserName" class="form-control is-invalid" placeholder="Dodaj rozmówcę" required aria-label="Dodaj rozmówcę" aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                <div id="formUserNameFeedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @else
                                <input type="search" name="userName" class="form-control" placeholder="Dodaj rozmówcę" aria-label="Dodaj rozmówcę" required aria-describedby="button-addon2">
                                <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                            @enderror
                        </div>
                    </form>

                <div style="max-height: 300px; overflow-y: auto;">
                    @if(count($users) > 0)
                        @foreach ($users as $user)
                            <a @if($wspolne_rozmowy[$user->id] != null) href="{{ url('rozmowa/'.$wspolne_rozmowy[$user->id]) }}" @endif class="d-flex justify-content-between align-items-center text-decoration-none px-2 p-1 mt-1" style="border-color: #a3a3a3; border-radius: 0.6rem;">
                                <div class="w-100 d-flex align-items-center">
                                    <div style="height: 40px; width: 40px;" class="position-relative">
                                        <img src="{{ url('img/'.$user->zdjecie) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                                        {{-- <div class="border border-4 border-danger bg-danger position-absolute bottom-0 end-4" style="border-radius: 50%; height: 16px; width: 16px;"></div> --}}
                                    </div>
                                    <div class="ms-3">
                                        <span class="fs-5 fw-bold text-dark">{{ $user->imie . ' ' . $user->nazwisko }}</span>
                                        <p class="text-secondary fs-6 m-0">
                                            @if($ostatnia_wiadomosc[$user->id] == null)
                                                Nie ma żadnej wiadomości
                                            @else
                                                @if($ostatnia_wiadomosc[$user->id][0]->nadawca_id == Auth::id())
                                                    Ty:
                                                @else
                                                    {{ $user->imie }}:
                                                @endif

                                                {{ $ostatnia_wiadomosc[$user->id][0]->wiadomosc }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p class="fs-4 text-center">Nie masz żadnych znajomych :(</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>

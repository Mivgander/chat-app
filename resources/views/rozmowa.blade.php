<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatting app</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <main class="w-100 min-vh-100 bg-gray-200 position-relative">
        <div class="w-100 position-absolute top-50 start-50 translate-middle shadow" style="max-width: 520px; border-radius: 1rem;">
            <div class="w-100 bg-white py-3 px-4" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <div class="w-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center" style="border-color: #a3a3a3;">
                        <div class="w-100 d-flex">
                            <a href="{{ url('/') }}" class="d-flex align-items-center me-3" style="text-decoration: none; color: black;">
                                <span class="fs-2 h-100 d-flex align-items-center"><i class="fas fa-arrow-left"></i></span>
                            </a>
                            <img src="{{ url('img/'.$kontakt_user->zdjecie) }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%;">
                            <div class="d-flex align-items-center ms-3">
                                <span class="fs-2 fw-bold">{{ $kontakt_user->imie . ' ' . $kontakt_user->nazwisko }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('rozmowa-controller', ['rozmowa_id' => $rozmowa_id, 'kontakt_user' => $kontakt_user])
        </div>
    </main>

    @livewireScripts
</body>

<script>
    var element = document.querySelector("#oknoCzatu");
    element.scrollTop = element.scrollHeight;

    window.addEventListener('wiadomoscDodana', event => {
        element.scrollTop = element.scrollHeight;
    })
</script>

</html>

<div>
    <div id="oknoCzatu" class="w-100 bg-gray-200 py-3 px-4" style="height: 400px; overflow-y: auto;">
        <?php
            $licznik_ogolny = -1;
            $licznik_rzad = 0;
            $liczba_wszystkich = count($wiadomosci);
        ?>

        @foreach ($wiadomosci as $wiadomosc)
            <?php $licznik_ogolny++; ?>
            @if($wiadomosc->nadawca_id == $moje_id)
                @if($licznik_ogolny == 0 || $wiadomosci[$licznik_ogolny-1]->nadawca_id == $kontakt_id)
                    @php
                        $licznik_rzad = 1;
                    @endphp
                @else
                    @php
                        $licznik_rzad++;
                    @endphp
                @endif

                @if($licznik_rzad == 1)
                    @if($licznik_ogolny+1 == $liczba_wszystkich || ($licznik_ogolny+1 < $liczba_wszystkich && $wiadomosci[$licznik_ogolny+1]->nadawca_id == $kontakt_id))
                        <div class="fs-7 d-flex mb-2 justify-content-end" style="max-width: 300px; margin-left: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-dark text-white" style="max-width: 300px; border-radius: 18px 18px 2px 18px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @else
                        <div class="fs-7 d-flex justify-content-end" style="max-width: 300px; margin-left: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-dark text-white" style="max-width: 300px; border-radius: 18px 18px 2px 18px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @endif
                @else
                    @if($licznik_ogolny+1 < $liczba_wszystkich && $wiadomosci[$licznik_ogolny+1]->nadawca_id == $moje_id)
                        <div class="fs-7 d-flex justify-content-end" style="max-width: 300px; margin-left: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-dark text-white" style="max-width: 300px; border-radius: 18px 2px 2px 18px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @else
                        <div class="fs-7 d-flex mb-2 justify-content-end" style="max-width: 300px; margin-left: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-dark text-white" style="max-width: 300px; border-radius: 18px 2px 18px 18px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @endif
                @endif
            @else
                @if($licznik_ogolny == 0 || $wiadomosci[$licznik_ogolny-1]->nadawca_id == $moje_id)
                    @php
                        $licznik_rzad = 1;
                    @endphp
                @else
                    @php
                        $licznik_rzad++;
                    @endphp
                @endif

                @if($licznik_rzad == 1)
                    @if($licznik_ogolny+1 == $liczba_wszystkich || ($licznik_ogolny+1 < $liczba_wszystkich && $wiadomosci[$licznik_ogolny+1]->nadawca_id == $moje_id))
                        <div class="fs-7 mb-2 d-flex align-items-end" style="margin-right: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <img src="{{ url('img/'.$kontakt_user->zdjecie) }}" style="height: 30px; width: 30px; object-fit: cover; border-radius: 50%;">
                    @else
                        <div class="fs-7 d-flex align-items-end" style="margin-right: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <div style="height: 30px; width: 30px;"></div>
                    @endif
                        <p class="ms-2 mt-7 m-0 py-2 px-3 bg-white" style="max-width: 300px; border-radius: 18px 18px 18px 2px;">{{ $wiadomosc->wiadomosc }}</p>
                    </div>
                @else
                    @if(($licznik_ogolny+1) < $liczba_wszystkich && $wiadomosci[$licznik_ogolny+1]->nadawca_id == $kontakt_id)
                        <div class="fs-7 d-flex align-items-end" style="margin-right: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <div style="height: 30px; width: 30px;"></div>
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-white" style="max-width: 300px; border-radius: 2px 18px 18px 2px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @else
                        <div class="fs-7 mb-2 d-flex align-items-end" style="margin-right: auto; @if(strpos($wiadomosc->wiadomosc, ' ') === false) line-break: anywhere; @else line-break: auto; @endif">
                            <img src="{{ url('img/'.$kontakt_user->zdjecie) }}" style="height: 30px; width: 30px; object-fit: cover; border-radius: 50%;">
                            <p class="ms-2 mt-7 m-0 py-2 px-3 bg-white" style="max-width: 300px; border-radius: 2px 18px 18px 18px;">{{ $wiadomosc->wiadomosc }}</p>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    </div>

    <div class="w-100 bg-white py-3 px-4" style="border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
        <form wire:submit.prevent="wyslijWiadomosc" class="d-flex w-100">
            <input type="text" wire:model.defer="wiadomosc" id="formWiadomosc" autofocus placeholder="Napisz wiadomość..." class="form-control">
            <button type="submit" class="btn btn-dark ms-2">Wyślij</button>
        </form>
        @if($errors->has('wiadomosc'))
            <div class="text-danger text-center w-100" style="font-size: .9rem;">
                {{ $errors->first('wiadomosc') }}
            </div>
        @endif
    </div>
</div>

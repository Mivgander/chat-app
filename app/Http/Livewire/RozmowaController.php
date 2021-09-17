<?php

namespace App\Http\Livewire;

use App\Events\NowaWiadomosc;
use App\Models\Wiadomosc;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RozmowaController extends Component
{
    public $rozmowa_id;

    public $moje_id;
    public $kontakt_id;
    public $kontakt_user;

    public $wiadomosc = '';

    public $wiadomosci;

    public function mount()
    {
        $this->pobierzWiadomosci();

        $this->kontakt_id = $this->kontakt_user->id;
        $this->moje_id = Auth::id();
    }

    public function getListeners()
    {
        return [
            "echo:rozmowa.$this->rozmowa_id,NowaWiadomosc" => 'dodajWiadomosc'
        ];
    }

    public function render()
    {
        return view('livewire.rozmowa-controller', [
            'wiadomosci' => $this->wiadomosci
        ]);
    }

    public function dodajWiadomosc(Wiadomosc $wiadomosc)
    {
        $this->wiadomosci->push($wiadomosc);
        $this->dispatchBrowserEvent('wiadomoscDodana');
    }

    public function pobierzWiadomosci()
    {
        $this->wiadomosci = Wiadomosc::where('rozmowa_id', $this->rozmowa_id)->get();
    }

    public function wyslijWiadomosc()
    {
        $this->validate([
            'wiadomosc' => 'bail|required|string|max:65535'
        ],
        [
            'wiadomosc.required' => 'Nie możesz wysłać pustej wiadomości',
            'wiadomosc.string' => 'Wiadomość musi być ciągiem znaków',
            'wiadomosc.max' => 'Wiadomosc może składać się maksymalnie z :max znaków'
        ]);

        if($this->wiadomosc == '' || ctype_space($this->wiadomosc))
        {
            $this->wiadomosc = '';
            return;
        }

        $nowaWiadomosc = Wiadomosc::create([
            'rozmowa_id' => $this->rozmowa_id,
            'nadawca_id' => $this->moje_id,
            'wiadomosc' => $this->validateWiadomosc($this->wiadomosc)
        ]);

        $this->wiadomosci->push($nowaWiadomosc);

        $this->dispatchBrowserEvent('wiadomoscDodana');
        $this->wiadomosc = '';

        broadcast(new NowaWiadomosc($nowaWiadomosc))->toOthers();
    }

    private function validateWiadomosc($wiadomosc)
    {
        $wiadomosc = trim($wiadomosc);
        $wiadomosc = stripslashes($wiadomosc);
        $wiadomosc = htmlspecialchars($wiadomosc);
        return $wiadomosc;
    }
}

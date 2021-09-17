<?php

namespace App\Http\Controllers;

use App\Models\Rozmowa;
use App\Models\Uczestnik;
use App\Models\User;
use App\Models\Wiadomosc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    function home()
    {
        $users = [];
        $id_wspolnej_rozmowy = [];
        $ostania_wiadomosc = [];

        foreach(Auth::user()->uczestnik as $row)
        {
            $kontakt = Uczestnik::where('rozmowa_id', $row->rozmowa_id)->where('user_id', '!=', Auth::id())->limit(1)->get()[0];
            $user = $kontakt->user;
            $wiadomosc = Wiadomosc::where('rozmowa_id', $row->rozmowa_id)->orderBy('created_at', 'DESC')->limit(1)->get();
            if(count($wiadomosc) > 0)
            {
                $ostania_wiadomosc[$user->id] = $wiadomosc;
            }
            else
            {
                $ostania_wiadomosc[$user->id] = null;
            }
            $id_wspolnej_rozmowy[$user->id] = $row->rozmowa_id;
            $users[] = $user;
        }

        return view('index', [
            'users' => $users,
            'wspolne_rozmowy' => $id_wspolnej_rozmowy,
            'ostatnia_wiadomosc' => $ostania_wiadomosc
        ]);
    }

    function logowanieIndex()
    {
        return view('logowanie');
    }

    function logowaniePost(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'haslo' => 'bail|required|string'
        ]);

        $userData = [
            'email' => $request->email,
            'password' => $request->haslo
        ];

        $zapamietaj = $request->has('zapamietaj') ? true : false;

        if(Auth::attempt($userData, $zapamietaj))
        {
            $request->session()->regenerate();
            return redirect('/');
        }
        else
        {
            return back()->with('logowanieError', 'Dane logowania są niepoprawne. Spróbuj ponownie.');
        }
    }

    function wyloguj(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('logowanie');
    }

    function rejestracjaIndex()
    {
        return view('rejestracja');
    }

    function rejestracjaPost(Request $request)
    {
        $this->validate($request, [
            'imie' => 'bail|required|string|max:40|Alpha',
            'nazwisko' => 'bail|required|string|max:40|Alpha',
            'email' => 'bail|required|email|unique:App\Models\User,email',
            'haslo' => 'bail|required|string|min:8|max:40',
            'zdjecie' => 'bail|required|image|max:10240'
        ]);

        $zdjecie = $request->zdjecie->store('');
        User::create([
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'user_name' => $request->imie . ' ' . $request->nazwisko,
            'email' => $request->email,
            'password' => Hash::make($request->haslo),
            'zdjecie' => $zdjecie
        ]);

        return back()->with('zarejestrowano', '');
    }

    function rozmowa($id)
    {
        $user = '';

        foreach(Uczestnik::where('rozmowa_id', $id)->get() as $row)
        {
            if($row->user_id != Auth::id())
            {
                $user = User::find($row->user_id);
            }
        }

        return view('rozmowa', [
            'rozmowa_id' => $id,
            'kontakt_user' => $user
        ]);
    }

    function szukaj(Request $request)
    {
        $this->validate($request,
        [
            'userName' => 'bail|required|string|max:90'
        ],
        [
            'userName.required' => 'Musisz wpisać imię i/lub nazwisko użytkownika',
            'userName.string' => 'Podana wartość musi być ciągiem znaków',
            'userName.max' => 'Podana wartość może składać się maksymalnie z :max znaków'
        ]);

        $users = [];

        if(strpos($request->userName, ' ') === false)
        {
            $tmp = User::where('nazwisko', $request->userName)->get();
            $users = $tmp->merge(User::where('imie', $request->userName)->get());
        }
        else
        {
            $tab = preg_split("/[\s]+/", $request->userName);
            $tmp = User::where('user_name', $request->userName)->get();
            $tmp2 = $tmp->merge(User::where('nazwisko', $tab[1])->get());
            $users = $tmp2->merge(User::where('imie', $tab[0])->get());
        }

        $utworzone_rozmowy = [];
        $rozmowy = Uczestnik::where('user_id', Auth::id())->get();

        foreach($users as $user)
        {
            foreach($rozmowy as $rozmowa)
            {
                if(Uczestnik::where('rozmowa_id', $rozmowa->rozmowa_id)->where('user_id', $user->id)->exists())
                {
                    $utworzone_rozmowy[$user->id] = $rozmowa->rozmowa_id;
                    break;
                }
                else
                {
                    $utworzone_rozmowy[$user->id] = null;
                }
            }
        }

        return view('szukaj', [
            'users' => $users,
            'utworzone_rozmowy' => $utworzone_rozmowy,
            'szukane' => $request->userName
        ]);
    }

    function rozmowaStworz($user_id)
    {
        $rozmowa = Rozmowa::create([]);

        Uczestnik::create([
            'rozmowa_id' => $rozmowa->id,
            'user_id' => $user_id,
        ]);

        Uczestnik::create([
            'rozmowa_id' => $rozmowa->id,
            'user_id' => Auth::id()
        ]);

        return redirect('rozmowa/'.$rozmowa->id);
    }
}

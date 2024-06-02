<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthManager extends Controller
{
    // Jei bandoma pasiekti prisijungimo langą, kai vartotojas jau yra prisijungęs - perjungiama į bendrinį puslapį
    function login(){
        if(Auth::check()){
            return redirect(route('index'));
        }
        return view('login');
    }

    // Jei bandoma pasiekti registracijos langą, kai vartotojas jau yra prisijungęs - perjungiama į bendrinį puslapį
    function registration(){
        if(Auth::check()){
            return redirect(route('index'));
        }
        return view('registration');
    }

    // Vartotojui suvedus prisijungimo duomenis patikriname ar jie tinkami, jei taip - prijungiame ir perjungiama į bendrinį
    // puslapį, kitu atvėju vartotojas gauna klaidos pranešimą.
    function loginPost(Request $request){
        $request ->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('index'))->with("success","Sėkmingai prisijungta");
        }
        return redirect(route('login'))->with("error","Prisijungimo duomenys netinkami");
    }

    // Registruojantis patikrinama, ar toks vartotojas jau egzistuoja (pagal el. paštą)
    // taip pat validuojami kiti prisijungimo laukai, jei jie netinkami - vartotojas gauna pranešimą
    // jei viskas registracijos formoje tinkama - užregistruojame vartotoją ir perjungiama į prisijungimo langą
    function registrationPost(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'retypedPassword' => 'required|same:password',
            'phoneNumber'=> 'required'
        ]);

        $customMessages = [
            'required' => 'Laukas :attribute yra privalomas.',
            'email' => 'Neteisingas el. pašto adreso formatas.',
            'unique' => 'Toks :attribute jau yra naudojamas',
            'same' => 'Slaptažodžiai nesutampa.'
        ];

        $validator->setAttributeNames([
            'name' => 'vardas ir pavardė',
            'email' => 'el. paštas',
            'password' => 'slaptažodis',
            'retypedPassword' => 'pakartotas slaptažodis',
            'phoneNumber' => 'telefono numeris'
        ]);

        $validator->setCustomMessages( $customMessages );

        if ($validator->fails()) {
            return redirect(route('registration'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['phoneNumber'] = $request->phoneNumber;
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error","Toks vartotojas jau egzistuoja sistemoje!");
        }
        return redirect(route('login'))->with("success","Registracija sekminga, prisijunkite!");
    }

    // Vartotojui paspaudus atsijungimo mygtuką išvalome sesiją ir atjungiame, taip pat perjungiama į prisijungimo langą
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

}

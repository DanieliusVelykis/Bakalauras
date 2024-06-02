<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller{

    // Vartotojų valdymo klasė

    // metodas grąžinantis vartotojus peržiūrai
    public function users(){
      $users = User::all();
      $roles = Role::all();
      return view('users', ['users' => $users,'roles'=>$roles]);
    }

    // metodas skirtas išgauti konkretaus vartotojo informaciją (grąžinama JSON formatu kliento pusei)
    public function getUserById($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Vartotojas nebuvo rastas'], 404);
        }
        return response()->json($user);
    }

    // metodas skirtas konkretaus vartotojo duomenų koregavimui
    public function editUser(Request $request){

        // patikrinama, ar priskiriamas telefonas ar el. paštas nėra jau naudojamas kitų
    $validator = Validator::make($request->all(), [
        'email' => 'email|unique:users',
        'phone' => 'unique:users'
    ]);

    // jei naudojamas ar neteisingai užpildytas laukas - informacija perduodama vartotojui
    $customMessages = [
        'email' => 'Neteisingas el. pašto adreso formatas.',
        'unique' => 'Toks :attribute jau yra naudojamas',
    ];

    $validator->setAttributeNames([
        'name' => 'vardas ir pavardė',
        'email' => 'el. paštas',
        'phoneNumber' => 'telefono numeris'
    ]);

    $validator->setCustomMessages( $customMessages );

    // jei visi patikrinimai buvo patvirtinti - randamas vartotojas ir perrašomos senos vertės naujomis
    $user = User::find($request->user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phoneNumber = $request->phoneNumber;
    $user->role = $request->role;
    
    $user->save();

    if($user-> name != $request->name || $user->phoneNumber != $request->phoneNumber){
    if ($validator->fails()) {
        return new JsonResponse(['errors' => $validator->errors()], 422);
    }
}

    return response()->json($user);
    }
}
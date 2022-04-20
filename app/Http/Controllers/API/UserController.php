<?php

namespace App\Http\Controllers\API;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function login(Request $request)
    {
      $credentials = [
        'email' => $request->email,
        'password' => $request->password,
      ];
      if(Auth::attempt($credentials)){
        $success = true;
        $message = Auth::user();
      }
      else{
        $success = false;
        $message = 'Logowanie nie powiodło się';
      }
      $response = [
        'success' => $success,
        'message' => $message,
      ];
      return response()->json($response);
    }
    public function rejestracja(Request $request){
      try
      {
        $user = new User();
        $user->imie = $request->imie;
        $user->nazwisko = $request->nazwisko;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $success = true;
        $message = 'Utworzono nowego użytkownika';
      }
      catch(\Illuminate\Database\QueryException $e)
      {
        $success = false;
        $message = $e->getMessage();
      }
      $response=[
        'success'=>$success,
        'message'=>$message,
      ];
      return response()->json($response);
    }
    public function wyloguj()
    {
        try
        {
          Session::flush();
          $success=true;
          $message="Wylogowano Pomyślnie";
        }
        catch(\Illuminate\Database\QueryException $e)
        {
          $success = false;
          $message = $e->getMessage();
        }
        $response=[
          'success'=>$success,
          'message'=>$message,
        ];
        return response()->json($response);
    }
    public function show_user()
    {
      $users=Role::with('users')->get()->toArray();
      return response()->json($users);
    }
    public function searchuser(Request $request)
    {
      $values=$request->value;
      $columns=['imie','nazwisko','slug'];
      $search=Role::with('users');
      foreach($columns as $column){
      $search->orwherehas('users',function($query)use($column,$values){
        $query->where($column,'like','%'.$values.'%');
      });
    };
      $data = $search->get()->toArray();

      return response()->json($data);
    }
    public function get_role()
    {
      $role = Role::with('users')->get()->toArray();
      return response()->json($role);
    }
    public function get_us(Request $request){
      $users = user::find(1)->roles()->where('slug','=','Kierownik')->get()->toarray();
      //$dom = $users->roles()->get();
      return response()->json($users);
    }
}

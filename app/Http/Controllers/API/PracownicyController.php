<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\zlecenia;
use App\Models\User;
use App\Models\obecne_zlecenia as obecne;

class PracownicyController extends Controller
{
  public function zlecenia()
  {
    $zlecenia=obecne::with('users')->get()->toArray();
    return array_reverse($zlecenia);
  }
  public function dodawanie(Request $request)
  {
    $users = User::find($request->userid);
    $dodanie = new obecne(['urzadzenie'=>$request->urzadzenie,
                             'usterka'=>$request->usterka,
                             'uwaga'=>$request->uwaga,
                             'limitkosztow'=>$request->limitkosztow
                           ]);
    $dodanie->save();
    $dodanie->users()->sync($users);
    return response()->json('Dodano nowe zlecenie');
  }
  public function getdod()
  {
    $user=User::orderby('id','desc')->get()->toArray();
    return array_reverse($user);
  }
  public function edytowaniezlecen($id)
  {
    $edit=zlecenia::find($id);
    return response()->json($edit);
  }
  public function update($id,Request $request)
  {
      $update=zlecenia::find($id);
      $update->update($request->all());
      return response()->json('Zmodyfikowalismy tabelke');
  }
  public function usun($id){
    $delete=zlecenia::find($id);
    $zlecenia->delete();
    return response()->json('Usunieto rekord');
  }
  public function zsearch(Request $request)
  {
    $values=$request->value;
    $search=zlecenia::query();
    $columns=['urzadzenie','usterka','uwaga','limitkosztow','imie','nazwisko'];
    /*foreach($columns as $column){
    $search->orWhere($column,'like','%'.$values.'%');
    };
    $data=$search->get();
    return response()->json($data);
    */
    $search=obecne::with('users');
    foreach($columns as $column){
    $search->orwherehas('users',function($query)use($column,$values){
      $query->where($column,'like','%'.$values.'%');
    });
  };
    $data = $search->get()->toArray();

    return response()->json($data);
}
}

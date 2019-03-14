<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Smještamo sve usere u varijablu $users, te ih prosljeđujemo na view users/index gdje ćemo ih izlistavati
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Sve rolove iz baze podataka smještamo u varijablu roles, te ih prosljeđujemo na formu za kreiranje usera
        $roles = Role::pluck('name', 'id')->all(); //Pluck metoda vraća vrijednosti određenog ključa iz tabele.
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(UsersRequest $request)
    {
        //Spremanje novog korisnika kojeg korisnik unese putem forme
        //Provjeravanje da li ima passworda, ako ga ima zanemaruje se i unose se ostali podaci u bazu podataka, ako nema, unosi se zajedno sa ostalim podacima
        if (trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }
        //Porvjeravamo da li se uploada fajl, zazim kreiramo fajl sa imenom, smjestamo ga u "Photos" i premjestamo sliku i "images" direktorij
        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        //Na password dodaje enkripciju, te potom kreiramo usera
        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Potrazuje se korisnik kojeg je korisnik odabrao putem ID-a, zatim se smješta u varijablu te se prosljeđuje na view user/edit kako bi se prikazao korisniku
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all(); //Pluck metoda vraća vrijednosti određenog ključa iz tabele.
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //Izmjena prethodno odabranog korisnika
        //Pretraživanje korisnika po ID-u koji se edituje
        $user = User::findOrFail($id);
        //Provjeravanje da li ima passworda, ako ga ima zanemaruje se i unose se ostali podaci u bazu podataka
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }
        //Ako user odabere sliku, premješta se u direktorij za slike i sprema u bazu podataka
        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']= $photo->id;
        }
        //Na password dodaje enkripciju, te potom kreiramo usera
        $input['password'] = bcrypt($request->password);
        $user->update($input);
        //kreiranje poruke prilikom edita usera
        Session::flash('edited_user', 'Korisnik uspješno izmjenjen.');
        return redirect('/admin/users');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Brisanje korisnika kojeg je korisnik prethodno odabrao
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        $user->delete();
        //kreiranje poruke prilikom brisanja usera
        Session::flash('deleted_post', 'Korisnik uspješno izbrisan');
        return redirect('/admin/users');
    }
}

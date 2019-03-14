<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Vraćamo sve objave iz baze podataka, te ih smještamo u varijablu posts, koju prosljeđujemo na view posts/index gdje ćemo ih prikazivati.
        $posts = Post::paginate(2); //paginate znači da će se prikazivati određen broj postova po stranici, a ostali će se razdvajati na druge stranice
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Vraćamo formu za kreiranje medije na view media/create
        $categories = Category::pluck('name', 'id')->all(); //Pluck metoda vraća vrijednosti određenog ključa iz tabele.
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //Spremanje nove objave koju korisnik unese putem forme
        $user = Auth::user(); //Uzimamo za usera onog usera koji je prijavljen na servis
        $input = $request->all();
        //Porvjeravamo da li se uploada fajl, zazim kreiramo fajl sa imenom, smjestamo ga u "Photos" i premjestamo sliku u "images" direktorij
        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        //Kreiranje objave na osnovu relacije user->posts
        $user->posts()->create($input);
        return redirect('admin/posts/');
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
        //Potrazuje se objava koju je korisnik odabrao putem ID-a, zatim se smješta u varijablu te se prosljeđuje na view post/edit kako bi se prikazala korisniku
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all(); //Pluck metoda vraća vrijednosti određenog ključa iz tabele.
        return view('admin.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        //Izmjena objave koju je korisnik prethodno odabrao
        $input = $request->all();
        //Porvjeravamo da li se uploada fajl, zazim kreiramo fajl sa imenom, smjestamo ga u "Photos" i premjestamo sliku i "images" direktorij
        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        //Izmjena se vrši na relaciji user->post, gdje se također upoređuje da li ID objave za izmjenu odgovara onom u bazi podataka
        Auth::user()->posts()->whereId($id)->first()->update($input);
        //kreiranje poruke prilikom brisanja usera
        Session::flash('edited_post', 'Objava uspješno izmjenjena.');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Brisanje objave koju je korisnik prethodno odabrao, te brisanje i slike iz direktorija koja ide uz tu objavu
        $post = Post::findOrFail($id);
        unlink(public_path().$post->photo->file);
        $post->delete();
        //kreiranje poruke prilikom brisanja objave
        Session::flash('deleted_post', 'Objava uspješno izbrisana.');
        return redirect('/admin/posts');
    }

    //Pretraivanje objave na osnovu slug-a, spremanje objave u varijablu, te slanje na view /post kako bi se mogao pregledati
    public function post($slug){
        $post = Post::findBySlugOrFail($slug);
        return view('post', compact('post'));
    }
}

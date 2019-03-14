<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryRequest;

use App\Http\Requests;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Vraćamo sve kategorije iz baze podataka, te ih smještamo u varijablu categories, koju prosljeđujemo na view category/index gdje ćemo ih prikazivati
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //Spremanje nove kategorije koju korisnik unese putem forme
        Category::create($request->all());
        return redirect('/admin/categories');
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
        //Potrazuje se kategorija koju je korisnik odabrao putem ID-a, zatim se smješta u varijablu te se prosljeđuje na view categories/edit kako bi se prikazala korisniku
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //Izmjena kategorije koju je korisnik prethodno odabrao
        $category = Category::findOrFail($id);
        $category->update($request->all());
        //kreiranje poruke prilikom edita kategorije
        Session::flash('edited_category', 'Kategorija uspješno izmjenjena.');
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Brisanje kategorije koju je korisnik prethodno odabrao
        Category::findOrFail($id)->delete();
        //kreiranje poruke prilikom brisanja kategorije
        Session::flash('deleted_category', 'Kategorija uspješno izbrisana.');
        return redirect('/admin/categories');
    }
}

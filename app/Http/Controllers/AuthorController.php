<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAuthorRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        //Author::create($request->validated());
        //dd($request);
        $author = new Author();
        $author->name = $request->input('name');
        $author->birthday = $request->input('birthday');
        $author->save();


        return redirect()->route('authors.index')->with('success', 'Autore aggiunto!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return View
     */
    public function edit(Author $author) : View
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(Request $request, Author $author) : RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        $author->update($request->all());
        return redirect()->route('authors.index')->with('success', 'Autore aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Author $author) :RedirectResponse
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Autore eliminato!');
    }
}

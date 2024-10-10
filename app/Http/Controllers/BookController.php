<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        // Recupera tutti i libri dal database con i loro autori e categorie
        $books = Book::with('author', 'category')->get();

        // Passa i dati alla vista
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * n@return View
     */
    public function create() :View
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pages' => 'nullable|integer',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Libro creato!');
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return View
     */
    public function show(Book $book) : View
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Application|Factory|View
     */
    public function edit(Book $book): View
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $libroData = $request->validated();
        $book->update($libroData);
        return redirect()->route('books.index')->with('success', 'Libro aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book) : RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Libro eliminato!');
    }
}

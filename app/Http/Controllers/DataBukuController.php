<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;

class DataBukuController extends Controller
{
    protected function index()
    {
        $data_buku = Book::orderBy('id', 'DESC')->paginate(10);
        return $data_buku->toJson();
    }

    protected function create()
    {
        return Inertia::render('TambahBuku');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'no_isbn' => 'required',
            'jumlah_buku' => 'required|numeric'
        ]);

        $book = new Book();
        $book->judul = $request->judul;
        $book->pengarang = $request->pengarang;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->no_isbn = $request->no_isbn;
        $book->jumlah_buku = $request->jumlah_buku;
        $book->save();

        return redirect()->back();
    }

    protected function destroy(Request $request)
    {
        // dd($request);
        $request->validate([
            'id' => 'required'
        ]);

        Book::destroy($request->id);

        return redirect()->back();
    }

    protected function update(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'no_isbn' => 'required',
            'jumlah_buku' => 'required|numeric'
        ]);

        $book = Book::find($request->id);
        $book->judul = $request->judul;
        $book->pengarang = $request->pengarang;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->no_isbn = $request->no_isbn;
        $book->jumlah_buku = $request->jumlah_buku;
        $book->save();

        return redirect()->back();
    }
}

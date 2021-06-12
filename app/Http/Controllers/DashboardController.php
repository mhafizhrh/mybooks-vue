<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;

class DashboardController extends Controller
{
    protected function index()
    {
        $jumlah_buku = Book::all()->count();
        $jumlah_pengarang = Book::distinct('pengarang')->count();
        $jumlah_penerbit = Book::distinct('penerbit')->count();
        return Inertia::render('Dashboard', compact('jumlah_buku', 'jumlah_pengarang', 'jumlah_penerbit'));
    }
}

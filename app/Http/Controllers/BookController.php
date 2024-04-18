<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Number;

class BookController extends Controller {

    public function all() {
        return Book::all();
    }

    public function find($id) {
        return Book::find($id);
    }

    public function findBySlug($slug) {
        return Book::where('slug', $slug)
            ->get();
    }

    public function findByYear($year) {
        return Book::where('year', $year)
            ->get();
    }

    public function findByMaxPages($pages) {
        return Book::where('pages', '<=', $pages)
            ->get();
    }

    public function search($search) {
        return Book::where('title', 'like', "%$search%")
            ->orWhere('author', 'like', "%$search%")
            ->get();
    }

    public function count() {
        return ['count' => Book::count()];
    }

    public function pages() {
        return ['avg-pages' => Number::format(Book::avg('pages'), precision: 1)];
    }

    public function dashboard() {
        $books = Book::all();

        return [
            'books' => $books->count(),
            'pages' => $books->sum('pages'),
            'oldest' => $books->sortBy('year')->first()->title,
            'newest' => $books->sortByDesc('year')->first()->title
        ];
    }

}

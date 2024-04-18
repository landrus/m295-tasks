<?php

use App\Models\Book;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('slug');
            $table->integer('year');
            $table->integer('pages');
            $table->timestamps();
        });

        $books = [
            [
                "title" => "The Fellowship of the Ring",
                "author" => "J. R. R. Tolkien",
                "slug" => "fellowship-of-the-ring",
                "year" => 1954,
                "pages" => 423
            ], [
                "title" => "The Two Towers",
                "author" => "J. R. R. Tolkien",
                "slug" => "two-towers",
                "year" => 1954,
                "pages" => 352
            ], [
                "title" => "The Return of the King",
                "author" => "J. R. R. Tolkien",
                "slug" => "return-of-the-king",
                "year" => 1955,
                "pages" => 416
            ]
        ];

        foreach ($books as $book) {
            $bookModel = new Book();
            $bookModel::unguard();
            $bookModel->fill($book);
            $bookModel->save();
            $bookModel::reguard();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

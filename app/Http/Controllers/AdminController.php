<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createArticle(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'author' => 'max:200'
            ]);

            $article = new Article();
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->author = $request->input('author');
            $article->save();

            return response()->json(['message' => 'Successfully article created', 'article' => $article], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create article' . $e->getMessage()], 404);
        }
    }

    public function showArticle()
    {
        $article = Article::all();
        return response()->json(['article' => $article], 200);

        if ($article->isEmpty()) {
            return response()->json(['message' => 'Belum ada artikel']);
        }
    }
}

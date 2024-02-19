<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create(Request $request)
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

    public function update(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:1000',
                'description' => 'required',
                'author' => 'max:200'
            ]);

            Article::where('id', $request->id)->update([
                "title" => $request->input("title"),
                "description" => $request->input("description"),
                "author" => $request->input("author"),
            ]);

            return response()->json([
                "message" => "Article updated"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update article' . $e->getMessage()
            ], 404);
        }
    }

    public function delete(Request $request)
    {
        try {
            $article = Article::find($request->id);
            $article->delete();

            return response()->json([
                "message" => "Article deleted",
                "data" => $article
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete article' . $e->getMessage()
            ], 404);
        }
    }

    public function getAll()
    {
        $article = Article::all();
        return response()->json(['article' => $article], 200);

        if ($article->isEmpty()) {
            return response()->json(['message' => 'Belum ada artikel']);
        }
    }
}

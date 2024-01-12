<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use App\Models\Commande_article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $commandes = Commande::all();

        return response()->json($commandes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'prixTTC' => 'required|numeric',
            'username' => 'required|max:255',
            'user_id' => 'required|string', // Assuming 'img' should be a valid URL
            'articles' =>'array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();


        $validated = $validator->safe()->only(['user_id','username','prixTTC']);

        $articles = $validator->safe()->only(['articles']);



        $validated['id']= Str::uuid()->toString();
        $validated['num_commande']= Str::uuid()->toString();


        try {

            $commande = Commande::create($validated);
            $commande->save();

            // Attach articles to the command using the pivot table
            $articles = $articles['articles'];
            foreach ($articles as $articleData) {
                $article = Article::where('code_article', $articleData['code_article'])->first();


                if ($article) {
                    Commande_article::create(
                        [
                            'num_commande' => $commande->num_commande,
                            'code_article' => $article->code_article,
                            'quantite' => $articleData['quantite'],
                            'prixTotal' => $article->prix * intval($articleData['quantite']),
                        ]
                    );

                }
            }

            return response()->json(['message' => 'Commande created successfully', 'commande' => $commande], 201);


        }catch (\Illuminate\Database\QueryException  $exception){
            return response()->json($exception);
        }
//        catch (\ErrorException $e){
//            return response()->json($e);
//        }




//        foreach ($articles as $article  ){
//
//        }

        // Store the blog post...

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $commande = Commande::with('user','articles','commande_articles')->find($id);

        return response()->json($commande);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

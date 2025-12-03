<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function index(){
        try{
            return response()->json([
            'status_code' => 200,
            'status_message' => 'Les Posts ont été récupéré',
            'data' => Post::all()
        ]);
        }catch(Exception $e){
            response()->json($e);
        }
    }

    //Fonction pour créer un nouveau post
    public function store(CreatePostRequest $request){
        $post = new Post();
        $post->titre = $request->titre;
        $post->description = $request->description;
        $post->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le Post a été ajouté avec succès',
            'data' => $post
        ]);
    }

    //Fonction pour mettre à jour un post
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->titre = $request->titre;
        $post->description = $request->description;
        $post->save();
    }

    //fonction pour supprimer un post
    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Post introuvable'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le Post a été supprimé avec succès'
        ]);
    }

}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;




class PostController extends Controller
{
    public function index(){
        return "Je vous salue les gars";
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
}

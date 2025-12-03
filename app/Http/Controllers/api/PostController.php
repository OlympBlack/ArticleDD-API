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
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Récupérer tous les posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des posts",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status_code", type="integer", example=200),
     *             @OA\Property(property="status_message", type="string", example="Les Posts ont été récupéré"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titre", type="string", example="Titre du post"),
     *                     @OA\Property(property="description", type="string", example="Description du post")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(){
        try{
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Les Posts ont été récupéré',
                'data' => Post::all()
            ]);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/posts/create",
     *     summary="Créer un nouveau post",
     *     tags={"Posts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre"},
     *             @OA\Property(property="titre", type="string", example="Mon nouveau post"),
     *             @OA\Property(property="description", type="string", example="Description du post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status_code", type="integer", example=200),
     *             @OA\Property(property="status_message", type="string", example="Le Post a été ajouté avec succès"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="titre", type="string", example="Mon nouveau post"),
     *                 @OA\Property(property="description", type="string", example="Description du post")
     *             )
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/posts/edit/{id}",
     *     summary="Mettre à jour un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du post"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre"},
     *             @OA\Property(property="titre", type="string", example="Titre mis à jour"),
     *             @OA\Property(property="description", type="string", example="Nouvelle description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post mis à jour avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post introuvable"
     *     )
     * )
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->titre = $request->titre;
        $post->description = $request->description;
        $post->save();
    }

    /**
     * @OA\Delete(
     *     path="/api/post/{id}",
     *     summary="Supprimer un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du post"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post introuvable"
     *     )
     * )
     */
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

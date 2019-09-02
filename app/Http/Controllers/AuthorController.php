<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;
use App\Transformers\AuthorTransformer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthorController
 *
 * @package App\Http\ControllersA
 */
class AuthorController extends Controller
{
    protected $authorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/authors",
     *     summary="Get authors",
     *     operationId="getAuthors",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation",
     *         response="200",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index()
    {
        $paginator = Author::paginate(5);

        $response =  $this->authorService->fractalizeAll($paginator, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     *     summary="Get single authors",
     * @OA\Get(
     *     path="/api/v1/authors/{id}",
     *     operationId="getSingleAuthor",
     *     @OA\Parameter(
     *         description="ID of author to return",
     *         in="path",
     *         name="authorId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns a specific author's data",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);

        $response = $this->authorService->fractalizeOne($author, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/authors/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Author to be updated id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="Author object that needs to be updated",
     *         required=true,
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Updates an author",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $validatedAuthor = $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'github' => 'required|email',
            'twitter' => 'required|string',
            'location' => 'required|string'
        ]);

        $author->update($validatedAuthor);

        $response = $this->authorService->fractalizeOne($author, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/authors/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Author's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="Author object that needs to be added authors",
     *         required=true,
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Deletes an author",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        $author->delete();

        return response()->json(null, Response::HTTP_OK);
    }
}

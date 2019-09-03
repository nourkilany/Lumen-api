<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;
use App\Transformers\AuthorTransformer;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Author
 *
 * APIs for managing authors
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
     * Gets all authors
     * @authenticated
     * @transformer \App\Transformers\AuthorTransformer
     * @transformerModel \App\Author
     */
    public function index()
    {
        $paginator = Author::paginate(5);

        $response =  $this->authorService->fractalizeAll($paginator, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show a single author
     * @authenticated
     * @transformer \App\Transformers\AuthorTransformer
     * @transformerModel \App\Author
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);

        $response = $this->authorService->fractalizeOne($author, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
    * Updates an existing author
    *
    * @authenticated
    *
    * @transformer \App\Transformers\AuthorTransformer
    * @transformerModel \App\Author
    *
    * @bodyParam name string required The name of the author.
    * @bodyParam email string required The email of the author.
    * @bodyParam github string required The github account of the author.
    * @bodyParam twitter string required The twitter handle of the author.
    * @bodyParam location string required The Address of the author.
    */
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $validatedAuthor = $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'github' => 'required|email',
                'twitter' => 'required|string',
                'location' => 'required|string'
            ]
        );

        $author->update($validatedAuthor);

        $response = $this->authorService->fractalizeOne($author, new AuthorTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Deletes an author account
     *
     * @response 200 {
     *  "message": "Author was deleted successfully"
     * }
     *
     * @response 404 {
     *  "message": "Not found"
     * }
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        $author->delete();

        return response()->json(['message'=>'Author was deleted successfully'], Response::HTTP_OK);
    }
}

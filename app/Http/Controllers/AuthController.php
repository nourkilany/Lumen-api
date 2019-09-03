<?php

namespace App\Http\Controllers;

use App\Author;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthorService;
use App\Transformers\AuthorTransformer;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Authentication
 *
 * APIs for managing articles
 */
class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;
    protected $authorService;

    public function __construct(JWTAuth $jwt, AuthorService $authorService)
    {
        $this->jwt = $jwt;
        $this->authorService = $authorService;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
      'email'    => 'required|email|max:255',
      'password' => 'required',
    ]);

        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

    /**
    * Registers a new author
    *
    * @transformer \App\Transformers\AuthorTransformer
    * @transformerModel \App\Author
    *
    * @bodyParam name string required The name of the author.
    * @bodyParam email string required The email of the author.
    * @bodyParam github string required The github account of the author.
    * @bodyParam twitter string required The twitter handle of the author.
    * @bodyParam location string required The Address of the author.
    * @bodyParam password string required The password for the author account.
    */
    public function register(Request $request)
    {
        $validatedAuthor = $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:authors,email',
                'github' => 'required|email|unique:authors,github',
                'twitter' => 'required|string',
                'location' => 'required|string',
                'password' => 'required|string'
            ]
        );
        $authorData = $this->authorService->prepareCreate($validatedAuthor);

        $author = Author::create($authorData);

        $response = $this->authorService->fractalizeOne($author, new AuthorTransformer());

        return response()->json($response, Response::HTTP_CREATED);
    }
}

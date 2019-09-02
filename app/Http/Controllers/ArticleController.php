<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Services\ArticleService;
use App\Transformers\ArticleTransformer;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    protected $articleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles",
     *     summary="Get articles",
     *     operationId="getArticles",
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
        $paginator = Article::with('author')->paginate(5);

        $response =  $this->articleService->fractalizeAll($paginator, new ArticleTransformer);

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles/{id}",
     *     summary="Get single article",
     *     operationId="getSingleArticle",
     *     @OA\Parameter(
     *         description="ID of article to return",
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
     *         description="Returns a specific article's data",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        $response = $this->articleService->fractalizeOne($article, new ArticleTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/articles",
     *     @OA\RequestBody(
     *         description="Author object that needs to be added authors",
     *         required=true,
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Creates an author",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'subject' => 'required|string',
                'secondary_title' => 'required|string',
                'body' => 'required|string',
                'image' => 'image',
            ]
        );

        $article = $this->articleService->createArticle($request);

        $response = $this->articleService->fractalizeOne($article, new ArticleTransformer());

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/articles/{id}",
     *     @OA\Parameter(
     *         description="ID of article to be updated",
     *         in="path",
     *         name="articleId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Article object that needs to be updated",
     *         required=true,
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Creates an author",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validatedArticle = $this->validate(
            $request,
            [
                'subject' => 'required|string',
                'secondary_title' => 'required|string',
                'body' => 'required|string',
                'image' => 'nullable',
            ]
        );
        //TODO: image upload

        $article->update($validatedArticle);

        $response = $this->articleService->fractalizeOne($article, new ArticleTransformer());

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/articles/{id}",
     *     @OA\Parameter(
     *         description="ID of article to delete",
     *         in="path",
     *         name="articleId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Author object that needs to be added authors",
     *         required=true,
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Creates an author",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response()->json(null, Response::HTTP_OK);
    }
}

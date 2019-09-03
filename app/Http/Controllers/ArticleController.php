<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Services\ArticleService;
use App\Transformers\ArticleTransformer;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Articles
 *
 * APIs for managing articles
 */
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
    * Gets all articles
    * @authenticated
    * @transformer \App\Transformers\ArticleTransformer
    * @transformerModel \App\Article
    */
    public function index()
    {
        $paginator = Article::with('author')->paginate(5);

        $response =  $this->articleService->fractalizeAll($paginator, new ArticleTransformer);

        return response()->json($response, Response::HTTP_OK);
    }

    /**
    * Gets a single article
    * @authenticated
    * @transformer \App\Transformers\ArticleTransformer
    * @transformerModel \App\Article
    */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        $response = $this->articleService->fractalizeOne($article, new ArticleTransformer());

        return response()->json($response, Response::HTTP_OK);
    }


    /**
    * Creates an article
    *
    * @authenticated
    *
    * @transformer \App\Transformers\ArticleTransformer
    * @transformerModel \App\Article
    *
    * @bodyParam subject string required The title of the article.
    * @bodyParam secondary_title string required The secondary title of the article.
    * @bodyParam body string required The body of the article.
    * @bodyParam image file required an image to the article.
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
    * Updates an existing article
    *
    * @authenticated
    *
    * @transformer \App\Transformers\ArticleTransformer
    * @transformerModel \App\Article
    *
    * @bodyParam subject string required The title of the article.
    * @bodyParam secondary_title string required The secondary title of the article.
    * @bodyParam body string required The body of the article.
    * @bodyParam image file required an image to the article.
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
    * Deletes a single articles
    * @authenticated
    * @transformer \App\Transformers\ArticleTransformer
    * @transformerModel \App\Article
    */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return response()->json(['message' => 'Article was deleted successfully'], Response::HTTP_OK);
    }
}

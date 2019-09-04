<?php

use Illuminate\Http\UploadedFile;

class ArticleTest extends TestCase
{
    /**
     * /authors [GET]
     */
    public function testShouldReturnAllArticles()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');

        factory(App\Article::class, 2)->create();

        $this
            ->get('api/v1/articles')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'subject',
                        'secondary_title',
                        'body',
                        'author'
                    ]
                ],
            ]);
    }

    /**
     * /authors/id [GET]
     */
    public function testShouldReturnArticle()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');

        $article = factory(App\Article::class)->create();
        $this
            ->get("api/v1/articles/{$article->id}")
            ->seeStatusCode(200)
            ->seeJson([
                'id' => $article->id,
                'subject' => $article->subject,
                'secondary_title' => $article->secondary_title,
                'body' => $article->body,
                'author' => $article->author->name,
            ]);

        $data = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('created_at', $data['data']);
        $this->assertArrayHasKey('updated_at', $data['data']);
    }

    /**
     * /authors [POST]
     */
    public function testShouldCreateArticle()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');

        $body = factory('App\Article')->raw();
        $body['image'] = UploadedFile::fake()->image('avatar.jpg');
        
        

        $this
            ->post('/api/v1/articles', $body)
            ->seeStatusCode(201)
            ->seeJson(['subject' => $body['subject']])
            ->seeInDatabase('articles', ['subject' => $body['subject']]);
    }

    public function testShouldUpdateArticle()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');

        $article = factory(App\Article::class)->create();

        $body = [
            'subject' => 'Another subject',
            'secondary_title' => $article->secondary_title,
            'body' => $article->body,
            'image' => $article['image'],
        ];

        $this
            ->put("/api/v1/articles/{$article->id}", $body)
            ->seeJson($body)
            ->seeStatusCode(200);
    }

    public function testShouldDeleteArticle()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');

        $article = factory(App\Article::class)->create();

        $this
            ->delete("/api/v1/articles/{$article->id}")
            ->seeStatusCode(200)
            ->isEmpty();
        $this->notSeeInDatabase('articles', ['id' => $article->id]);
    }
}

<?php

use Illuminate\Http\UploadedFile;

class ArticleTest extends TestCase
{
    /**
     * /authors [GET]
     */
    public function testShouldReturnAllArticles()
    {
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
        factory(App\Author::class)->create();

        $body = [
            'subject' => 'A subject',
            'secondary_title' => 'secondary title to the article',
            'body' => 'this is a body to the article',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $this
            ->post('/api/v1/articles', $body)
            ->seeStatusCode(201)
            ->seeJson(['subject' => $body['subject']])
            ->seeInDatabase('articles', ['subject' => $body['subject']]);
    }

    public function testShouldUpdateArticle()
    {
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
        $article = factory(App\Article::class)->create();

        $this
            ->delete("/api/v1/articles/{$article->id}")
            ->seeStatusCode(200)
            ->isEmpty();
        $this->notSeeInDatabase('articles', ['id' => $article->id]);
    }
}

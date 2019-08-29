<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorTest extends TestCase
{
    /**
     * /authors [GET]
     */
    public function testShouldReturnAllAuthors()
    {
        $authors = factory(App\Author::class, 10)->create();
        $this
            ->get('api/v1/authors')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'name',
                        'email',
                        'github',
                        'twitter',
                        'location',
                        'latest_article_published'
                    ]
                ],
            ]);
    }

    /**
     * /authors/id [GET]
     */
    public function testShouldReturnAuthor()
    {
        $author = factory(App\Author::class)->create();
        $this
            ->get("api/v1/authors/{$author->id}")
            ->seeStatusCode(200)
            ->seeJson([
                'id' => $author->id,
                'name' => $author->name,
                'email' => $author->email,
                'github' => $author->github,
                'twitter' => $author->twitter,
                'location' => $author->location,
                'latest_article_published' => null,
            ]);

        $data = json_decode($this->response->getContent(), true);
        $this->assertArrayHasKey('created_at', $data['data']);
        $this->assertArrayHasKey('updated_at', $data['data']);
    }

    /**
     * /authors [POST]
     */
    public function testShouldCreateAuthor()
    {
        $body = [
            'name' => 'Nour',
            'email' => 'nour@email.com',
            'github' => 'nour@github.com',
            'twitter' => 'Kiks',
            'location' => 'Alexandria'
        ];

        $this
            ->post('/api/v1/authors', $body)
            ->seeStatusCode(201)
            ->seeJson(['email' => $body['email']])
            ->seeInDatabase('authors', ['email' => $body['email']]);
    }

    public function testShouldUpdateAuthor()
    {
        $author = factory(App\Author::class)->create();
        $body = [
            'name' => 'Hassan',
            'email' => $author->email,
            'github' => $author->github,
            'twitter' => $author->twitter,
            'location' => $author->location
        ];

        $this
            ->put("/api/v1/authors/{$author->id}", $body)
            ->seeStatusCode(200)
            ->seeJson($body)
            ->seeInDatabase('authors', ['name' => 'Hassan']);
    }

    public function testShouldDeleteAuthor()
    {
        $author = factory(App\Author::class)->create();

        $this
            ->delete("/api/v1/authors/{$author->id}")
            ->seeStatusCode(200)
            ->isEmpty();
        $this->notSeeInDatabase('authors', ['id' => $author->id]);
    }
}

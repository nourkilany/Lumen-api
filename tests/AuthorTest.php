<?php



class AuthorTest extends TestCase
{
    /**
     * /authors [GET]
     */
    public function testShouldReturnAllAuthors()
    {

        $this->actingAs(factory(App\Author::class)->create(), 'api');

        factory(App\Author::class, 10)->create();

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
        $this->actingAs(factory(App\Author::class)->create(), 'api');
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

    public function testShouldUpdateAuthor()
    {
        $this->actingAs(factory(App\Author::class)->create(), 'api');
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
        $this->actingAs(factory(App\Author::class)->create(), 'api');
        $author = factory(App\Author::class)->create();

        $this
            ->delete("/api/v1/authors/{$author->id}")
            ->seeStatusCode(200)
            ->isEmpty();
        $this->notSeeInDatabase('authors', ['id' => $author->id]);
    }
}

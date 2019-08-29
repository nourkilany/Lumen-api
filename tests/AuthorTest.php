<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldReturnAllProducts()
    {
        $this->get('api/v1/authors');

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'data' => [
                '*' =>
                [
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
}

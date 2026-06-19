<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL;

class BooksQuery extends Query
{
    protected $attributes = [
        'name' => 'books'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Book'));
    }

    public function resolve($root, array $args)
    {
        return [
            [
                "id" => 1,
                "title" => "Laskar Pelangi",
                "author" => "Andrea Hirata",
                "publisher" => "Bentang",
                "year" => 2005
            ],
            [
                "id" => 2,
                "title" => "Bumi",
                "author" => "Tere Liye",
                "publisher" => "Gramedia",
                "year" => 2014
            ]
        ];
    }
}
<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Book',
        'description' => 'Book Type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'title' => [
                'type' => Type::string(),
            ],
            'author' => [
                'type' => Type::string(),
            ],
            'publisher' => [
                'type' => Type::string(),
            ],
            'year' => [
                'type' => Type::int(),
            ],
        ];
    }
}
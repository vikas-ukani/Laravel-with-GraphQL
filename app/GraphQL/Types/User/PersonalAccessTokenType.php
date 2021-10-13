<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PersonalAccessTokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Token',
        'description' => 'Personal access token',
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'personal access token'
            ],
        ];
    }
}

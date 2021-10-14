<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Auth;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RegisterType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Auth/Register',
        'description' => 'A Register User type',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'An user id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'An user name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'An user email'
            ],
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Current personal access token'
            ],
        ];
    }
}

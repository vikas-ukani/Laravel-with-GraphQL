<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A User type',
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
            'tasks' => [
                'type' => Type::listOf(GraphQL::type('task')),
                'description' => 'The user tasks',
                'always' => ['title'],
            ],
            'token' => [
                'type' => GraphQL::type('token'),
                'description' => 'The user access token',
                'always' => ['token'],
            ],

        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}

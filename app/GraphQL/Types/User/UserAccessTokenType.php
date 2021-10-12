<?php

declare(strict_types=1);

namespace App\GraphQL\Types\User;

use GraphQL\Type\Definition\Type;
use Laravel\Sanctum\PersonalAccessToken;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserAccessTokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'access token',
        'description' => 'A User Access Token',
        'model' => PersonalAccessToken::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'An token id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'An token name'
            ],
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'An token string'
            ],

        ];
    }
}

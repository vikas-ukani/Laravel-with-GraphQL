<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LoginUserMutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('login');
    }

    public function args(): array
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8|max:255'],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        if (!auth()->attempt(['email' => $args['email'], 'password' => $args['password']])) {
            abort(401, 'Credentials does not match');
        }

        $user = auth()->user();
        $user['token'] = $user->createToken('API Token')->plainTextToken;
        return $user;
    }
}

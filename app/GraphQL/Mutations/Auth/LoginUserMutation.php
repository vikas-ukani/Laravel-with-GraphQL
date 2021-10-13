<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class LoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LoginUserMutation'
    ];

    public function type(): Type
    {
        return Type::string();
    }
   /* public function type(): Type
    {
        return GraphQL::type('user');
    }*/

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
            'password' => ['required', 'min:8|max:255'],
            'email' => ['required', 'email']
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        if (!auth()->attempt(['email' => $args['email'], 'password' => $args['password']])) {
            abort(401, 'Credentials does not match');
        }

        return auth()->user()->createToken('API Token')->plainTextToken;
    }


}

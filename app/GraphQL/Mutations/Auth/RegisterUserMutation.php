<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RegisterUserMutation'
    ];

    public function type(): Type
    {
        return Type::string();
    }
    /*  public function type(): Type
      {
          return GraphQL::type('user');
      }*/

    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'password' => ['required', 'min:8|max:255'],
            'email' => ['required', 'email', 'unique:users,email']
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::create(array_merge($args, [
            "password" => bcrypt($args['password']),
        ]));

        return $user->createToken('MyAppToken')->plainTextToken;
    }
}

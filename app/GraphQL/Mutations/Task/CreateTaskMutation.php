<?php

namespace App\GraphQL\Mutations\Task;


use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newTask'
    ];

    public function type(): Type
    {
        return GraphQL::type('task');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Task::create([
            'user_id' => auth()->id(),
            'title' => $args['title']
        ]);
    }
}

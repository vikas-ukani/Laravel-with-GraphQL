<?php

namespace App\GraphQL\Mutations\Task;


use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteTask',
        'description' => 'Delete a task'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $task = Task::find($args['id']);

        if ($task->user_id != auth()->id()) {
            abort(403, 'You are not authorized to preform this action');
        }
        return  $task->delete() ? true : false;
    }
}

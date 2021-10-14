<?php

namespace App\GraphQL\Mutations\Task;


use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateTaskStatusMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTaskStatus',
        'description' => 'Update task status'
    ];

    public function type(): Type
    {
        return GraphQL::type('task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::nonNull(Type::boolean()),
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

        $task->is_completed = $args['status'];
        $task->save();

        return $task;
    }
}

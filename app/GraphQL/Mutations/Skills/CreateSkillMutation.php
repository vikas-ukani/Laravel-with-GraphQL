<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Skills;

use App\Models\Skill;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateSkillMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateSkill',
        'description' => 'A mutation to create a new skills'
    ];

    public function type(): Type
    {
        return GraphQL::type('skill');
    }

    public function args(): array
    {
        return [
            'skill_title' => [
                'name' => 'skill_title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $skill = Skill::create($args);
        if (!$skill) {
            return null;
        }
        return $skill;
    }
}

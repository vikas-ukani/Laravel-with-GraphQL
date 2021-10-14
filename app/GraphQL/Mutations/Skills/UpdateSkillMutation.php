<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Skills;

use Closure;
use App\Models\Skill;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateSkillMutation extends Mutation
{
    protected $attributes = [
        'name' => 'skills/UpdateSkill',
        'description' => 'A mutation to update a skill'
    ];

    public function type(): Type
    {
        return GraphQL::type('skill');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'skill_title' => ['name' => 'skill_title', 'type' => Type::nonNull(Type::string())]

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $skill = Skill::find($args['id']);
        if (!$skill) return null;

        $skill->skill_title = $args['skill_title'];
        $skill->save(); 
        return $skill;
    }
}

<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Skill;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SkillType extends GraphQLType
{
    protected $attributes = [
        'name'              => 'skill',
        'description'       => 'A type of skills',
        'model'             => Skill::class,
    ];

    public function fields(): array
    {
        return [
            'id'                => [
                'type'          => Type::nonNull(Type::int()),
                'description'   => "The id field"
            ],
            'skill_title'       => [
                'type'          => Type::string(),
                'description'   => "The skill_title of the skills"
            ]
        ];
    }
}

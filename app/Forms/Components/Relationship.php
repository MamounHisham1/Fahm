<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\EntanglesStateWithSingularRelationship;

class Relationship extends Component
{
    use EntanglesStateWithSingularRelationship;

    protected string $view = 'forms.components.relationship';

    public static function make(?string $relationship): static
    {
        $instance = app(static::class);

        if ($relationship) {
            $instance->relationship($relationship);
        }

        return $instance;
    }
}

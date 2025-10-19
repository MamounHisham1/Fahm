<?php

namespace App\Enums;

enum AssignmentType: string
{
    case Text = 'text';
    case File = 'file';
    case Image = 'image';

    public function label(): string
    {
        return match ($this) {
            self::Text => 'Text',
            self::File => 'File',
            self::Image => 'Image',
        };
    }
}

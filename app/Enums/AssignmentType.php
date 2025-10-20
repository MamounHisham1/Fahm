<?php

namespace App\Enums;

enum AssignmentType: string
{
    case Text = 'text';
    case File = 'file';
    case Image = 'image';
}

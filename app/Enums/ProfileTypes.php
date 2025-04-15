<?php

namespace App\Enums;

enum ProfileTypes: string
{
    case Admin = 'admin';
    case Student = 'student';
    case Client = 'client';
}

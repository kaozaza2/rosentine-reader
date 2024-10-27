<?php

namespace App\Models;

enum PermissionLevel: int
{
    case MEMBER = 0;
    case MAINTAINER = 1;
    case ADMIN = 2;
}

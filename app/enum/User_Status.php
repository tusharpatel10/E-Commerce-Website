<?php

namespace App\enum;

enum User_Status: int
{
    case user_active = 1;
    case user_deactive = 0;
}

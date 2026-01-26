<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum ActivityType: string
{
    use EnumOptions;

    case Application = "application";
    case Interview  = "interview";
    case Follow_Up = "follow_up";
    case Offer = "offer";
    case Rejection = "rejection";
    case Asseessment = "assessment";
    case Networking = "networking";
}

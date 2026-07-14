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
    case Assessment = "assessment";
    case Networking = "networking";

    public function icon(): string
{
    return match ($this) {
        self::Application => 'document',
        self::Interview => 'chat-bubble-left',
        self::Assessment => 'academic-cap',
        self::Offer => 'check-circle',
        self::Follow_Up => 'mail',
        self::Networking => 'users',
        self::Rejection => 'x-mark',
    };
}

    public function badgeColor(): string
    {
        return match ($this) {
            self::Application => 'purple',
            self::Interview => 'green',
            self::Assessment => 'yellow',
            self::Offer => 'blue',
            self::Follow_Up => 'light',
            self::Networking => 'light',
            self::Rejection => 'red',
        };
    }
}



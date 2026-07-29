<?php

namespace Tests\Unit;

use App\Enums\ActivityType;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ActivityTypeTest extends TestCase
{
    #[Test]
    public function activity_type_enum_has_correct_values()
    {
        $this->assertEquals('application', ActivityType::Application->value);
        $this->assertEquals('interview', ActivityType::Interview->value);
        $this->assertEquals('follow_up', ActivityType::Follow_Up->value);
        $this->assertEquals('offer', ActivityType::Offer->value);
        $this->assertEquals('rejection', ActivityType::Rejection->value);
        $this->assertEquals('assessment', ActivityType::Assessment->value);
        $this->assertEquals('networking', ActivityType::Networking->value);
    }

    #[Test]
    public function activity_type_returns_correct_icons()
    {
        $this->assertEquals('document', ActivityType::Application->icon());
        $this->assertEquals('chat-bubble-left', ActivityType::Interview->icon());
        $this->assertEquals('academic-cap', ActivityType::Assessment->icon());
        $this->assertEquals('check-circle', ActivityType::Offer->icon());
        $this->assertEquals('mail', ActivityType::Follow_Up->icon());
        $this->assertEquals('users', ActivityType::Networking->icon());
        $this->assertEquals('x-mark', ActivityType::Rejection->icon());
    }

    #[Test]
    public function activity_type_returns_correct_badge_colours()
    {
        $this->assertEquals('purple', ActivityType::Application->badgeColor());
        $this->assertEquals('green', ActivityType::Interview->badgeColor());
        $this->assertEquals('yellow', ActivityType::Assessment->badgeColor());
        $this->assertEquals('blue', ActivityType::Offer->badgeColor());
        $this->assertEquals('light', ActivityType::Follow_Up->badgeColor());
        $this->assertEquals('light', ActivityType::Networking->badgeColor());
        $this->assertEquals('red', ActivityType::Rejection->badgeColor());
    }

    #[Test]
    public function activity_type_trait_returns_options_and_values()
    {
        $this->assertIsArray(ActivityType::options());
        $this->assertIsArray(ActivityType::values());

        $this->assertArrayHasKey('application', ActivityType::options());
        $this->assertContains('application', ActivityType::values());

        $this->assertCount(7, ActivityType::cases());
    }
}
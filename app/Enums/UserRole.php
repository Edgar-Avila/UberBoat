<?php

namespace App\Enums;

enum UserRole: string {
    case Passenger = 'passenger';
    case Driver = 'driver';

    public function isPassenger(): bool {
        return $this->value === self::Passenger->value;
    }

    public function isDriver(): bool {
        return $this->value === self::Driver->value;
    }
}
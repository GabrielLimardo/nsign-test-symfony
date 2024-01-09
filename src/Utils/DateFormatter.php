<?php

namespace App\Utils;

class DateFormatter
{
    public static function formatDate(?string $date): ?string
    {
        if ($date === null) {
            return null;
        }

        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);

        if ($dateTime instanceof \DateTime) {
            return $dateTime->format('Y-m-d');
        }

        return null;
    }
}

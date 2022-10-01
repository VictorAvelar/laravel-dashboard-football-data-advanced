<?php

namespace Avelar\FootballDataAdvanced;

class Config
{
    public const API_KEY = 'api_key';
    public const COMPETITIONS = 'competitions';
    public const FUTURE = 'future';
    public const PAST = 'past';
    public const PRIORITY = 'priority';
    protected const BASE = 'dashboard.tiles.football_data_advanced';

    public static function value(string $key)
    {
        return config(
            sprintf(
                '%s.%s',
                self::BASE,
                $key
            )
        );
    }
}

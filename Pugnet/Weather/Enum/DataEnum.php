<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Enum
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Enum;

/**
 * Class DataEnum
 *
 * @package Pugnet\Weather\Enum
 */
class DataEnum
{
    public const KELVIN_TEMP = 273.15;
    public const USER_DATA   = 'user_data';
    public const CITY        = 'city';
    public const TEMPERATURE = 'temperature';
    public const WEATHER_DATA = 'weather_data';

}

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
 * Class ConfigEnum
 *
 * @package Pugnet\Weather\Enum
 */
class ConfigEnum
{
    public const EQ = 'eq';
    public const CITY_COLUMN = 'city';
    public const TEMPERATURE_COLUMN = 'temperature';
    public const CREATE_DATE_COLUMN = 'create_date';
}

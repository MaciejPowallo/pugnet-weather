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
 * Class ApiEnum
 *
 * @package Pugnet\Weather\Enum
 */
class ApiEnum
{
    public const REQUEST_TIMEOUT = 2000;
    public const END_POINT_URL = 'api.openweathermap.org/data/2.5/weather?q=%s&appid=%s';
}

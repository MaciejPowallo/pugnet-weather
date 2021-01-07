<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Api
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Api;

/**
 * Interface WeatherManagementInterface
 * @package Pugnet\Weather\Api
 */
interface WeatherManagementInterface
{
    /**
     * @return object
     */
    public function getWeather();
}

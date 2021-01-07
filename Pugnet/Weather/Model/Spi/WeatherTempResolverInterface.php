<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Model
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */

namespace Pugnet\Weather\Model\Spi;

interface WeatherTempResolverInterface
{
    /**
     * Returns weather type
     *
     * @return float
     */
    public function resolve(): float;
}

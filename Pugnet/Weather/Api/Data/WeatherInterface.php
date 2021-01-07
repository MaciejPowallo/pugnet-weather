<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Api
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */

namespace Pugnet\Weather\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface WeatherInterface
 *
 * @package Pugnet\Weather\Api\Data
 */
interface WeatherInterface  extends ExtensibleDataInterface
{
    public const WEATHER_ID  = 'weather_id';
    public const CITY        = 'city';
    public const TEMPERATURE = 'temperature';
    public const CREATE_DATE = 'create_date';

    /**
     * Get weather_id
     * @return string|null
     */
    public function getWeatherId(): ?string;

    /**
     * Set weather_id
     *
     * @param string $weatherId
     * @return WeatherInterface
     */
    public function setWeatherId(string $weatherId): WeatherInterface;

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * Set city
     *
     * @param string $city
     * @return WeatherInterface
     */
    public function setCity(string $city): WeatherInterface;

    /**
     * Get temperature
     *
     * @return float|null
     */
    public function getTemperature(): float;

    /**
     * Set temperature
     *
     * @param float $temperature
     * @return WeatherInterface
     */
    public function setTemperature(float $temperature): WeatherInterface;

    /**
     * Get create_date
     *
     * @return string|null
     */
    public function getCreateDate(): ?string;

    /**
     * Set create_date
     *
     * @param string $createDate
     * @return WeatherInterface
     */
    public function setCreateDate(string $createDate): WeatherInterface;

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Pugnet\Weather\Api\Data\WeatherExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Pugnet\Weather\Api\Data\WeatherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Pugnet\Weather\Api\Data\WeatherExtensionInterface $extensionAttributes
    );
}

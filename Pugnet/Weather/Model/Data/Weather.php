<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Model
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Pugnet\Weather\Api\Data\WeatherExtensionInterface;
use Pugnet\Weather\Api\Data\WeatherInterface;

class Weather extends AbstractExtensibleObject implements WeatherInterface
{
    /**
     * @return string|null
     */
    public function getWeatherId(): ?string
    {
        return $this->_get(self::WEATHER_ID);
    }

    /**
     * @param string $weatherId
     * @return WeatherInterface
     */
    public function setWeatherId($weatherId): WeatherInterface
    {
        return $this->setData(self::WEATHER_ID, $weatherId);
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->_get(self::CITY);
    }

    /**
     * @param string $city
     * @return WeatherInterface
     */
    public function setCity($city): WeatherInterface
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->_get(self::TEMPERATURE);
    }

    /**
     * @param float $temperature
     * @return WeatherInterface
     */
    public function setTemperature(float $temperature): WeatherInterface
    {
        return $this->setData(self::TEMPERATURE, $temperature);
    }

    /**
     * @return string|null
     */
    public function getCreateDate(): ?string
    {
        return $this->_get(self::CREATE_DATE);
    }

    /**
     * @param string $createDate
     * @return WeatherInterface
     */
    public function setCreateDate($createDate): WeatherInterface
    {
        return $this->setData(self::CREATE_DATE, $createDate);
    }

    /**
     * @return \Pugnet\Weather\Api\Data\WeatherExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @param \Pugnet\Weather\Api\Data\WeatherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Pugnet\Weather\Api\Data\WeatherExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}

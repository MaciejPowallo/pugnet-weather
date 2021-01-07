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

namespace Pugnet\Weather\Model;

use Exception;
use Psr\Log\LoggerInterface;
use Pugnet\Weather\Api\Data\WeatherInterface;
use Pugnet\Weather\Api\Data\WeatherInterfaceFactory;
use Pugnet\Weather\Api\WeatherManagementInterface;
use Pugnet\Weather\Api\WeatherRepositoryInterface;
use Pugnet\Weather\Enum\DataEnum;

/**
 * Class WeatherData
 * @package Pugnet\Weather\Model
 */
class WeatherModel
{
    protected $logger;
    protected $management;
    protected $weatherFactory;
    protected $weatherRepository;
    protected $configProvider;

    /**
     * WeatherModel constructor.
     * @param LoggerInterface            $logger
     * @param WeatherManagementInterface $management
     * @param WeatherInterfaceFactory    $weatherFactory
     * @param WeatherRepositoryInterface $weatherRepository
     * @param ConfigProvider             $configProvider
     */
    public function __construct(
        LoggerInterface $logger,
        WeatherManagementInterface $management,
        WeatherInterfaceFactory $weatherFactory,
        WeatherRepositoryInterface $weatherRepository,
        ConfigProvider $configProvider
    ) {
        $this->logger            = $logger;
        $this->management        = $management;
        $this->weatherFactory    = $weatherFactory;
        $this->weatherRepository = $weatherRepository;
        $this->configProvider    = $configProvider;
    }

    /**
     * @return bool
     */
    public function importWeatherData(): bool
    {
        try {
            /** @var WeatherInterface $weather */
            $weather = $this->weatherFactory->create();

            $weather->setCity($this->configProvider->getCity());
            $weather->setTemperature($this->getTempCelsius());

            $this->weatherRepository->save($weather);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());

            return false;
        }

        return true;
    }

    /**
     * @return float
     */
    public function getTempKelvin(): float
    {
        return $this->management->getWeather()->main['temp'];
    }

    /**
     * @return float
     */
    public function getTempCelsius(): float
    {
        return $this->getTempKelvin() - DataEnum::KELVIN_TEMP;
    }

}

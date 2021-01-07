<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Cron
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Cron;

use Exception;
use Psr\Log\LoggerInterface;
use Pugnet\Weather\Model\WeatherModel;

/**
 * Class WeatherData
 *
 * @package Pugnet\Weather\Cron
 */
class WeatherData
{
    protected $logger;
    protected $weatherModel;

    /**
     * WeatherData constructor.
     *
     * @param LoggerInterface $logger
     * @param WeatherModel    $weatherModel
     */
    public function __construct(
        LoggerInterface $logger,
        WeatherModel $weatherModel
    ) {
        $this->logger       = $logger;
        $this->weatherModel = $weatherModel;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute(): void
    {
        try {
            $this->weatherModel->importWeatherData();
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}

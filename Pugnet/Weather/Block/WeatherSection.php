<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Block
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Block;

use Exception;
use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Pugnet\Weather\Enum\DataEnum;
use Pugnet\Weather\Model\ConfigProvider;
use Pugnet\Weather\Model\Spi\WeatherTempResolverInterface;

/**
 * Class Weather
 *
 * @package Pugnet\Weather\Block
 */
class WeatherSection implements SectionSourceInterface
{
    protected $configProvider;
    protected $resolver;
    protected $jsonSerializer;

    /**
     * WeatherSection constructor.
     * @param WeatherTempResolverInterface $resolver
     * @param ConfigProvider               $configProvider
     * @param Json                         $jsonSerializer
     */
    public function __construct(
        WeatherTempResolverInterface $resolver,
        ConfigProvider $configProvider,
        Json $jsonSerializer
    ) {
        $this->configProvider = $configProvider;
        $this->resolver       = $resolver;
        $this->jsonSerializer = $jsonSerializer;
    }

    /**
     * @return array
     */
    public function getSectionData(): array
    {
        $result = [];

        if ($this->isEnabled()) {
            $result[DataEnum::USER_DATA] = $this->prepareData();
        }

        return $result;
    }

    /**
     * @return bool
     */
    protected function isEnabled(): bool
    {
        return (bool)$this->configProvider->isEnabled();
    }

    /**
     * @return string
     */
    protected function prepareData(): string
    {
        try {
            $data = [
                DataEnum::CITY        => $this->configProvider->getCity(),
                DataEnum::TEMPERATURE => $this->resolver->resolve(),
            ];

            return $this->jsonSerializer->serialize([DataEnum::WEATHER_DATA => $data]);
        } catch (Exception $e) {
            return '';
        }
    }
}

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

use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Pugnet\Weather\Api\WeatherManagementInterface;
use Pugnet\Weather\Enum\ApiEnum;

/**
 * Class WeatherManagement
 *
 * @package Pugnet\Weather\ModelWeather
 */
class WeatherManagement implements WeatherManagementInterface
{
    protected $jsonSerializer;
    protected $configProvider;
    protected $curlFactory;

    /**
     * WeatherManagement constructor.
     *
     * @param Json           $jsonSerializer
     * @param ConfigProvider $configProvider
     */
    public function __construct(
        Json $jsonSerializer,
        CurlFactory $curlFactory,
        ConfigProvider $configProvider
    ) {
        $this->jsonSerializer = $jsonSerializer;
        $this->curlFactory    = $curlFactory;
        $this->configProvider = $configProvider;
    }

    /**
     * @param string $apiKey
     * @param string $city
     * @return object
     */
    public function getWeather(): object
    {
        return (object)$this->getResponseFromEndPoint();
    }

    /**
     * @return array
     */
    private function getResponseFromEndPoint(): array
    {
        return $this->jsonSerializer->unserialize($this->getResponse());
    }

    /**
     * @return string
     */
    private function getResponse(): string
    {
        /** @var \Magento\Framework\HTTP\Client\Curl $client */
        $client = $this->curlFactory->create();
        $client->setTimeout(ApiEnum::REQUEST_TIMEOUT);

        $client->get(sprintf(ApiEnum::END_POINT_URL,
            $this->configProvider->getCity(),
            $this->configProvider->getApiKey()
        ));

        return $client->getBody();
    }
}

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

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Pugnet\Weather\Api\Data\WeatherInterface;
use Pugnet\Weather\Api\Data\WeatherInterfaceFactory;
use Pugnet\Weather\Model\ResourceModel\Weather\Collection;

class Weather extends AbstractModel
{
    protected $_eventPrefix = 'pugnet_weather_weather';
    protected $weatherDataFactory;
    protected $dataObjectHelper;

    /**
     * Weather constructor.
     *
     * @param Context                 $context
     * @param Registry                $registry
     * @param WeatherInterfaceFactory $weatherDataFactory
     * @param DataObjectHelper        $dataObjectHelper
     * @param ResourceModel\Weather   $resource
     * @param Collection              $resourceCollection
     * @param array                   $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        WeatherInterfaceFactory $weatherDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Weather $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->weatherDataFactory = $weatherDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve weather model with weather data
     * @return WeatherInterface
     */
    public function getDataModel()
    {
        $weatherData = $this->getData();

        $weatherDataObject = $this->weatherDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $weatherDataObject,
            $weatherData,
            WeatherInterface::class
        );

        return $weatherDataObject;
    }
}

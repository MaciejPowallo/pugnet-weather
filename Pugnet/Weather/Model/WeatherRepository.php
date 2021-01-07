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
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Pugnet\Weather\Api\Data\WeatherInterface;
use Pugnet\Weather\Api\Data\WeatherInterfaceFactory;
use Pugnet\Weather\Api\Data\WeatherSearchResultsInterface;
use Pugnet\Weather\Api\Data\WeatherSearchResultsInterfaceFactory;
use Pugnet\Weather\Api\WeatherRepositoryInterface;
use Pugnet\Weather\Model\ResourceModel\Weather as ResourceWeather;
use Pugnet\Weather\Model\ResourceModel\Weather\CollectionFactory as WeatherCollectionFactory;

/**
 * Class WeatherRepository
 *
 * @package Pugnet\Weather\Model
 */
class WeatherRepository implements WeatherRepositoryInterface
{
    private $storeManager;
    private $collectionProcessor;
    protected $dataObjectProcessor;
    protected $extensibleDataObjectConverter;
    protected $weatherCollectionFactory;
    protected $searchResultsFactory;
    protected $dataWeatherFactory;
    protected $weatherFactory;
    protected $extensionAttributesJoinProcessor;
    protected $resource;
    protected $dataObjectHelper;

    /**
     * @param ResourceWeather                      $resource
     * @param WeatherFactory                       $weatherFactory
     * @param WeatherInterfaceFactory              $dataWeatherFactory
     * @param WeatherCollectionFactory             $weatherCollectionFactory
     * @param WeatherSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper                     $dataObjectHelper
     * @param DataObjectProcessor                  $dataObjectProcessor
     * @param StoreManagerInterface                $storeManager
     * @param CollectionProcessorInterface         $collectionProcessor
     * @param JoinProcessorInterface               $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter        $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceWeather $resource,
        WeatherFactory $weatherFactory,
        WeatherInterfaceFactory $dataWeatherFactory,
        WeatherCollectionFactory $weatherCollectionFactory,
        WeatherSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource                         = $resource;
        $this->weatherFactory                   = $weatherFactory;
        $this->weatherCollectionFactory         = $weatherCollectionFactory;
        $this->searchResultsFactory             = $searchResultsFactory;
        $this->dataObjectHelper                 = $dataObjectHelper;
        $this->dataWeatherFactory               = $dataWeatherFactory;
        $this->dataObjectProcessor              = $dataObjectProcessor;
        $this->storeManager                     = $storeManager;
        $this->collectionProcessor              = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter    = $extensibleDataObjectConverter;
    }

    /**
     * @param WeatherInterface $weather
     * @return WeatherInterface
     * @throws CouldNotSaveException
     */
    public function save(WeatherInterface $weather)
    {

        $weatherData = $this->extensibleDataObjectConverter->toNestedArray(
            $weather,
            [],
            WeatherInterface::class
        );

        $weatherModel = $this->weatherFactory->create()->setData($weatherData);

        try {
            $this->resource->save($weatherModel);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the weather data: %1', $exception->getMessage()));
        }

        return $weatherModel->getDataModel();
    }

    /**
     * @param string $weatherId
     * @return WeatherInterface
     * @throws NoSuchEntityException
     */
    public function get($weatherId)
    {
        $weather = $this->weatherFactory->create();
        $this->resource->load($weather, $weatherId);

        if (!$weather->getId()) {
            throw new NoSuchEntityException(__('Weather data with id "%1" does not exist.', $weatherId));
        }

        return $weather->getDataModel();
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return WeatherSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->weatherCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            WeatherInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];

        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param WeatherInterface $weather
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(WeatherInterface $weather): bool
    {
        try {
            $weatherModel = $this->weatherFactory->create();
            $this->resource->load($weatherModel, $weather->getWeatherId());
            $this->resource->delete($weatherModel);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete the weather data: %1', $exception->getMessage()));
        }

        return true;
    }

    /**
     * @param string $weatherId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($weatherId): bool
    {
        return $this->delete($this->get($weatherId));
    }
}

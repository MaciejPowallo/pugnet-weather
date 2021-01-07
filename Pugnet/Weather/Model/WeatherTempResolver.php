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

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Data\Collection;
use Pugnet\Weather\Api\WeatherRepositoryInterface;
use Pugnet\Weather\Enum\ConfigEnum;
use Pugnet\Weather\Model\Spi\WeatherTempResolverInterface;

/**
 * Class WeatherTempResolver
 *
 * @package Pugnet\Weather\Model
 */
class WeatherTempResolver implements WeatherTempResolverInterface
{
    protected $searchCriteriaBuilder;
    protected $filterBuilder;
    protected $sortOrderBuilder;
    protected $weatherRepository;
    protected $configProvider;

    /**
     * WeatherTempResolver constructor.
     * @param SearchCriteriaBuilder      $searchCriteriaBuilder
     * @param FilterBuilder              $filterBuilder
     * @param SortOrderBuilder           $sortOrderBuilder
     * @param WeatherRepositoryInterface $weatherRepository
     * @param ConfigProvider             $configProvider
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        WeatherRepositoryInterface $weatherRepository,
        ConfigProvider $configProvider
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder         = $filterBuilder;
        $this->sortOrderBuilder      = $sortOrderBuilder;
        $this->weatherRepository     = $weatherRepository;
        $this->configProvider        = $configProvider;
    }

    /**
     * @return float
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function resolve(): float
    {
        $filter = $this->filterBuilder
            ->setField(ConfigEnum::CITY_COLUMN)
            ->setConditionType(ConfigEnum::EQ)
            ->setValue($this->configProvider->getCity())
            ->create();

        $sortOrder = $this->sortOrderBuilder
            ->setDirection(Collection::SORT_ORDER_DESC)
            ->setField(ConfigEnum::CREATE_DATE_COLUMN)
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$filter])
            ->addSortOrder($sortOrder)
            ->setPageSize(1)
            ->create();

        $result  = $this->weatherRepository->getList($searchCriteria)->getItems();
        $weather = array_pop($result);

        return $weather->getTemperature();
    }
}

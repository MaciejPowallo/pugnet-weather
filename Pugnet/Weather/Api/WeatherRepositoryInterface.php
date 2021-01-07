<?php
/**
 * @category     Pugnet
 * @package      Pugnet_Weather
 * @subpackage   Api
 * @author       Maciej Powallo <maciej.powallo@gmail.com>
 * @copyright    2021 Pugnet
 * @since        1.0.0
 */
declare(strict_types=1);

namespace Pugnet\Weather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pugnet\Weather\Api\Data\WeatherInterface;
use Pugnet\Weather\Api\Data\WeatherSearchResultsInterface;

/**
 * Interface WeatherRepositoryInterface
 *
 * @package Pugnet\Weather\Api
 */
interface WeatherRepositoryInterface
{
    /**
     * Save Weather
     *
     * @param WeatherInterface $weather
     * @return WeatherInterface
     * @throws LocalizedException
     */
    public function save(WeatherInterface $weather);

    /**
     * Retrieve Weather
     *
     * @param string $weatherId
     * @return WeatherInterface
     * @throws LocalizedException
     */
    public function get(string $weatherId);

    /**
     * Retrieve Weather matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return WeatherSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Weather
     *
     * @param WeatherInterface $weather
     * @return bool
     * @throws LocalizedException
     */
    public function delete(WeatherInterface $weather): bool;

    /**
     * Delete Weather by ID
     *
     * @param string $weatherId
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($weatherId): bool;
}

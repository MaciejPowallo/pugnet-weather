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

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface WeatherSearchResultsInterface
 *
 * @package Pugnet\Weather\Api\Data
 */
interface WeatherSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Weather list.
     * @return WeatherInterface[]
     */
    public function getItems(): array;

    /**
     * Set city list.
     * @param WeatherInterface[] $items
     * @return $this
     */
    public function setItems(array $items): array;
}

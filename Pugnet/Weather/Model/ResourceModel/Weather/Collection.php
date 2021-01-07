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

namespace Pugnet\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Pugnet\Weather\Model\ResourceModel\Weather as WeatherModel;
use Pugnet\Weather\Model\Weather;

/**
 * Class Collection
 *
 * @package Pugnet\Weather\Model\ResourceModel\Weather
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'weather_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            Weather::class,
            WeatherModel::class
        );
    }
}


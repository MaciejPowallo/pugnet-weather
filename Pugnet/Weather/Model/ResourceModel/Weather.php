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

namespace Pugnet\Weather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Weather
 *
 * @package Pugnet\Weather\Model\ResourceModel
 */
class Weather extends AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('pugnet_weather_weather', 'weather_id');
    }
}

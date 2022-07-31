<?php

namespace Loop\TrackCart\Model\ResourceModel\Tracker;

use Loop\TrackCart\Model\ResourceModel\TrackerResource;
use Loop\TrackCart\Model\Tracker;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Tracker::class, TrackerResource::class);
    }
}

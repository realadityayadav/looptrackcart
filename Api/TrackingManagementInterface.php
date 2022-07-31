<?php

namespace Loop\TrackCart\Api;
use Loop\TrackCart\Api\TrackerInterface;
interface TrackingManagementInterface
{

    /**
     * supply tracking records info
     * @return \Loop\TrackCart\Api\TrackerInterface[] Array of items.
     */
    public function getList();
}

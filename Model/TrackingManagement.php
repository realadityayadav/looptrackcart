<?php

namespace Loop\TrackCart\Model;

use Loop\TrackCart\Api\TrackerInterface;
use Loop\TrackCart\Model\ResourceModel\Tracker\Collection;
use Loop\TrackCart\Model\ResourceModel\Tracker\CollectionFactory;
use Loop\TrackCart\Model\ResourceModel\TrackerResource;

class TrackingManagement implements \Loop\TrackCart\Api\TrackingManagementInterface
{
    /**
     * @var CollectionFactory
     */
    private $_collectionFactory;
    /**
     * @var TrackerResource
     */
    private $_trackerResource;

    public function __construct(CollectionFactory $collectionFactory,TrackerResource $trackerResource)
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_trackerResource = $trackerResource;
    }

    /**
     * @return array
     */
    public function getList()
    {
        /** @var Collection $collection */
        $collection = $this->_collectionFactory->create();
        return $collection->getItems();
    }

    /**
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(TrackerInterface $tracker)
    {
        $this->_trackerResource->save($tracker);

        return $tracker;
    }
}

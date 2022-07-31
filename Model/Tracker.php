<?php

namespace Loop\TrackCart\Model;

use Loop\TrackCart\Api\TrackerInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Tracker extends AbstractModel implements TrackerInterface
{
    protected function _construct()
    {
        $this->_init(\Loop\TrackCart\Model\ResourceModel\TrackerResource::class);
    }

    public function setSku($sku)
    {
        $this->setData(self::SKU,$sku);
        return $this;
    }

    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    public function setTrackingCode($trackingCode)
    {
        $this->setData(self::TRACKING_CODE,$trackingCode);
        return $this;
    }

    public function getTrackingCode()
    {
        return $this->getData(self::TRACKING_CODE);
    }

    public function setTrackingMessage($trackingMessage)
    {
        $this->setData(self::TRACKING_MESSAGE,$trackingMessage);
        return $this;
    }

    public function getTrackingMessage()
    {
        return $this->getData(self::TRACKING_MESSAGE);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
}

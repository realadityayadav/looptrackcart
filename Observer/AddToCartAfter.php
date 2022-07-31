<?php

namespace Loop\TrackCart\Observer;
use Loop\TrackCart\Model\Tracker;
use Loop\TrackCart\Model\TrackerFactory;
use Loop\TrackCart\Model\TrackingManagement;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;

class AddToCartAfter implements ObserverInterface
{
    const ENDPOINT = "https://supertracking.view.agentur-loop.com/trackme";

    /**
     * @var Curl
     */
    private $_curl;
    /**
     * @var TrackerFactory
     */
    private $_trackerFactory;
    /**
     * @var TrackingManagement
     */
    private $_trackingManagement;
    /**
     * @var LoggerInterface
     */
    private $_logger;

    public function __construct(
        Curl $curl,
        TrackingManagement $trackingManagement,
        TrackerFactory $trackerFactory,
        LoggerInterface $logger
    )
    {
        $this->_curl = $curl;
        $this->_trackingManagement = $trackingManagement;
        $this->_trackerFactory = $trackerFactory;
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        /** @var ProductInterface $product */
        $product = $observer->getEvent()->getProduct();
        $jsonBody = [
            "sku" => $product->getSku(),
            "price" => $product->getFinalPrice(),
        ];
        try {
            $this->_curl->post(self::ENDPOINT, json_encode($jsonBody));
            $result = json_decode($this->_curl->getBody(), true);
            if (isset($result["code"], $result["message"])) {
                /** @var Tracker $tracker */
                $tracker = $this->_trackerFactory->create();
                $tracker->setSku($product->getSku())
                    ->setTrackingCode($result["code"])
                    ->setTrackingMessage($result["message"]);
                $this->_trackingManagement->save($tracker);
            }
        } catch (AlreadyExistsException|\Exception $e) {
            $message = __("Tracking Couldn't be saved for Sku ".$product->getSku()."due to ". $e->getMessage());
            $this->_logger->error($message,[$e]);
        }

        return $observer;
    }
}

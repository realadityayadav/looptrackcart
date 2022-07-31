<?php

namespace Loop\TrackCart\Api;

interface TrackerInterface {

    const SKU = "sku";
    const TRACKING_CODE = "tracking_code";
    const TRACKING_MESSAGE = "tracking_message";
    const CREATED_AT = "created_at";

    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @param $trackingCode
     * @return mixed
     */
    public function setTrackingCode($trackingCode);

    /**
     * @return mixed
     */
    public function getTrackingCode();

    /**
     * @param $trackingMessage
     * @return mixed
     */
    public function setTrackingMessage($trackingMessage);

    /**
     * @return mixed
     */
    public function getTrackingMessage();

    /**
     * @return mixed
     */
    public function getCreatedAt();

}

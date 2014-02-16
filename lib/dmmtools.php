<?php

class DmmTools {

    protected $prefix_url = 'http://affiliate-api.dmm.com/?';

    protected $api_id = '';
    protected $affiliate_id = '';
    protected $operation = 'ItemList';
    protected $version = '2.00';

    // require urlencode (2012-01-13 14:08:16)
    protected $timestamp = '2012-01-13%2014%3A08%3A16';

    // 'DMM.co.jp'(R-18) or 'DMM.com'(normally)
    protected $site = 'DMM.co.jp';
    protected $service = '';
    protected $floor = '';

    // 20(init), min:1, max:100
    protected $hits = 20;
    protected $offset = 1;

    // rank(init), +price,-price, date, review
    protected $sort = 'rank';

    protected $keyword = '';

    public $url;
    public $xml;

    public function __construct() {
        $this->api_id = DMM_API_ID;
        $this->affiliate_id = DMM_AFFILIATE_ID;
        $this->timestamp = urlencode(date('Y-m-d H:i:s'));
    }

    public function setService($service) {
        $this->service = $service;
        return $this;
    }

    public function setFloor($floor) {
        $this->floor = $floor;
        return $this;
    }

    public function setHits($hits) {
        $this->hits = $hits;
        return $this;
    }

    public function createUrl() {
        $url = $this->prefix_url;
        $url .= 'api_id='.$this->api_id.'&';
        $url .= 'affiliate_id='.$this->affiliate_id.'&';
        $url .= 'operation='.$this->operation.'&';
        $url .= 'version='.$this->version.'&';
        $url .= 'timestamp='.$this->timestamp.'&';
        $url .= 'site='.$this->site.'&';
        $url .= 'service='.$this->service.'&';
        $url .= 'floor='.$this->floor.'&';
        $url .= 'hits='.$this->hits.'&';
        $url .= 'offset='.$this->offset.'&';
        $url .= 'sort='.$this->sort.'&';
        $url .= 'keyword='.$this->keyword;
        $this->url = $url;
        return $this;
    }


    public function echoUrl() {
        echo $this->url;
    }

    public function exec() {
        $url = $this->url;
        $xml = simplexml_load_file($url)
            or die("XMLパースエラー");
        $this->xml = $xml;
        return $xml;
    }

    public function getTitle($item) {
        return (string)$item->title;
    }

    public function getURL($item) {
        return (string)$item->URL;
    }

    public function getPrice($item) {
        return (int)$item->prices->price;
    }

    public function getImageBig($item) {
        return (string)$item->imageURL->large;
    }

    public function getImageSmall($item) {
        return (string)$item->imageURL->small;
    }

    public function getImageList($item) {
        return (string)$item->imageURL->list;
    }

    public function getResultCount($response) {
        return (int)$response->result->result_count;
    }
}
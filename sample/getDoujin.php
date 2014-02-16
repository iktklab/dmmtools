<?php

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/../lib/dmmtools.php';

$dmm = new Dmmtools();
$response = $dmm->setService('doujin')
                 ->setFloor('doujin')
                 ->createUrl()
                 ->exec();

foreach ($response->result->items->item as $item) {
    $data['title'] = $dmm->getTitle($item);
    $data['img'] = $dmm->getImageBig($item);
    $data['price'] = $dmm->getPrice($item);
    $datas[] = $data;
}

var_dump($datas);

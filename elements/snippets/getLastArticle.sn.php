<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = $modx->resource->get('id');

$linkId = array();

$where = array(
    'value' => $id
    , 'tmplvarid' => 52
);
$tv = $modx->getCollection('modTemplateVarResource', $where);




foreach ($tv as $value) {


    $linkId[] = $value->get('contentid');
}



$criteria = $modx->newQuery('modResource');
$criteria->where(array(
    'id:IN' => $linkId
));
$criteria->sortby('publishedon', 'DESC');
$criteria->limit(1);

$res = $modx->getObject('modResource', $criteria);

if (!$res) {
    return false;
} else {
    $resname = $res->get('longtitle');
    $reslink = $res->get('alias') . '.html';

    $output .= "<a class='dir-block-produstion' href=\" $reslink\">
    <img src='[[+tv.photo_news]]' alt=''>
    <p class='text-dir-block'>" . $resname . "</p>
</a>";




    return $output;
}



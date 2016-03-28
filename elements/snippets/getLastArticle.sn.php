<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$output = '';

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
    $criteria = $modx->newQuery('modResource');
    $criteria->where(array(
        'parent' => 334
    ));
    $criteria->sortby('publishedon', 'DESC');
    $criteria->limit(1);

    $res = $modx->getObject('modResource', $criteria);

    $resname = $res->get('longtitle');
    $reslink = $res->get('alias') . '.html';

    $id = $res->get('id');
    $where = array(
        'contentid' => $id
        , 'tmplvarid' => 3
    );
    $tv = $modx->getObject('modTemplateVarResource', $where);
    $resimage = $tv->get('value');

    $output .= "<a class='dir-block-produstion' href=\" $reslink\">
    <img src=\"$resimage\"/>
    <p class='text-dir-block'>" . $resname . "</p>
</a>";
} else {
    $resname = $res->get('longtitle');
    $reslink = $res->get('alias') . '.html';

    $id = $res->get('id');
    $where = array(
        'contentid' => $id
        , 'tmplvarid' => 3
    );
    $tv = $modx->getObject('modTemplateVarResource', $where);
    $resimage = $tv->get('value');

    $output .= "<a class='dir-block-produstion' href=\" $reslink\">
    <img src=\"$resimage\"/>
    <p class='text-dir-block'>" . $resname . "</p>
</a>";
}


return $output;

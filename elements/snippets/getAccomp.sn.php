<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = $modx->resource->get('id');

$q = $modx->newQuery('msProductLink', array('link' => 3, 'master' => $id));
$q->select('slave');
$resources = array();
$output = '';
if ($q->prepare() && $q->stmt->execute()) {
    $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($ids as $key => $value) {
        $res = $modx->getObject('modResource', $value);
        $resname = $res->get('pagetitle');
        $reslink = $res->get('alias') . '.html';


        $id = $res->get('id');
        $where = array(
            'contentid' => $id
            , 'tmplvarid' => 4
        );
        $tv = $modx->getObject('modTemplateVarResource', $where);
        $resimage = $tv->get('value');


        $output .= "<a href=\" $reslink\">
            <img src=\"$resimage\"/>
            <p>" . $resname . "</p>
        </a>";
    }
}

//if (!$output) {
//$output = "573';
//}

echo $output;


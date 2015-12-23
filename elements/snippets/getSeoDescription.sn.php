<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$id = $modx->resource->get('id');

$where = array(
    'contentid' => $id,
    'tmplvarid' => 1
);

$output = '';


$tv = $modx->getObject('modTemplateVarResource', $where);

if (!empty($tv)) {
    $output = $tv->get('value');
}
else {
   $output = $modx->resource->get('pagetitle'); 
}


return $output;
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$output = '';  //строка для вывода чанка

$id = $modx->resource->get('id'); //текущий ресурс
//$output = getArticles($id, $modx);

$where = array(
    'value' => $id
    , 'tmplvarid' => 52
);
$tv = $modx->getCollection('modTemplateVarResource', $where);

if ($tv) {
    echo getLastArticleThis($id, $modx);
} else {
    getParents($id, $modx);
}

// Функция поиска родителя.

function getParents($resid, $modx) {
    $page = $modx->getObject('modResource', $resid);
    $parentid = $page->get('parent'); // определяем родителя

    if ($parentid) {
        if (getArticlesTest($parentid, $modx)) {
            echo getLastArticleThis($parentid, $modx);
        } else {
            getParents($parentid, $modx);
        }
    } else {

        echo getLastArticleSource($modx);
    }
}

//Функция поиска статей по ресурсу

function getArticlesTest($resid, $modx) {
    $where = array(
        'value' => $resid
        , 'tmplvarid' => 52
    );
    $tv = $modx->getCollection('modTemplateVarResource', $where);

    if ($tv) {
        return $resid;
    } else {
        return false;
    }
}

// Функция вывода крайней статьи по всему сайту

function getLastArticleSource($modx) {
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

    return "<a class='dir-block-produstion' href=\" $reslink\">
    <img src=\"$resimage\"/>
    <p class='text-dir-block'>" . $resname . "</p>
</a>";
}

// Функция вывода крайней статьи по ресурсу

function getLastArticleThis($id, $modx) {
    $linkId = array();

    $where = array(
        'value' => $id
        , 'tmplvarid' => 52
    );
    $tv = $modx->getCollection('modTemplateVarResource', $where);
    if ($tv) {
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
        $resname = $res->get('longtitle');
        $reslink = $res->get('alias') . '.html';

        $id = $res->get('id');
        $where = array(
            'contentid' => $id
            , 'tmplvarid' => 3
        );
        $tv = $modx->getObject('modTemplateVarResource', $where);
        $resimage = $tv->get('value');

        return "<a class='dir-block-produstion' href=\" $reslink\">
    <img src=\"$resimage\"/>
    <p class='text-dir-block'>" . $resname . "</p>
</a>";
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// проверяем нужное событие
if ($modx->event->name != 'OnFileManagerUpload') {
    return;
}
// подключаем phpthumb
require_once MODX_CORE_PATH . 'model/phpthumb/phpthumb.class.php';
// настройки плагина
$config = array(
    'assets/img/products_150x130/' => array(
        'src' => array('w' => 150, 'h' => 130, 'zc' => 1, 'bg' => '#fff', 'q' => 90),
    ),
     'assets/img/product/' => array(
        'src' => array('w' => 330, 'h' => 330, 'zc' => 1, 'bg' => '#fff', 'q' => 90),
    ),
   
);
// параметры загружаемого файла
$file = $modx->event->params['files']['file'];
$directory = $modx->event->params['directory'];
// получаем media source
$ms = $modx->event->params['source'];
if ($ms == null) {
    return;
}
// настройки media source
$msProperties = $ms->get('properties');
$directory = $msProperties['basePath']['value'] . $directory;
// на всякий случай проверяем наличие // и заменяем на /
$directory = str_replace('//', '/', $directory);
// смотрим, что при загрузке не возникло ошибок
if ($file['error'] != 0) {
    return;
}
$name = $file['name'];
$extensions = explode(',', $modx->getOption('upload_images'));
// проверям, что наша категория задана в настройках плагина
if (array_key_exists($directory, $config)) {
    $config = $config[$directory];
} else {
    return;
}
// путь к файлу, имя файла, расширение
$filename = MODX_BASE_PATH . $directory . $name;
$def_fn = pathinfo($name, PATHINFO_FILENAME);
$ext = pathinfo($name, PATHINFO_EXTENSION);
// проверяем, что расширение файла задано в настройках MODX, как изображение
if (in_array($ext, $extensions)) {
    $sizes = getimagesize($filename);
    $format = substr($sizes['mime'], 6);
    // бежим по всем полям массива с конфигом
    foreach ($config as $imgKey => $imgConfig) {
        $options = '';
        if ($imgKey == 'src') {
            // для ключа src имя файла совпадает с исходным
            $imgName = $filename;
        } else {
            // формируем имя файла
            //$imgName = MODX_BASE_PATH.$directory.$def_fn.'.'.$ext.'.'.$imgKey.'.'.$ext;
            $imgName = MODX_BASE_PATH . $directory . $def_fn . '_' . $imgKey . '.' . $ext;
        }
        // создаем объект phpThumb..
        $phpThumb = new phpThumb();
        // ..и задаем параметры
        $phpThumb->setSourceFilename($filename);
        foreach ($imgConfig as $k => $v) {
            $phpThumb->setParameter($k, $v);
        }
        // генерируем файл
        if ($phpThumb->GenerateThumbnail()) {
            if ($phpThumb->RenderToFile($imgName)) {
                // устанавливаем права на файл, это опционально, зависит от сервера
                chmod($imgName, 0666);
            }
        }
    }
}

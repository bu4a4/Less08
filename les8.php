<?php

function scan_directory_recursive($path, $nesting_level = 0): array
{
    $result = [];
    if (!file_exists($path)) {
        return $result;
    }
// была произведена проверка на правильность пути



    $files = scandir($path);


    //Возвращает array, содержащий имена файлов и каталогов, расположенных по пути, переданном в параметре

        $item = [
        'type' => '',
        'name' => '',
        'path' => '',
        'level' => $nesting_level,
        'children' => []
    ];




    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        // Вычищает массив от значений . и ..




        $file_path = $path . DIRECTORY_SEPARATOR . $file;


        $item['name'] = $file;
        $item['path'] = $file_path;

        if (is_dir($file_path)) {  // Если файл является дериктироий то "d"
            $item['type'] = 'd';
            $item['children'] = scan_directory_recursive($file_path, $nesting_level + 1); // запуск рекурсии
        } else {
            $item['type'] = 'f'; // А если нет то f
        }




        $result[] = $item;
    }





    return $result;
}

$files_list = scan_directory_recursive('/home/white-rebbit/Hosts/homeworks.local/');

$files_list_serialized = serialize($files_list);

print_r($files_list); // вывод информации

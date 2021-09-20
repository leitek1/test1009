<?php
class Pageloader
{
    public static function load(string $pageName, array $data)
    {
        extract($data);
        include "Pages/$pageName.php";
        die;
    }
}

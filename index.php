<?php

declare(strict_types=1);

require_once __DIR__ . '/Database.php';

$host = 'localhost';
$dbname = 'misha_db';
$user = 'misha';
$password = 'j2BdpuLmZAjP>Yio';

$db = new Database($host, $dbname, $user, $password);
$db->connect();

$area = match ($_GET['area'] ?? '') {
    'area1' => Areas::AREA1,
    'area2' => Areas::AREA2,
    'area3' => Areas::AREA3,
    default => null,
};

if ($area !== null) {
    $region = $db->getRegionByArea($area);
    if ($region !== null) {
        echo $region;
    } else {
        echo 'Регион не найден.';
    }
} else {
    echo 'Неверная область.';
}

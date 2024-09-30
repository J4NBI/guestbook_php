<?php


require_once __DIR__ . '/inc/functions.php';
require_once __DIR__ . '/inc/db-connect.php';


// GET COUNT ENTRIES

$stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM `entries`');
$stmt->execute();
$countEntries = $stmt->fetch(PDO::FETCH_ASSOC);
$countEntries = $countEntries['count'];

$currentPage = max(1, @(int) ($_GET['page'] ?? 1));
$pagination = 4;
$pages = 0;

if ($countEntries === 0){
    $pages = 0;
}
else {
    $pages = ceil($countEntries / $pagination);
};

// GET ENTRIES

$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `id` DESC LIMIT :offset, :perpage');
$stmt->bindValue('perpage', $pagination, PDO::PARAM_INT);
$stmt->bindValue('offset', ($currentPage - 1) * $pagination, PDO::PARAM_INT);
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);


// 

require __DIR__ . '/views/index-view.php';
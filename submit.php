<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';


if (!empty($_POST) && !empty($_POST['content'])) {
  $name = e($_POST['name'] ? : "");
  $title = e($_POST['title'] ? : "");
  $content = e($_POST['content'] ? : "");

  $stmt = $pdo->prepare('INSERT INTO entries (`name`, `title`, `content`) VALUES (:nameEntry, :title, :content)');
  $stmt->bindValue('nameEntry', $name, PDO::PARAM_STR);
  $stmt->bindValue('title', $title, PDO::PARAM_STR);
  $stmt->bindValue('content', $content, PDO::PARAM_STR);
  $stmt->execute();

  header('Location: index.php?success=1');
  die();
} 


$errorMessage = "Bitte Felder ausfüllen!";
require __DIR__ . '/index.php';

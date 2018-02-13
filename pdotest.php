<?php
require './PDOUtil.php';

updateCounter();

//changeToNewDay();

$conn = getConnection();
$stmt = $conn->prepare('SELECT total, today, yesterday from counter');
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

while($row = $stmt->fetch()) {
    print_r($row);
}
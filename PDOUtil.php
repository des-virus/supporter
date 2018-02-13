<?php

function getConnection() {
    $host = "localhost";
    $dbname = "chatbot";
    $username = "root";
    $password = "";
    return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}

function updateCounter() {
    $conn = getConnection();

    $stmt = $conn->prepare("UPDATE counter set total = total + 1");
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE counter set today = today + 1");
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE counter set this_week = this_week + 1");
    $stmt->execute();

    $conn = null;
}

function changeToNewDay() {
    // Update today -> yesterday
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE counter set yesterday = today");
    $stmt->execute();

    // update today -> 0
    $stmt = $conn->prepare("UPDATE counter set today = 0");
    $stmt->execute();
}

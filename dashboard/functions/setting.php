<?php
function get_setting($key)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT value FROM settings WHERE `key` = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    return $result ? $result['value'] : null;
}

function update_setting($key, $value)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO settings (`key`, `value`) VALUES (?, ?)
                           ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)");
    return $stmt->execute([$key, $value]);
}

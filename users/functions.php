<?php

function validate($string = ''): string
{
    $clean = trim(strip_tags($string));
    return htmlentities($clean);
}

function hashPassword($password = ''): string
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}
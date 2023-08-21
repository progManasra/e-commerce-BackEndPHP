<?php

include "../connect.php";

$usersid = filterRequest("usersid");
$itemsid = filterRequest("itemsid");


deleteData("favorite", "favorite_itemsid = $itemsid AND favorite_usersid = $usersid");

<?php

include "../connect.php";

$categoryid = filterRequest("id");

//getAllData("itemsview", "categories_id = $categoryid");

$userid = filterRequest("userid");

$stmt = $con->prepare("SELECT itemsview.*, 1 as favorite FROM itemsview
INNER JOIN favorite ON  favorite.favorite_itemsid = itemsview.items_id AND favorite.favorite_usersid = $userid
WHERE categories_id = $categoryid
UNION ALL 
SELECT itemsview.*, 0 as favorite FROM itemsview
WHERE categories_id = $categoryid AND itemsview.items_id != (SELECT itemsview.items_id FROM itemsview
INNER JOIN favorite ON  favorite.favorite_itemsid = itemsview.items_id AND favorite.favorite_usersid = $userid)");


$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}

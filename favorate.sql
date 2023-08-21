SELECT itemsview.*, 1 as favorite FROM itemsview
INNER JOIN favorite ON  favorite.favorite_itemsid = itemsview.items_id AND favorite.favorite_usersid = 1729
UNION ALL 
SELECT itemsview.*, 0 as favorite FROM itemsview
WHERE itemsview.items_id NOT IN (SELECT itemsview.items_id FROM itemsview
INNER JOIN favorite ON  favorite.favorite_itemsid = itemsview.items_id AND favorite.favorite_usersid = 1729)
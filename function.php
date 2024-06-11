// functions.php
<?php
include '.LinkSql.php';

function deleteProducts($link, $product_ids)
{
    if (empty($product_ids)) {
        return;
    }

    if (!is_array($product_ids)) {
        $product_ids = [$product_ids];
    }

    $product_ids_placeholder = implode(',', array_fill(0, count($product_ids), '?'));
    $types = str_repeat('i', count($product_ids));

    // 刪除商品圖片
    $stmt = $link->prepare("DELETE FROM product_images WHERE product_id IN ($product_ids_placeholder)");
    $stmt->bind_param($types, ...$product_ids);
    $stmt->execute();
    $stmt->close();

    // 刪除商品內容
    $stmt = $link->prepare("DELETE FROM product_contents WHERE product_id IN ($product_ids_placeholder)");
    $stmt->bind_param($types, ...$product_ids);
    $stmt->execute();
    $stmt->close();

    // 刪除商品分類
    $stmt = $link->prepare("DELETE FROM product_category WHERE product_id IN ($product_ids_placeholder)");
    $stmt->bind_param($types, ...$product_ids);
    $stmt->execute();
    $stmt->close();

    // 刪除商品
    $stmt = $link->prepare("DELETE FROM products WHERE id IN ($product_ids_placeholder)");
    $stmt->bind_param($types, ...$product_ids);
    $stmt->execute();
    $stmt->close();

    // 刪除商品的留言
    $stmt = $link->prepare("DELETE FROM product_comment WHERE product_id IN ($product_ids_placeholder)");
    $stmt->bind_param($types, ...$product_ids);
    $stmt->execute();
    $stmt->close();
}

function deleteUserComments($link, $user_id)
{
    // 刪除使用者留下的留言
    $stmt = $link->prepare("DELETE FROM product_comment WHERE author_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
}
?>
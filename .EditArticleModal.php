<?php
include '.LinkSql.php';
// 獲取所有分類
$category_query = "SELECT * FROM categories";
$category_result = $link->query($category_query);
?>
<!-- 編輯文章Modal -->
<div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editArticleModalLabel">編輯文章</h5>
            </div>
            <div class="modal-body">
                <form id="editArticle" action=".UpdateArticle.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="edit_product_id">
                    <div class="mb-3">
                        <input type="hidden" name="author_id" value="<?php echo $_SESSION['user_id']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="edit_product_name" name="product_name"
                            placeholder="標題" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="edit_articleContent" name="intro" rows="20"
                            placeholder="內容簡介"></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="edit_description" name="detail" rows="5" placeholder="詳細資料"
                            required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-control" id="edit_category_id" name="category_id" required>
                                <option value="">選擇分類</option>
                                <?php while ($row = $category_result->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" step="0.01" class="form-control" id="edit_price" name="price"
                                placeholder="價格" required>
                        </div>
                        <div class="col">
                            <div class="relative">
                                <input type="date" class="form-control" id="edit_write_date" name="write_date"
                                    placeholder="撰寫日期" required>
                                <i class="bi bi-calendar icon-right" id="toggleDate"></i>
                            </div>
                        </div>
                        <div class="col">
                            <input type="file" class="form-control" id="edit_fileUpload" name="fileUpload[]" multiple
                                accept="image/*">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div>
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">確認修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form name="search_Admin_Product" class="form-inline" action="../controller/mainCTL.php" method="post" style="margin-top: 20px">
    <div class="form-group">
        <select name="searchSubject"">
            <option value="">検索条件</option>
            <option value="searchOfcategory">カテゴリー</option>
            <option value="searchOfcode">商品コード</option>
        </select>
        <script>
            document.search_Admin_Product.searchSubject.value='<?=$_SESSION['searchSubject']?>';
        </script>
    </div>
    <div class="form-group">
        <input type="text" name="searchWord" value="" class="form-control">
        <script>
            document.search_Admin_Product.searchWord.value='<?=$_SESSION['searchWord']?>';
        </script>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default btn-block">検索</button>
        <input type="hidden" name="action" value="911">
    </div>
</form>

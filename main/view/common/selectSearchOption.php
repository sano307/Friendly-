<?php
if ( $action >= 100 || $action <= 599 ) { ?>
    <div id="selectSearch">
        <form name="selectform" action="../controller/mainCTL.php?action=<?=$action?>&category=<?=$category?>" method=post>
            <ul>
            <li>
            <select name="selectSearch"">
                <option value="sequenceOfnewer">新製品の順</option>
                <option value="sequenceOfhigher">高い価格の順</option>
                <option value="sequenceOflower">安い価格の順</option>
            </select>
            <script>
                document.selectform.selectSearch.value='<?=$_SESSION['selectSearch']?>';
            </script>
            </li>
            <li>
            <input id="searchButton" type="submit" value="検索" style="margin-bottom: 8px;">
            </li>
            </ul>
        </form>
    </div>
    <?php
}
?>

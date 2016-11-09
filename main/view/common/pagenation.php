<?php
function setPageNation($argAction, $argPageInfo, $argCategory) {

    echo "<div id='pagenation'>";
    echo "<ul>";
    // [1]과 [<<] 조건 체크
    if ( $argPageInfo['prevListCheck'] != 0 ) {
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum=1>[1]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum={$argPageInfo['prevListCheck']}>[<<]</a></li>";
    }

    // 현제 페이지에서 시작되는 레코드가 테이블에서의 첫째행이 아닐 경우 [<]를 출력하라.
    if ( $argPageInfo['startRecord'] != 0 ) {
        $prevPage = $argPageInfo['currentPageNum'] - 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum=$prevPage>[<]</a></li>";
    }

    // 한 페이지에 출력되는 리스트의 수가 넘을 때 1씩 증가되는 $argPageInfo['overListCheck']에
    // 페이지당 보여줄 리스트의 수를 담고 있는 $argPageInfo['pagePerList']를 곱해준 값에 1을 더한 수를 반복문의 시작수로 정한다.
    // 그 후, 마지막 리스트에 해당하는 수까지 +1씩 증가시키며 반복한다.
    for ( $setPage = $argPageInfo['overListCheck'] * $argPageInfo['pagePerList'] + 1; $setPage <= $argPageInfo['endListCheck']; $setPage++ ) {
        // 만약, 출력된 리스트와 클릭한 리스트가 같다면, <b>태그를 이용하여 굵게 표시하라.
        if ( $setPage == $argPageInfo['currentPageNum'] ) {
            echo "<li><b>$setPage</b></li>";
        } else {
            echo "<li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum=$setPage>$setPage</a></li>";
        }
    }

    // 현재 선택된 리스트 번호와 마지막 리스트 번호가 일치하지 않고,
    // 전체 리스트의 수가 0이 아닐 때, [>]를 출력하라.
    if ( $argPageInfo['currentPageNum'] != $argPageInfo['countWholeList'] && $argPageInfo['countWholeList'] != 0) {
        $nextPage = $argPageInfo['currentPageNum'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum=$nextPage>[>]</a></li>";
    }

    // 마지막 리스트가 아니라면, [>>]와 마지막 페이스에 해당하는 리스트 번호를 출력하라.
    if ( $argPageInfo['endListCheck'] < $argPageInfo['countWholeList'] ) {
        $nextPage = ($argPageInfo['overListCheck'] + 1) * $argPageInfo['pagePerList'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum=$nextPage>[>>]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&category=$argCategory&pageNum={$argPageInfo['countWholeList']}>[{$argPageInfo['countWholeList']}]</a></li>";
    }
    echo "</ul>";
    echo "<div>";
}

function setPageNationByBoard($argAction, $argPageInfo) {

    echo "<div id='pagenation'>";
    echo "<ul>";
    // [1]과 [<<] 조건 체크
    if ( $argPageInfo['prevListCheck'] != 0 ) {
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=1>[1]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&pageNum={$argPageInfo['prevListCheck']}>[<<]</a></li>";
    }

    // 현제 페이지에서 시작되는 레코드가 테이블에서의 첫째행이 아닐 경우 [<]를 출력하라.
    if ( $argPageInfo['startRecord'] != 0 ) {
        $prevPage = $argPageInfo['currentPageNum'] - 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$prevPage>[<]</a></li>";
    }

    // 한 페이지에 출력되는 리스트의 수가 넘을 때 1씩 증가되는 $argPageInfo['overListCheck']에
    // 페이지당 보여줄 리스트의 수를 담고 있는 $argPageInfo['pagePerList']를 곱해준 값에 1을 더한 수를 반복문의 시작수로 정한다.
    // 그 후, 마지막 리스트에 해당하는 수까지 +1씩 증가시키며 반복한다.
    for ( $setPage = $argPageInfo['overListCheck'] * $argPageInfo['pagePerList'] + 1; $setPage <= $argPageInfo['endListCheck']; $setPage++ ) {
        // 만약, 출력된 리스트와 클릭한 리스트가 같다면, <b>태그를 이용하여 굵게 표시하라.
        if ( $setPage == $argPageInfo['currentPageNum'] ) {
            echo "<li><b>$setPage</b></li>";
        } else {
            echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$setPage>$setPage</a></li>";
        }
    }

    // 현재 선택된 리스트 번호와 마지막 리스트 번호가 일치하지 않고,
    // 전체 리스트의 수가 0이 아닐 때, [>]를 출력하라.
    if ( $argPageInfo['currentPageNum'] != $argPageInfo['countWholeList'] && $argPageInfo['countWholeList'] != 0) {
        $nextPage = $argPageInfo['currentPageNum'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$nextPage>[>]</a></li>";
    }

    // 마지막 리스트가 아니라면, [>>]와 마지막 페이스에 해당하는 리스트 번호를 출력하라.
    if ( $argPageInfo['endListCheck'] < $argPageInfo['countWholeList'] ) {
        $nextPage = ($argPageInfo['overListCheck'] + 1) * $argPageInfo['pagePerList'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$nextPage>[>>]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&pageNum={$argPageInfo['countWholeList']}>[{$argPageInfo['countWholeList']}]</a></li>";
    }
    echo "</ul>";
    echo "<div>";
}

function setPageNationByComment($argAction, $argPageNum, $argPostNum, $argPageInfo) {

    echo "<div id='pagenation'>";
    echo "<ul>";
    // [1]과 [<<] 조건 체크
    if ( $argPageInfo['prevListCheck'] != 0 ) {
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum=1>[1]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum={$argPageInfo['prevListCheck']}>[<<]</a></li>";
    }

    // 현제 페이지에서 시작되는 레코드가 테이블에서의 첫째행이 아닐 경우 [<]를 출력하라.
    if ( $argPageInfo['startRecord'] != 0 ) {
        $prevPage = $argPageInfo['currentPageNum'] - 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum=$prevPage>[<]</a></li>";
    }

    // 한 페이지에 출력되는 리스트의 수가 넘을 때 1씩 증가되는 $argPageInfo['overListCheck']에
    // 페이지당 보여줄 리스트의 수를 담고 있는 $argPageInfo['pagePerList']를 곱해준 값에 1을 더한 수를 반복문의 시작수로 정한다.
    // 그 후, 마지막 리스트에 해당하는 수까지 +1씩 증가시키며 반복한다.
    for ( $setPage = $argPageInfo['overListCheck'] * $argPageInfo['pagePerList'] + 1; $setPage <= $argPageInfo['endListCheck']; $setPage++ ) {
        // 만약, 출력된 리스트와 클릭한 리스트가 같다면, <b>태그를 이용하여 굵게 표시하라.
        if ( $setPage == $argPageInfo['currentPageNum'] ) {
            echo "<li><b>$setPage</b></li>";
        } else {
            echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum=$setPage>$setPage</a></li>";
        }
    }

    // 현재 선택된 리스트 번호와 마지막 리스트 번호가 일치하지 않고,
    // 전체 리스트의 수가 0이 아닐 때, [>]를 출력하라.
    if ( $argPageInfo['currentPageNum'] != $argPageInfo['countWholeList'] && $argPageInfo['countWholeList'] != 0) {
        $nextPage = $argPageInfo['currentPageNum'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum=$nextPage>[>]</a></li>";
    }

    // 마지막 리스트가 아니라면, [>>]와 마지막 페이스에 해당하는 리스트 번호를 출력하라.
    if ( $argPageInfo['endListCheck'] < $argPageInfo['countWholeList'] ) {
        $nextPage = ($argPageInfo['overListCheck'] + 1) * $argPageInfo['pagePerList'] + 1;
        echo "<li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum=$nextPage>[>>]</a></li>";
        echo " ... <li><a href=../controller/mainCTL.php?action=$argAction&pageNum=$argPageNum&postNum=$argPostNum&comment_pageNum={$argPageInfo['countWholeList']}>[{$argPageInfo['countWholeList']}]</a></li>";
    }
    echo "</ul>";
    echo "<div>";
}
?>
<?php
function DBConnectionProcess() {
    global $db_conn;

    $db_conn = mysqli_connect("localhost", "root", "");

    if (!$db_conn) {
        echo "Unable to connect to DB: " . mysqli_error();
        exit;
    }

    mysqli_query($db_conn, "SET NAMES utf8");
    $db_select = mysqli_select_db($db_conn, "myShop");

    if ( !$db_select ) {
        echo "Unable to select myShop: " . mysqli_error();
        exit;
    }

    return $db_conn;
}

function getPageInfo($argPageNum, $argCnt, $argPagePerRecord, $argPagePerList) {
    $page_per_record = $argPagePerRecord;   // 페이지 당 레코드 수
    $page_per_list   = $argPagePerList;     // 페이지 당 리스트 수

    $countWholeRecord = $argCnt;                                        // 선택한 제품의 총 레코드 수
    $countWholeList   = ceil( $countWholeRecord / $page_per_record );   // 전체 리스트의 수

    // 시작 레코드 번호
    $pageInfo['startRecord'] = ($argPageNum - 1) * $page_per_record;
    // 현재 페이지의 리스트 초과 체크
    $pageInfo['overListCheck'] = ceil($argPageNum / $page_per_list) - 1;
    // 현재 페이지의 prev 체크
    $pageInfo['prevListCheck'] = ($pageInfo['overListCheck'] > 0) ? $pageInfo['overListCheck'] * $page_per_list : 0;
    // 현재 페이지의 마지막 리스트 체크
    $pageInfo['endListCheck'] = ($pageInfo['overListCheck'] + 1) * $page_per_list;
    $pageInfo['endListCheck'] = ($pageInfo['endListCheck'] > $countWholeList) ? $countWholeList : $pageInfo['endListCheck'];
    // 현재 페이지의 next 체크
    $pageInfo['nextListCheck'] = ($pageInfo['endListCheck'] < $countWholeList) ? ($pageInfo['overListCheck'] + 1) * $page_per_list + 1 : 0;

    $pageInfo['countWholeList'] = $countWholeList;  // 전체 리스트 수
    $pageInfo['pagePerRecord'] = $page_per_record;  // 페이지 당 레코드 수
    $pageInfo['pagePerList']   = $page_per_list;    // 페이지 당 리스트 수

    $pageInfo['currentPageNum'] = $argPageNum;      // 현재 페이지 번호

    return $pageInfo;
}

function isImageFile( $argSavePath, $argTemporarySavePath, $argImageName, $argImageSize ) {
    $target_dir = $argSavePath;
    $target_file = $target_dir . basename($argImageName);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);  // 현재 이미지의 확장자를 받아온다.
    $IsUploadCheck = 1; // 오류 체크 변수

    if ( isset($_POST['submit']) ) {
        // getimagesize는 이미지의 정보를 추출해주는 함수
        // Array (
        // [0] => 이미지의 width값
        // [1] => 이미지의 height값
        // [2] => 이미지의 Type Flag ( 각 이미지의 확장자마다 반환되는 정수가 다름 )
        // [3] => 이미지의 width값, height값
        // [bits] => 비트 수
        // [chnnels] => 채널 번호
        // [mime] => 현재 이미지의 확장자
        // )
        $IsfileCheck = getimagesize($argTemporarySavePath);

        // 만약, 이미지의 정보가 없을 경우, 오류 체크 변수를 0으로
        if ( !$IsfileCheck ) {
            header("Location: ../view/admin/alert/pi_alert.php?error=NotImageFile");
            $IsUploadCheck = 0;
        }
    }

    // 만약, 업로드 할 폴더가 존재 하지 않을 경우, 오류 체크 변수를 0으로
    if ( file_exists($target_file) ) {
        header("Location: ../view/admin/alert/pi_alert.php?error=AlreadyExistsFile");
        $IsUploadCheck = 0;
    }

    // 만약, 업로드 한 이미지의 사이즈가 5MB를 넘을 경우, 오류 체크 변수를 0으로
    if ( $argImageSize > 50000000 ) {
        header("Location: ../view/admin/alert/pi_alert.php?error=OverSizeFile");
        $IsUploadCheck = 0;
    }

    $fileExtensionArr = array("jpg", "png", "jpeg", "gif");
    // 만약, 업로드 한 이미지의 확장자와 위의 배열에 저장되어 확장자가 하나라도 일치하지 않을 경우, 오류 체크 변수를 0으로
    if ( !in_array($imageFileType, $fileExtensionArr) ) {
        header("Location: ../view/admin/alert/pi_alert.php?error=OtherExtensionFile");
        $IsUploadCheck = 0;
    }

    // 오류 체크 변수를 통해서 검사한다.
    if ( !$IsUploadCheck ) {
        header("Location: ../view/admin/alert/pi_alert.php?error=UploadFailed");
    }
}

function setImageUploading( $argSaveFilePath, $argImageName, $argImageTmpName ) {
    $target_dir = $argSaveFilePath;
    $target_file = $target_dir . basename($argImageName);
    if ( !move_uploaded_file($argImageTmpName, $target_file) ) {
        header("Location: ../view/admin/alert/pi_alert.php?error=UploadingFailed");
    }
}

function setBasketInfo( $argBasketInfo, $argProductNum, $argPurcharseNum, $argMode ) {
    $IsSameKeyCheck = false;
    foreach( $argBasketInfo as $prNum => $puNum ) {
        // 만약, 현재 장바구니에 들어있는 상품번호 중에 일치하는 상품번호가 있다면,
        if ( $prNum == $argProductNum ) {
            switch ( $argMode ) {
                case "putProductInbasket" :
                    // 해당 상품의 값에 구매한 수량을 더해준다.
                    $argBasketInfo[$prNum] += $argPurcharseNum;
                    $argBasketInfo[$prNum] = (String)$argBasketInfo[$prNum];
                    break;

                case "excludeProductInbasket" :
                    // 해당 상품의 값에 구매한 수량을 빼준다.
                    $argBasketInfo[$prNum] -= $argPurcharseNum;
                    $argBasketInfo[$prNum] = (String)$argBasketInfo[$prNum];
                    break;

                case "deleteProductInbasket" :
                    // 해당 상품을 삭제한다.
                    unset($argBasketInfo[$prNum]);
                    break;
            }
            $IsSameKeyCheck = true;
        }
    }

    // 현재 장바구니에 들어있는 상품번호 중에 일치하는 상품번호가 있다면,
    if ( !$IsSameKeyCheck ) {
        $argBasketInfo[$argProductNum] = (String)$argPurcharseNum;
    }

    // 만약, 현재 장바구니 배열에 0이라는 값이 들어있는 상품번호가 존재한다면,
    if ( $emptyKey = array_search("0", $argBasketInfo) ) {
        // 해당 상품번호의 키를 배열에서 삭제하라.
        unset($argBasketInfo[$emptyKey]);
    }

    return $argBasketInfo;
}

function IsUploadErrorCheck( $argImageFile )
{
    switch ( $argImageFile ) {
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;
        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}

function setViewedList( $argViewedList, $argNowViewProductNum ) {
    $IsCheck = false;
    $cnt = count($argViewedList);
    for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
        if ( $argViewedList[$iCount] == $argNowViewProductNum ) {
            $IsCheck = true;
            break;
        } else {
            $IsCheck = false;
        }
    }

    if ( !$IsCheck ) {
        $argViewedList[$cnt] = $argNowViewProductNum;
    }

    return $argViewedList;
}
?>
<?php
if (!isset($_SESSION)) session_start();
include_once "../model/adminDAO.php";
include_once "../model/commonLIB.php";

function adminProcessing($argAction)
{
    $adminSubMenuControlShortNum = intval($argAction / 10 % 10);
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;

    switch ($argAction) {
        case 900:   // 회원관리 페이지 클릭
            if (!$_REQUEST['pageNum']) {
                unset($_SESSION['searchSubject']);
                unset($_SESSION['searchWord']);
            }
            header("Location: ../controller/mainCTL.php?action=901&category={$_SESSION['admin_subMenuName'][$adminSubMenuControlShortNum][$argAction]}&pageNum=$pageNum");
            break;

        case 901:   // 회원관리 페이지
            adminListProcessing($argAction);
            break;

        case 902:   // 회원입력 클릭
            header("Location: ../view/MainView.php?action=903&category={$_SESSION['admin_subMenuName'][$adminSubMenuControlShortNum][$argAction]}");
            break;

        case 903:   // 회원입력 페이지
            $insertMemberInfo['m_id'] = $_REQUEST['m_id'];
            $insertMemberInfo['m_password'] = $_REQUEST['m_password'];
            $insertMemberInfo['m_name'] = $_REQUEST['m_name'];
            $insertMemberInfo['m_tel'] = $_REQUEST['m_tel'];
            $insertMemberInfo['m_level'] = $_REQUEST['m_level'];

            if (!$insertMemberInfo['m_id']) {
                $msg = "아이디를 입력해주세요.";
                echo "<script>alert('{$msg}'); history.back();</script>";
            } elseif (!$insertMemberInfo['m_password']) {
                $msg = "비밀번호를 설정해주세요.";
                echo "<script>alert('{$msg}'); history.back();</script>";
            } elseif (!$insertMemberInfo['m_name']) {
                $msg = "이름을 입력해주세요.";
                echo "<script>alert('{$msg}'); history.back();</script>";
            } elseif (!$insertMemberInfo['m_tel']) {
                $msg = "연락처를 설정해주세요.";
                echo "<script>alert('{$msg}'); history.back();</script>";
            } elseif (!$insertMemberInfo['m_level']) {
                $msg = "래밸을 설정해주세요.";
                echo "<script>alert('{$msg}'); history.back();</script>";
            } else {
                $result = insertNewMemberInfo($insertMemberInfo);

                if (!$result) {

                } else {
                    $msg = "회원등록이 정상적으로 이뤄졌습니다.";
                    echo "<script>alert('{$msg}'); location.href='../controller/mainCTL.php?action=900';</script>";
                }
            }
            break;

        case 904:   // 회원수정 옵션 클릭
            $m_num = $_REQUEST['memberNum'];
            $_SESSION['certainMemberInfo'] = getCertainMemberInfo($m_num);
            header("Location: ../view/MainView.php?action=905&memberNum=$m_num");
            break;

        case 905:   // 회원수정 페이지
            $modifyMemberInfo['m_num'] = $_REQUEST['memberNum'];
            $modifyMemberInfo['m_password'] = $_REQUEST['m_password'];
            $modifyMemberInfo['m_name'] = $_REQUEST['m_name'];
            $modifyMemberInfo['m_tel'] = $_REQUEST['m_tel'];
            $modifyMemberInfo['m_level'] = $_REQUEST['m_level'];

            if (!$modifyMemberInfo['m_password']) {
                $msg = "비밀번호를 설정해주세요.";
                echo "<script>alert('{$msg}'); location.href='../view/MainView.php?action=905&memberNum={$modifyMemberInfo['m_num']}';</script>";
            } elseif (!$modifyMemberInfo['m_name']) {
                $msg = "이름을 입력해주세요.";
                echo "<script>alert('{$msg}'); location.href='../view/MainView.php?action=905&memberNum={$modifyMemberInfo['m_num']}';</script>";
            } elseif (!$modifyMemberInfo['m_tel']) {
                $msg = "연락처를 입력해주세요.";
                echo "<script>alert('{$msg}'); location.href='../view/MainView.php?action=905&memberNum={$modifyMemberInfo['m_num']}';</script>";
            } elseif (!$modifyMemberInfo['m_level']) {
                $msg = "래밸을 설정해주세요.";
                echo "<script>alert('{$msg}'); location.href='../view/MainView.php?action=905&memberNum={$modifyMemberInfo['m_num']}';</script>";
            } else {
                $result = setCertainMemberInfo($modifyMemberInfo);
                $msg = "회원정보가 정상적으로 수정되었습니다!";
                echo "<script>alert('{$msg}'); location.href='../controller/mainCTL.php?action=900';</script>";
            }
            break;

        case 906:   // 회원삭제
            $deleteMemberInfo['m_num'] = $_REQUEST['memberNum'];
            $result = deleteCertainMemberInfo($deleteMemberInfo);

            $msg = "정상적으로 회원정보가 삭제되었습니다!";
            echo "<script>alert('{$msg}'); location.href='../controller/mainCTL.php?action=900';</script>";
            break;

        case 907:   // 회원 ID 중복 체크
            break;

        case 910:   // 상품관리 페이지 클릭
            if (!$_REQUEST['pageNum']) {
                unset($_SESSION['searchSubject']);
                unset($_SESSION['searchWord']);
            }
            header("Location: ../controller/mainCTL.php?action=911&category={$_SESSION['admin_subMenuName'][$adminSubMenuControlShortNum][$argAction]}&pageNum=$pageNum");
            break;

        case 911:   // 상품관리 페이지
            adminListProcessing($argAction);
            break;

        case 912:   // 상품입력 메뉴 클릭
            header("Location: ../view/MainView.php?action=912&category={$_SESSION['admin_subMenuName'][$adminSubMenuControlShortNum][$argAction]}");
            break;

        case 913:   // 상품입력 페이지
            $insertProductInfo['p_category'] = $_REQUEST['p_category'];
            $insertProductInfo['p_name'] = $_REQUEST['p_name'];
            $insertProductInfo['p_stock'] = $_REQUEST['p_stock'];
            $insertProductInfo['p_price'] = $_REQUEST['p_price'];

            $insertProductImageInfo = $_FILES['p_fimage'];

            $saveFolderName = explode('_', $insertProductInfo['p_category']);
            $saveFilePath = "../../img/product/" . $saveFolderName[0] . "/";

            $countImages = count($insertProductImageInfo['name']);
            $newInsertProductNum = getNewInsertProductNum() + 1;
            $nowTimeInfo = date("YmdHis", time());
            $insertProductInfo['p_code'] = strtoupper($saveFolderName[0]) . $newInsertProductNum . "_" . $nowTimeInfo;

            for ($iCount = 0; $iCount < $countImages; $iCount++) {
                $nowImageExt = pathinfo($insertProductImageInfo['name'][$iCount], PATHINFO_EXTENSION);
                $nowImageName = strtoupper($saveFolderName[0]) . $newInsertProductNum . "_" . $nowTimeInfo . "-" . str_pad($iCount + 1, 4, "0", STR_PAD_LEFT) . "." . $nowImageExt;
                isImageFile($saveFilePath, $insertProductImageInfo['tmp_name'][$iCount], $nowImageName, $insertProductImageInfo['size'][$iCount]);
            }

            $ImageNameArr = "";
            for ($iCount = 0; $iCount < $countImages; $iCount++) {
                $nowImageExt = pathinfo($insertProductImageInfo['name'][$iCount], PATHINFO_EXTENSION);
                $nowImageName = $insertProductInfo['p_code'] . "-" . str_pad($iCount + 1, 4, "0", STR_PAD_LEFT) . "." . $nowImageExt;
                setImageUploading($saveFilePath, $nowImageName, $insertProductImageInfo['tmp_name'][$iCount]);

                if ($iCount == 0) {
                    $ImageNameArr = $nowImageName;
                } else {
                    $ImageNameArr .= "," . $nowImageName;
                }
            }

            $result = insertNewProductInfo($insertProductInfo, $ImageNameArr);
            if (!$result) {
                header("Location: ../view/admin/alert/pi_alert.php?error=InsertFailed");
            } else {
                $openImageExt = pathinfo($insertProductImageInfo['name'][0], PATHINFO_EXTENSION);
                $openImageName = $saveFilePath . $insertProductInfo['p_code'] . "-" . str_pad(1, 4, "0", STR_PAD_LEFT) . "." . $openImageExt;
                $saveThumbnailName = $insertProductInfo['p_code'] . "-thumbnail." . $openImageExt;
                $saveFolderName = $saveFilePath . $saveThumbnailName;

                list($width, $height) = getimagesize($openImageName);
                $newwidth = 200;
                $newheight = 200;

                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($openImageName);

                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                imagejpeg($thumb, $saveFolderName);
                $result = updateNewProductInfo($newInsertProductNum, $saveThumbnailName);
                if (!$result) {
                    header("Location: ../view/admin/alert/pi_alert.php?error=InsertFailed");
                } else {
                    header("Location: ../view/admin/alert/pi_alert.php?error=InsertSuccess");
                }
            }
            break;

        case 914:   // 상품수정 옵션 클릭
            $p_num = $_REQUEST['productNum'];
            $_SESSION['certainProductInfo'] = getCertainProductInfo($p_num);
            header("Location: ../view/MainView.php?action=915&productNum=$p_num");
            break;

        case 915:   // 상품수정 페이지
            $modifyProductInfo['p_num'] = $_REQUEST['p_num'];
            $modifyProductInfo['p_category'] = $_REQUEST['p_category'];
            $modifyProductInfo['p_code'] = $_REQUEST['p_code'];
            $modifyProductInfo['p_name'] = isset($_REQUEST['p_name']) ? $_REQUEST['p_name'] : null;
            $modifyProductInfo['p_stock'] = isset($_REQUEST['p_stock']) ? $_REQUEST['p_stock'] : null;
            $modifyProductInfo['p_price'] = isset($_REQUEST['p_price']) ? $_REQUEST['p_price'] : null;
            $modifyProductInfo['p_dimage'] = isset($_REQUEST['p_dimage']) ? $_REQUEST['p_dimage'] : null;

            $modifyProductImageInfo = isset($_FILES['p_fimage']) ? $_FILES['p_fimage'] : null;
            $modifyProductImageThumbnail = isset($_FILES['p_simage']) ? $_FILES['p_simage'] : null;

            $saveFolderName = explode('_', $modifyProductInfo['p_category']);
            $saveFilePath = "../../img/product/" . $saveFolderName[0] . "/";

            if (!$modifyProductInfo['p_name']) {
                header("Location: ../view/admin/alert/pm_alert.php?error=productNameInsert");
            } elseif (!$modifyProductInfo['p_stock']) {
                header("Location: ../view/admin/alert/pm_alert.php?error=productStockInsert");
            } elseif (!$modifyProductInfo['p_price']) {
                header("Location: ../view/admin/alert/pm_alert.php?error=productPriceInsert");
            } else {
                if ($modifyProductInfo['p_dimage']) {
                    // 체크된 이미지 삭제 후 이미지파일명 재배열
                    $nowProductImageArr = explode(',', getModifyProductImageInfo($modifyProductInfo['p_num']));
                    $compareProductImageArr = array_diff($nowProductImageArr, $modifyProductInfo['p_dimage']);
                    $iCount = 0;
                    $imageNameArr = "";
                    if ($compareProductImageArr) {
                        foreach ($compareProductImageArr as $key => $value) {
                            $new_key = $iCount;
                            $afterProductImageArr[$new_key] = $value;
                            if ($new_key == 0) {
                                $imageNameArr = $value;
                            } else {
                                $imageNameArr .= "," . $value;
                            }
                            $iCount++;
                        }
                        updateProductImage($modifyProductInfo['p_num'], $imageNameArr);
                    } else {
                        updateProductImage($modifyProductInfo['p_num'], '');
                    }

                    $countImages = count($modifyProductInfo['p_dimage']);

                    for ($iCount = 0; $iCount < $countImages; $iCount++) {
                        $nowImagePath = $saveFilePath . $modifyProductInfo['p_dimage'][$iCount];
                        if (file_exists($nowImagePath)) {
                            unlink($nowImagePath);
                        }
                    }
                }

                // 첨부된 이미지 업로드
                if ($modifyProductImageInfo['error'][0] != 4) {
                    $nowProductNum = $modifyProductInfo['p_num'];
                    $nowTimeInfo = date("YmdHis", time());
                    $modifyProductInfo['p_code'] = strtoupper($saveFolderName[0]) . $nowProductNum . "_" . $nowTimeInfo;
                    $countImages = count($modifyProductImageInfo['name']);

                    for ($iCount = 0; $iCount < $countImages; $iCount++) {
                        $nowImageExt = pathinfo($modifyProductImageInfo['name'][$iCount], PATHINFO_EXTENSION);
                        $nowImageName = $modifyProductInfo['p_code'] . "-" . str_pad($iCount + 1, 4, "0", STR_PAD_LEFT) . "." . $nowImageExt;
                        isImageFile($saveFilePath, $modifyProductImageInfo['tmp_name'][$iCount], $nowImageName, $modifyProductImageInfo['size'][$iCount]);
                    }

                    $imageNameArr = "";
                    for ($iCount = 0; $iCount < $countImages; $iCount++) {
                        $nowImageExt = pathinfo($modifyProductImageInfo['name'][$iCount], PATHINFO_EXTENSION);
                        $nowImageName = $modifyProductInfo['p_code'] . "-" . str_pad($iCount + 1, 4, "0", STR_PAD_LEFT) . "." . $nowImageExt;
                        setImageUploading($saveFilePath, $nowImageName, $modifyProductImageInfo['tmp_name'][$iCount]);

                        $valueCheck = getModifyProductImageInfo($modifyProductInfo['p_num']);
                        if ($iCount == 0 && !$valueCheck) {
                            $imageNameArr = $nowImageName;
                        } else {
                            $imageNameArr .= "," . $nowImageName;
                        }
                    }

                    $result = changeProductImage($modifyProductInfo['p_num'], $imageNameArr);
                    if (!$result) {
                        header("Location: ../view/admin/alert/pm_alert.php?error=ChangeFailed");
                    }
                }


                // 썸네일 파일이 있을 시에 이미지를 수정하여 저장
                if ($modifyProductImageThumbnail['error'][0] != 4) {
                    $nowImageExt = pathinfo($modifyProductImageThumbnail['name'][0], PATHINFO_EXTENSION);
                    $nowImageName = $saveFilePath . $modifyProductInfo['p_code'] . "-tempThumbnail." . $nowImageExt;
                    isImageFile($saveFilePath, $modifyProductImageThumbnail['tmp_name'][0], $nowImageName, $modifyProductImageThumbnail['size'][0]);
                    setImageUploading($saveFilePath, $nowImageName, $modifyProductImageThumbnail['tmp_name'][0]);

                    $saveThumbnailName = $modifyProductInfo['p_code'] . "-thumbnail." . $nowImageExt;
                    $saveFolderName = $saveFilePath . $saveThumbnailName;

                    list($width, $height) = getimagesize($nowImageName);
                    $newwidth = 200;
                    $newheight = 200;

                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    $source = imagecreatefromjpeg($nowImageName);

                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                    imagejpeg($thumb, $saveFolderName);

                    // 데이터베이스에 상품 정보 업데이트
                    $beforeImageThumbnailName = getProductImageThumbnail($modifyProductInfo['p_num']);
                    $beforeImageThumbnailPath = $saveFilePath . $beforeImageThumbnailName;
                    $result = updateProductImageThumbnail($modifyProductInfo['p_num'], $saveThumbnailName);
                    if (!$result) {
                        header("Location: ../view/admin/alert/pm_alert.php?error=UpdateImageThumbnailFailed");
                    } else {
                        unlink($nowImageName);
                        unlink($beforeImageThumbnailPath);
                        header("Location: ../view/admin/alert/pm_alert.php?error=ProductModifySuccess");
                    }
                } else {
                    header("Location: ../view/admin/alert/pm_alert.php?error=ProductModifySuccess");
                }
            }
            break;

        case 916:   // 상품삭제 페이지
            $pageNum = $_REQUEST['pageNum'];
            $deleteProductInfo['p_num'] = $_REQUEST['productNum'];
            $result = deleteCertainProductInfo($deleteProductInfo);

            $msg = "정상적으로 상품정보가 삭제되었습니다!";
            echo "<script>alert('{$msg}'); location.href='../controller/mainCTL.php?action=910&pageNum=$pageNum';</script>";
            break;

        default:
            header("Location: ../view/MainView.php?action=$argAction&category={$_SESSION['admin_mainMenuName'][$argAction]}");
            break;
    }
}

function adminListProcessing($argAction)
{
    $controlShortNum = intval($argAction / 10 % 10);
    $pageNum = isset($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;

    if (isset($_REQUEST['searchSubject'])) {
        $nowSearchSubject = $_REQUEST['searchSubject'];
        $_SESSION['searchSubject'] = $nowSearchSubject;
    } elseif (isset($_SESSION['searchSubject'])) {
        $nowSearchSubject = $_SESSION['searchSubject'];
    } else {
        $nowSearchSubject = null;
    }

    if (isset($_REQUEST['searchWord'])) {
        $nowSearchWord = $_REQUEST['searchWord'];
        $_SESSION['searchWord'] = $nowSearchWord;
    } elseif (isset($_SESSION['searchWord'])) {
        $nowSearchWord = $_SESSION['searchWord'];
    } else {
        $nowSearchWord = null;
    }

    if ($_SESSION['nowActionValue'] != $argAction) {
        $nowSearchSubject = null;
        $nowSearchWord = null;
        $_SESSION['searchSubject'] = $nowSearchSubject;
        $_SESSION['searchWord'] = $nowSearchWord;
        $_SESSION['nowActionValue'] = $argAction;
    }

    $adminCategoryArr = array(
        array("member", "m_num"),
        array("product", "p_num"),
    );

    $adminPagePatternArr = array(
        array(15, 5),
        array(15, 5),
    );

    $selectTable = $adminCategoryArr[$controlShortNum][0];
    $selectOrderByOption = $adminCategoryArr[$controlShortNum][1];
    $screenPerRecord = $adminPagePatternArr[$controlShortNum][0];
    $screenPerPage = $adminPagePatternArr[$controlShortNum][1];

    if ($nowSearchSubject && $nowSearchWord) {
        $nowSearchWord = "%" . $nowSearchWord . "%";

        if ($nowSearchSubject == "searchOfid") {
            $nowSearchSubject = "m_id";
        } elseif ($nowSearchSubject == "searchOfname") {
            $nowSearchSubject = "m_name";
        } elseif ($nowSearchSubject == "searchOfcategory") {
            $nowSearchSubject = "p_category";
        } elseif ($nowSearchSubject == "searchOfcode") {
            $nowSearchSubject = "p_code";
        }

        $cnt = getCountAdminSearch($selectTable, $nowSearchSubject, $nowSearchWord);
        $_SESSION['pageInfo'] = getPageInfo($pageNum, $cnt, $screenPerRecord, $screenPerPage);
        $_SESSION['adminInfo'] = getAdminSearch($selectTable, $selectOrderByOption, $nowSearchSubject, $nowSearchWord, $_SESSION['pageInfo']);
    } else {
        $cnt = getCountAdminCategory($selectTable);
        $_SESSION['pageInfo'] = getPageInfo($pageNum, $cnt, $screenPerRecord, $screenPerPage);
        $_SESSION['adminInfo'] = getAdminCategory($selectTable, $selectOrderByOption, $_SESSION['pageInfo']);
    }

    switch ($controlShortNum) {
        case 0:
            header("Location: ../view/MainView.php?action=900&category={$_SESSION['admin_mainMenuName'][900]}&pageNum=$pageNum");
            break;

        case 1:
            header("Location: ../view/MainView.php?action=910&category={$_SESSION['admin_mainMenuName'][910]}&pageNum=$pageNum");
            break;
    }
}

?>
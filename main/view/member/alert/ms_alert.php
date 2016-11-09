<?php
session_start();
$errorCheck = $_REQUEST['error'];
switch ($errorCheck) {
    case "emptyID" :
        ?>
        <script>
            var msg = "아이디는 공란으로 비워두시면 안됩니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "emptyNickname" :
        ?>
        <script>
            var msg = "닉네임을 공란으로 비워두시면 안됩니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "emptyPassword" :
        ?>
        <script>
            var msg = "비밀번호는 공란으로 비워두시면 안됩니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "emptyName" :
        ?>
        <script>
            var msg = "이름은 공란으로 비워두시면 안됩니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "sameIDExist" :
        ?>
        <script>
            var msg = "동일한 아이디가 존재합니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "signUpSuccess" :
        ?>
        <script>
            var msg = "정상적으로 회원가입이 완료되었습니다!";
            alert(msg);
            location.href='../../../controller/mainCTL.php?action=100';
        </script>
        <?php
        break;

    case "loginManager" :
        ?>
        <script>
            var msg = "관리자님 환영합니다!";
            alert(msg);
            location.href='../../../controller/mainCTL.php?action=900';
        </script>
        <?php
        break;

    case "loginUser" :
        ?>
        <script>
            var msg = "<?= $_SESSION['now_user'] ?>님 환영합니다!";
            alert(msg);
            location.href='../../../controller/mainCTL.php?action=100';
        </script>
        <?php
        break;

    case "wrongPassword" :
        ?>
        <script>
            var msg = "비밀번호가 틀렸습니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "notExistID" :
        ?>
        <script>
            var msg = "아이디가 존재하지 않습니다!";
            alert(msg);
            history.back();
        </script>
        <?php
        break;

    case "logoutSuccess" :
        ?>
        <script>
            var msg = "정상적으로 로그아웃 되었습니다!";
            alert(msg);
            location.href='../../../controller/mainCTL.php?action=100';
        </script>
        <?php
        break;
}
?>
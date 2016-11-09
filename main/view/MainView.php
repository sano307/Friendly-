<?php
include_once "./commonDataMainView.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Friendly</title>
    <link rel="stylesheet" href="../../css/base.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/basic.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/bootstrap-3.3.2-dist/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/content.css" type="text/css" media="screen" />
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
    <header> <?php include_once "./header.php" ?> </header>

    <?php
        if ( $now_level == 999 ) {
            ?>
            <nav> <?php include_once "./admin_nav.php" ?> </nav>
            <aside> <?php include_once "./admin_aside.php" ?> </aside>
            <section> <?php include_once "./admin_section.php" ?> </section>
        <?php
    } else {
            ?>
            <nav> <?php include_once "./nav.php" ?> </nav>
            <aside> <?php include_once "./aside.php" ?> </aside>
            <section> <?php include_once "./section.php" ?> </section>
    <?php
    }
    ?>

    <footer> <?php include_once "./footer.php" ?> </footer>
</div>
</body>
</html>
<?php
include_once './dao/GenreDaoImpl.php';
include_once './dao/UserDaoImpl.php';

session_start();
if (!isset($_SESSION['user_login'])) {
    $_SESSION['user_login'] = FALSE;
}

$nav = filter_input(INPUT_GET, 'navito');
if (!isset($nav)) {
    $nav = "home";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php include_once('include/head.php'); ?>
        <script type="text/javascript" src="include/my_js.js"></script>


    </head>
    <body>
        <?php
        if (!$_SESSION['user_login']) {
            include_once './Login.php';
        } else {
            ?>
            <nav>
                <ul>
                    <li><a href="?navito=home">Home</a></li>
                    <li><a href="?navito=genre">Genre</a></li>
                    <li><a href="?navito=book">Book</a></li>
                    <li><a href="?navito=progstud">Program Studi</a></li>
                    <li><a href="?navito=agenda">Agenda</a></li>
                    <li><a href="?navito=logout">Logout</a></li>
                    Selamat Datang : <?php echo $_SESSION['name']; ?>
                </ul>
            </nav>
            <?php
            switch ($nav) {
                case 'home':
                    include_once './home.php';
                    break;

                case 'genre': {
                        $command = filter_input(INPUT_GET, 'command');
                        if ($command == 'update') {//ini untuk halaman update
                            include_once './update_genre.php';
                        } else {
                            include_once './genre.php';
                        }
                    }
                    break;

                case 'book':
                    $command = filter_input(INPUT_GET, 'command');
                    if ($command == 'update') {
                        include_once './update_buku.php';
                    } else {
                        include_once './book.php';
                    }
                    break;

                case 'progstud':
                    $command = filter_input(INPUT_GET, 'command');
                    if ($command == 'update') {
                        include_once './update_program_studi.php';
                    } else {
                        include_once './program_studi.php';
                    }
                    break;

                case 'agenda':
                    $command = filter_input(INPUT_GET, 'command');
                    if ($command == 'update') {
                        include_once './update_agenda.php';
                    } else {
                        include_once './agenda.php';
                    }
                    break;

                case 'logout':
                    session_unset();
                    session_destroy();
                    header("location:index.php");
                    break;
            }
        }
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tableId').DataTable();
            });
        </script>
    </body>
</html>

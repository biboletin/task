<?php
include 'config.php';

if (!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] !== LOGGED_IN) {
    header('Location: index.php');
}

$users = $mysqli->sqlQuery('SELECT id, username, email FROM users');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>Dashboard</h1>
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Action</td>
                </tr>
<?php

    if (empty($users)) {
?>
                    <tr>
                        <td colspan="4">Няма намерени резултати</td>
                    </tr>
            </table>
        </div>
<?php
        exit;
    }

    foreach ($users as $user) {
?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        
                    </td>
                </tr>
<?php
    }
?>
    </table>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
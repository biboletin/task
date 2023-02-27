<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Register Form</h2>
                <div class="text-center mb-5 text-dark">Made with bootstrap</div>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" id="register" action="actions.php?form=register" method="post">

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="Username" placeholder="Username" autofocus required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="E-mail" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <strong id="invalid_password"></strong>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                            <strong id="password_not_match"></strong>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100">Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.querySelector('#register').onsubmit = function() {
            let password = document.querySelector('#password').value;
            let confirm_password = document.querySelector('#confirm_password').value;

        };

        document.querySelector('#password').onblur = function() {
            if (this.value.length < 5) {
                document.querySelector('#invalid_password').innerHTML = 'Too short password! minimum 5 symbols';
                return false;
            }
            document.querySelector('#invalid_password').innerHTML = '';
            return true;
        };

        document.querySelector('#confirm_password').onblur = function() {
            if (this.value !== document.querySelector('#password').value) {
                document.querySelector('#password_not_match').innerHTML = 'Passwords doesn`t match!';
                this.focus();
                return false;
            }
            document.querySelector('#password_not_match').innerHTML = '';
            return true;
        };
    </script>
</body>

</html>
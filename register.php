<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sigmar+One&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="iziToast-master/dist/css/iziToast.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <title>Bingo!</title>
</head>
<body>
    <div class="title-header">
        <h1 class="title">M</h1>
        <h1 class="title">A</h1>
        <h1 class="title">T</h1>
        <h1 class="title">H</h1>
        <h2 id="second-title" style="display:inline;">BINGO</h2>
    </div>
    <div id="log-in-form">
        <p>Register new account:</p>
        <hr style="border-color: black;">
        <p>Username: </p><input type="text" class="form-input" id="username">
        <p>Password: </p><input type="password" class="form-input" id="password">
        <p>Select account type:</p>
        <select name="type" id="type" style="display:block;margin:auto ">
            <option value="Student" selected>Student</option>
            <option value="Teacher">Teacher</option>
        </select>
        <button class="homepage-btn register" style="height: 7vh">Register</button>
    </div>
</body>
    
<script src="iziToast-master/dist/js/iziToast.min.js"></script>
<script>

$(document).on('click', '.register', function() {
            $.ajax({
                url: 'account_management.php',
                type: 'POST',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    type: $('#type').val()
                },
                success: function(resp) {
                   console.log(resp)
                   iziToast.info({
                            displayMode: 2,
                            message: resp+'!',
                            timeout: 3000,
                            position: 'topCenter',
                        });
                    if(resp == 'Account successfully registered'){
                        setTimeout(() => {
                            window.location.href = 'login.php'
                        }, 3000);             
                    }
                }
            })
        })
</script>

</html>
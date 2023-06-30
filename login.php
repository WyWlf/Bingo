<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sigmar+One&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="iziToast-master/dist/css/iziToast.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Bingo!</title>
</head>
<body>
    <div class="title-header">
        <h1 class="title">M</h1>
        <h1 class="title">A</h1>
        <h1 class="title">T</h1>
        <h1 class="title">H</h1>
        <h2 id="second-title" style="display:inline">BINGO</h2>
    </div>
    <div id="log-in-form">
        <p>Enter your credentials:</p>
        <p>Username: </p><input type="text" class="form-input" id="username">
        <p>Password: </p><input type="password" class="form-input" id="password">
        <button class="homepage-btn login" style="height: 7vh">Log-in</button>
    </div>
</body>
<script src="iziToast-master/dist/js/iziToast.min.js"></script>
<script>
        $(document).on('click', '.login', function(){
            $.ajax({
                type: 'POST',
                url: 'login_function.php',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function(res){
                    console.log(res)
                    if (res == 'Student'){
                    iziToast.info({
                            displayMode: 2,
                            message: 'Success!',
                            timeout: false,
                            position: 'topCenter',
                        });
                        setTimeout(() => {
                            window.location.href = "student_menu.html"
                        }, 500);
                    } else if (res == 'Teacher'){
                        iziToast.info({
                            displayMode: 2,
                            message: 'Success!',
                            timeout: false,
                            position: 'topCenter',
                        });
                        setTimeout(() => {
                            window.location.href = "teacher_menu.html"
                        }, 500);
                    } else {
                        iziToast.info({
                            displayMode: 2,
                            message: res+'!',
                            timeout: false,
                            position: 'topCenter',
                        });
                    }
                }
            })
        })
</script>

</html>
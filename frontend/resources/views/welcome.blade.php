<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Noble Mutuwa Djangp + Laravel app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/izitoast/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="">
</head>
<body style="background-image: url('https://itchronicles.com/wp-content/uploads/2020/08/devops-faq-1.jpg'); background-size: cover;">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Mutuwa Django + Laravel app</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5" >
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Mutuwa's Microservice app</div>

                <div class="card-body" >
                    <form method="POST" action="javascript:submitForm()" id="loginForm">
                        @csrf

                        <div class="form-group">
                            <label for="name"> Username</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Gnender</label>
                            <input type="text" name="gender" id="gender" class="form-control" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- 
//izzi toast strnatcasecmp -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>
<script src=""></script>
<script src=""></script>


<script>
function submitForm() {
    var username = $('#name').val();
    var email = $('#email').val();
    var city = $('#city').val();
    var gender = $('#gender').val();
    // var password = $('#password').val();

    console.log(username);


    $.ajax({
    url: 'http://127.0.0.1:8000/auth/signup/',
    type: 'POST',
    data: JSON.stringify({ 
        "username": username ,
        "email": email ,
        "city": city ,
        "gender": gender ,
    }),
    contentType: 'application/json',
    success: function(data) {
        console.log(data.message);

        if(data.message == 'User with this email already exists'){
            iziToast.error({
                title: 'Error',
                message: 'Oooops, the user already exists',
                position: 'topRight', // bottomRight,
            });
        } else{
            iziToast.success({
                    title: 'Yeeey',
                    message: 'Registration has ben submitted',
                    position: 'topRight', // bottomRight,
                });
        }

    },
    error: function(error) {
        console.error('Error:', error);
    }
});

}

</script>

</body>
</html>

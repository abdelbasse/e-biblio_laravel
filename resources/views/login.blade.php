<!DOCTYPE html>
<html lang="en">
<style>
    /* Google Fonts - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #1d3136;
        column-gap: 30px;
    }

    .form {
        max-width: 30%;

        position: absolute;
        color: #f2f2f2;
        width: 100%;
        padding: 30px;
        border-radius: 6px;
        background: #1d3136;
    }

    .form.signup {
        opacity: 0;
        pointer-events: none;
    }

    .forms.show-signup .form.signup {
        opacity: 1;
        pointer-events: auto;
    }

    .forms.show-signup .form.login {
        opacity: 0;
        pointer-events: none;
    }

    header {
        font-size: 28px;
        font-weight: 600;
        color: #232836;
        text-align: center;
    }

    form {
        margin-top: 30px;
    }

    .form .field {
        position: relative;
        height: 50px;
        width: 100%;
        margin-top: 20px;
        border-radius: 6px;
    }

    .field input,
    .field button {
        height: 100%;
        width: 100%;
        border: none;
        font-size: 16px;
        font-weight: 400;
        border-radius: 6px;
    }

    .field input {
        outline: none;
        padding: 0 15px;
        border: 1px solid#CACACA;
    }

    .field input:focus {
        border-bottom-width: 2px;
    }

    .eye-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        font-size: 18px;
        color: #8b8b8b;
        cursor: pointer;
        padding: 5px;
    }

    .field button {
        color: #fff;
        background-color: #0171d3;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .field button:hover {
        background-color: #1d3136;
    }

    .form-link {
        text-align: center;
        margin-top: 10px;
    }

    .form-link span,
    .form-link a {
        font-size: 14px;
        font-weight: 400;
        color: #f2f2f2;
    }

    .form a {
        color: #0171d3;
        text-decoration: none;
    }

    .form-content header {
        color: #f2f2f2;
    }

    .form-content a:hover {
        text-decoration: underline;
    }

    .line {
        position: relative;
        height: 1px;
        width: 100%;
        margin: 36px 0;
        background-color: #1d3136;
    }

    .line::before {
        content: 'Or';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #1d3136;
        color: #8b8b8b;
        padding: 0 15px;
    }

    .media-options a {
        display: flex;
        align-items: center;
        justify-content: center;
    }


    #alertsContainer {
        z-index: 999;
        max-height: 300px;
        overflow: hidden;
        position: fixed;
        top: 80px;
        right: 10px;
        display: flex;
        flex-direction: column-reverse;
        align-items: flex-end;
    }

    @media screen and (max-width: 767.2px) {
        .form {
            padding: 0px 10px;
            max-width: 95%;
        }

    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Responsive Login and Signup Form </title>

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="row p-0 m-0 " style="min-width: 100%;">
        <div class="p-0 m-0 col-md-8  col-sm-8 d-flex justify-content-center align-items-center">
            <div style="width: 80%;">
                <img src="{{ asset('images/logingBG.png') }}" width="100%" alt="">
            </div>
        </div>
        <div class="p-0 m-0 col-md-4 col-12">
            <section class="container forms p-0 m-0" style="min-width: 100%;">
                <div class="container" style="max-width: 500px;">

                    <div class="form login">
                        <div class="form-content">
                            <header>Login</header>
                            <form action="" method="POST">
                                @csrf
                                <input type="text" name="type" value="log" hidden>
                                <div class="field input-field">
                                    <input type="email" placeholder="Email" class="input" name="email">
                                </div>

                                <div class="field input-field">
                                    <input type="password" placeholder="Password" class="password" name="password">
                                    <i class='bx bx-hide eye-icon'></i>
                                </div>

                                <div class="form-link">
                                    <a href="#" class="forgot-pass">Forgot password?</a>
                                </div>

                                <div class="field button-field">
                                    <button>Login</button>
                                </div>
                            </form>

                            <div class="form-link">
                                <span>Don't have an account? <a href="#"
                                        class="link signup-link">Signup</a></span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Signup Form -->

                <div class="form signup">
                    <div class="form-content">
                        <header>Signup</header>
                        <form action="" method="POST">
                            @csrf
                            <input type="text" name="type" value="sign" hidden>
                            <div class="field input-field">
                                <input type="text" placeholder="Name" class="input" name='name'>
                            </div>

                            <div class="field input-field">
                                <input type="email" placeholder="Email" class="input" name='email'>
                            </div>

                            <div class="field input-field">
                                <input type="password" placeholder="Create password" class="password" name='password'>
                            </div>

                            <div class="field input-field">
                                <input type="password" placeholder="Confirm password" class="password"
                                    name='password_confirmation'>
                                <i class='bx bx-hide eye-icon'></i>
                            </div>

                            <div class="field button-field">
                                <button>Signup</button>
                            </div>
                        </form>

                        <div class="form-link">
                            <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <div id="class_have_errue_message" hidden>
        @error('Ereur')
            {!! $message !!}
        @enderror
    </div>

    <div id="alertsContainer">
    </div>

</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<script>
    const forms = document.querySelector(".forms"),
        pwShowHide = document.querySelectorAll(".eye-icon"),
        links = document.querySelectorAll(".link");

    pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () => {
            let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

            pwFields.forEach(password => {
                if (password.type === "password") {
                    password.type = "text";
                    eyeIcon.classList.replace("bx-hide", "bx-show");
                    return;
                }
                password.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide");
            })

        })
    })

    links.forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault(); //preventing form submit
            forms.classList.toggle("show-signup");
        })
    })
</script>


<script>
    setInterval(clearAlertsContainer, 10000);

    function clearAlertsContainer() {
        // Find the alerts container element
        var alertsContainer = document.getElementById('alertsContainer');

        // Clear the content of the alerts container
        alertsContainer.innerHTML = '';
    }
</script>
<script>
    var alertsContainer = document.getElementById('alertsContainer');

    function showAlertS(message) {
        alertsContainer.innerHTML += `<div class="alert d-flex justify-content-between alert-success bg-success text-white alert-dismissible" style="opacity:0.65;" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" role="img" style="width:20px; height:20px;" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>${message}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;

    }

    function showAlertD(message) {
        alertsContainer.innerHTML += `<div class="alert d-flex justify-content-between alert-danger bg-danger text-white  alert-dismissible" style="opacity:0.65;" role="alert">
        <svg class="bi flex-shrink-0 me-1" role="img" style="width:20px; height:20px;" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
<div>
<div>${message}</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
    }
</script>


<script>
    var errorMessage = document.getElementById('class_have_errue_message').innerHTML;
    if (errorMessage && errorMessage.trim() !== ""){
        showAlertD(errorMessage);
    }
</script>


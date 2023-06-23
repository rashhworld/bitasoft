<html lang="en">

<head>
  <title>Bitasoft | Best in Tech Analysis</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta property="og:image" content="<?= base_url('assets/metaicons/android-chrome-512x512.png') ?>" />
  <link rel="shortcut icon" href="<?= base_url('assets/metaicons/favicon.ico') ?>">

  <link rel="stylesheet" href="<?= base_url('assets/plugin/css/main.css?v=') . time() ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
  <script src="<?= base_url('assets/plugin/js/main.js?v=') . time() ?>"></script>
</head>
<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" /></div>
                <div class="formBx">
                    <form action="" class="validateAdminLogin">
                        <h2 class="mb-3">ADMIN LOGIN</h2>
                        <input type="email" name="aEmail" placeholder="Enter Email" />
                        <input type="password" name="aPass" placeholder="Enter Password" />
                        <input type="submit" name="" value="Login" onclick="validateAdminLogin()" />
                        <p class="signup">
                            Don't have account?
                            <a href="#" onclick="toggleForm();">Sign Up.</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="" onsubmit="return false;">
                        <h2 class="mb-3">Create Account</h2>
                        <input type="text" name="" placeholder="Username" />
                        <input type="email" name="" placeholder="Email Address" />
                        <input type="password" name="" placeholder="Create Password" />
                        <input type="password" name="" placeholder="Confirm Password" />
                        <input type="submit" name="" value="Sign Up" />
                        <p class="signup">
                            Already have account?
                            <a href="#" onclick="toggleForm();">Sign in.</a>
                        </p>
                    </form>
                </div>
                <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img2.jpg" alt="" /></div>
            </div>
        </div>
    </section>
</body>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    section {
        position: relative;
        min-height: 100vh;
        background-color: #112a42;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    section .container {
        position: relative;
        width: 800px;
        height: 500px;
        background: #fff;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    section .container .user {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
    }

    section .container .user .imgBx {
        position: relative;
        width: 50%;
        height: 100%;
        background: #ff0;
        transition: 0.5s;
    }

    section .container .user .imgBx img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    section .container .user .formBx {
        position: relative;
        width: 50%;
        height: 100%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        transition: 0.5s;
    }

    section .container .user .formBx form h2 {
        font-size: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
        color: #555;
    }

    section .container .user .formBx form input {
        position: relative;
        width: 100%;
        padding: 10px;
        background: #f5f5f5;
        color: #333;
        border: none;
        outline: none;
        box-shadow: none;
        margin: 8px 0;
        font-size: 14px;
        letter-spacing: 1px;
        font-weight: 300;
    }

    section .container .user .formBx form input[type='submit'] {
        width: 100%;
        background: #677eff;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 1px;
        transition: 0.5s;
    }

    section .container .user .formBx form .signup {
        position: relative;
        margin-top: 20px;
        font-size: 12px;
        letter-spacing: 1px;
        color: #555;
        text-transform: uppercase;
        font-weight: 300;
    }

    section .container .user .formBx form .signup a {
        font-weight: 600;
        text-decoration: none;
        color: #677eff;
    }

    section .container .signupBx {
        pointer-events: none;
    }

    section .container.active .signupBx {
        pointer-events: initial;
    }

    section .container .signupBx .formBx {
        left: 100%;
    }

    section .container.active .signupBx .formBx {
        left: 0;
    }

    section .container .signupBx .imgBx {
        left: -100%;
    }

    section .container.active .signupBx .imgBx {
        left: 0%;
    }

    section .container .signinBx .formBx {
        left: 0%;
    }

    section .container.active .signinBx .formBx {
        left: 100%;
    }

    section .container .signinBx .imgBx {
        left: 0%;
    }

    section .container.active .signinBx .imgBx {
        left: -100%;
    }

    @media (max-width: 991px) {
        section .container {
            max-width: 400px;
        }

        section .container .imgBx {
            display: none;
        }

        section .container .user .formBx {
            width: 100%;
        }
    }
</style>

<script>
    const toggleForm = () => {
        const container = document.querySelector('.container');
        container.classList.toggle('active');
    };
</script>
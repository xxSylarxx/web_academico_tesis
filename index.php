<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/icons/logo.png" type="image/png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">

<body class="text-center">
    <!-- styles -->
    <style>
        body {
            height: 100vh;
            background-image: linear-gradient(to right bottom, #845ec2, #9c5dc0, #b15dbc, #c55cb7, #d65db1);
        }

        main.card {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 340px;
            transform: translate(-50%, -54%);
            padding: 1% .8%;
            box-shadow: 0 0 24px black;
        }
    </style>

    <!-- content -->
    <main class="form-signin card shadow">
        <img class="mb-4" src="images/favicon.png" id="user_image" alt="" width="100" height="100">
        <h1 class="h3 mb-3 fw-normal" id="user_name">Acceso</h1>
        <!-- <div class="card-body">
            <div class="text-center pt-2 pb-3">
                <img src="./assets/img/icons/logo.png" id="user_image" height="130">
                <h4 class="fw-bold mt-3">Academic</h4>
            </div> -->

        <input type="text" id="usuario" name="usuario" class="form-control mb-3" placeholder="Nombre de usuario" value="USERCUBICOL" required>
        <input type="password" id="pass" name="palabra_secreta" class="form-control mb-3" placeholder="Contraseña" value="Pass20022@CUBICOL" required>
        <button onclick="loginWithGoogle()" class="w-100 btn btn-lg btn-primary" id="login_btn">Iniciar con Google</button>
        <button onclick="logout()" style="display: none;" class="w-100 btn btn-lg btn-danger" id="logout_btn">Salir</button>


        </div>
    </main>





    <!-- <main class="form-signin">

        <img class="mb-4" src="images/favicon.png" id="user_image" alt="" width="100" height="100">
        <h1 class="h3 mb-3 fw-normal" id="user_name">Acceso</h1>

        <button onclick="loginWithGoogle()" class="w-100 btn btn-lg btn-primary" id="login_btn">Iniciar con Google</button>

        <button onclick="logout()" style="display: none;" class="w-100 btn btn-lg btn-danger" id="logout_btn">Salir</button>
    </main> -->




    <!-- Script de boostrap -->
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>

    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-analytics.js"></script>

    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-firestore.js"></script>


    <script type="text/javascript">
        var firebaseConfig = {
            apiKey: "AIzaSyBdZV9wfSdPY4Bnbr7ngvbXSqNKpe3IcLE",
            authDomain: "webacademico-c814e.firebaseapp.com",
            projectId: "webacademico-c814e",
            storageBucket: "webacademico-c814e.appspot.com",
            messagingSenderId: "403853633777",
            appId: "1:403853633777:web:3f858e5f1ea3fe6f1ea150",
            measurementId: "G-DSC9XFX13Q"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>

    <script type="text/javascript">
        //variables
        var login_btn = document.getElementById("login_btn"),
            logout_btn = document.getElementById("logout_btn"),
            user_image = document.getElementById("user_image"),
            user_name_h1 = document.getElementById("user_name");

        //iniciar con Google
        var loginWithGoogle = function() {

            var provider = new firebase.auth.GoogleAuthProvider();
           
            firebase.auth().signInWithPopup(provider).then(function(result) {
                // This gives you a Google Access Token. You can use it to access the Google API.
                var token = result.credential.accessToken;
                // The signed-in user info.
                var user = result.user;

                console.log(user.displayName);
                updateUser(user);
                // ...
            }).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // The email of the user's account used.
                var email = error.email;
                // The firebase.auth.AuthCredential type that was used.
                var credential = error.credential;
                // ...

                console.log(errorMessage);
            });
        }

        //agregar datos del usuario
        var updateUser = function(user) {
            user_name_h1.innerHTML = "Hola, " + user.displayName;
            user_image.src = user.photoURL;

            login_btn.style.display = "none";
            logout_btn.style.display = "inline-block";
        }

        var logout = function() {
            firebase.auth().signOut().then(function() {
                user_name_h1.innerHTML = "Acceso";
                user_image.src = "assets/images/JimeCoding.jpg";
                login_btn.style.display = "inline-block";
                logout_btn.style.display = "none";

            }).catch(function(error) {
                // An error happened.
            });

        }
    </script>

</body>

</html>
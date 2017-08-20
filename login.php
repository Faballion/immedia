<?php include 'header.php' ?> 

<div class="container" style="height: 91.6vh">
    <br> <br> <br> <br> <br> <br> <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-6"> 
            <form id="login-form">
                <input type="hidden" name="postType" value="loginUser">
                <p class="h5 text-center mb-4">Sign in</p>
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="text" name="login-email" class="form-control" required autofocus>
                    <label for="defaultForm-email">Your email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name="login-password" class="form-control"required >
                    <label for="defaultForm-pass">Your password</label>
                </div>

                <div class="text-center">
                    <button id="login-button" class="btn purple darken-3">Login</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include 'footer.php' ?>
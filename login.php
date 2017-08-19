<?php include 'header.php' ?> 

<div class="container" style="height: 100vh">
    <br> <br> <br> <br> <br> <br> <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-6"> 
            <form>
                <p class="h5 text-center mb-4">Sign in</p>
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="text" id="defaultForm-email" class="form-control" autofocus>
                    <label for="defaultForm-email">Your email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" id="defaultForm-pass" class="form-control">
                    <label for="defaultForm-pass">Your password</label>
                </div>

                <div class="text-center">
                    <button class="btn purple darken-3">Login</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include 'footer.php' ?>
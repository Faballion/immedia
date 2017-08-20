<?php include 'header.php' ?> 

<div class="container" style="height: 91.6vh">
    <br> <br> <br> <br> <br> <br> <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-6"> 
            <form id="register-form">
                <input type="hidden" name="postType" value="registerUser">
                <p class="h5 text-center mb-4">Create an account</p>
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" name="register-email" class="form-control" required autofocus>
                    <label for="defaultForm-email">Your email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name="register-password" class="form-control" required>
                    <label for="defaultForm-pass">Password</label>
				</div>
				
				<div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name="register-confirm-password" class="form-control" required>
                    <label for="defaultForm-pass">Confirm Password</label>
                </div>

                <div class="text-center">
                    <button id="register-button" class="btn purple darken-3">Register</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include 'footer.php' ?>
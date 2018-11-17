 <?php require APPROOT . "/views/template/header.php" ;  ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>CREATE YOUR ACCOUNT</h2>
            <p> Fill the form and easily register with us </p>

            <form action="<?php echo URLROOT; ?>/users/register" method="post">

            <div class="form-group">
                <label for="name">Name:<sup>*</sup></label>
                <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data["err_name"]))?"is-invalid":"" ?> " value="<?php echo $data["name"]; ?>">
                <span class="invalid-feedback"><?php echo $data["err_name"]; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:<sup>*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data["err_email"]))?"is-invalid":"" ?> " value="<?php echo $data["email"]; ?>">
                <span class="invalid-feedback"><?php echo $data["err_email"]; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data["err_password"]))?"is-invalid":"" ?> " value="<?php echo $data["password"]; ?>">
                <span class="invalid-feedback"><?php echo $data["err_password"]; ?></span>
            </div>

            <div class="form-group">
                <label for="password2">Confirm Password:<sup>*</sup></label>
                <input type="password" name="password2" class="form-control form-control-lg <?php echo (!empty($data["err_password2"]))?"is-invalid":"" ?> " value="<?php echo $data["password2"]; ?>">
                <span class="invalid-feedback"><?php echo $data["err_password2"]; ?></span>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" value="Register" class="btn btn-success btn-block"/>
                </div>
                <div class="col">
                    <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Login if u have an account!</a>
                </div>
            </div>
            
            </form>    
        </div>
    </div>
</div>

<?php require APPROOT . "/views/template/footer.php" ;  ?>
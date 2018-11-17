<?php require APPROOT . "/views/template/header.php" ;  ?>
    <div class="col-md-8 mx-auto">
        <a href="<?php echo URLROOT; ?>/posts/index" class="btn btn-light">
            <i class="fa fa-backward"></i> BACK
        </a>
        <div class="card card-body bg-light mt-5">

        <?php flash("register_success") ?>

            <h2>EDIT POST</h2>
            <p>Change your content </p>
            <form action="<?php echo URLROOT?>/posts/edit/<?php echo $data["postId"] ?>"  method="post">

                <div class="form-group">
                    <label for="title">Title:<sup>*</sup></label>
                    <input 
                    type="text" 
                    name="title" 
                    class="form-control form-control-lg <?php echo (!empty($data["err_title"]))?"is-invalid":"" ?> " 
                    value="<?php echo $data["title"]; ?>"
                    />
                    <span class="invalid-feedback"><?php echo $data["err_title"]; ?></span>
                </div>

                <div class="form-group">
                    <label for="body">Body:<sup>*</sup></label>
                    <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data["err_body"]))?"is-invalid":"" ?> " ><?php echo !empty($data["body"])? $data["body"] : "" ; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data["err_body"]; ?></span>
                </div>
                <input type="submit" class="btn btn-success " value=" E D I T " />
            </form>    
        </div>
    </div>


<?php require APPROOT . "/views/template/footer.php" ;  ?>
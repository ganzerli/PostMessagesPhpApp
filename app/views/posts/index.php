<?php require APPROOT . "/views/template/header.php"?>

<div class="container col-lg-10">
<div class="row mb-3">
    <div class="col-md-3">
        <span><h1>POSTS</h1></span>
        
    </div>
    <div class="col-md-6">
        <span><?php flash("post_message") ?></span>
    </div>
    <div class="col-md-3">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>

<?php foreach($data["posts"] as $post) : ?>

    <div class="card cared-body mb-3">
        <h4 class="card-title"> <?php echo $post->title; ?> </h4>
        <div class="bg-light p-2 mb-3">
        <!-- $post->name should be the access to the user table after jouning it in . posts rows are filled with the users tables where same users.id posts.user_id-->
            Written by <strong> <?php  echo $post->name;  ?> </strong> at <?php echo $post->postCreationDate ?>
        </div> 
        <p class="card-text"> <?php echo $post->body; ?> </p>
        <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId ?>" class="btn btn-dark">Discover More..</a>

    </div>

<?php endforeach; ?>
</div>


<?php require APPROOT . "/views/template/footer.php"?>
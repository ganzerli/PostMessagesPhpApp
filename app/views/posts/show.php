<?php require APPROOT . "/views/template/header.php";?>

<a href="<?php echo URLROOT; ?>/posts/index" class="btn btn-light">
    <i class="fa fa-backward"></i> BACK
</a>
<br/>

<h1> <?php echo $data["thePost"]->title; ?> </h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by:<strong class="text-uppercase"> <?php echo $data["userInfos"]->name ?> </strong> on <?php echo $data["thePost"]->creation_date ?>
</div>

<p>
    <?php echo $data["thePost"]->body; ?>
</p>
<hr>
<?php if(  ($_SESSION["user_id"] == $data["userInfos"]->id) && ( $_SESSION["user_id"] == $data["thePost"]->user_id )   ):?>

    <a href="<?php echo URLROOT ;?>/posts/edit/<?php echo $data["thePost"]->id ?>" class="btn btn-dark"> E D I T </a>

    <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data["thePost"]->id; ?>" method="post" class="pull-right">
        <input type="submit" value="DELETE" class="btn btn-danger" />
    </form>

<?php endif; ?>


<?php require APPROOT . "/views/template/footer.php";?>
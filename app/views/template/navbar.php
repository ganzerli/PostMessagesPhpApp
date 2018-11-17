<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
<div class="container col-md-9">

<?php if(!isset($_SESSION["user_id"])): ?>
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
  <?php else: ?>
    <a class="navbar-brand" href="<?php echo URLROOT; ?>/posts/index"><?php echo $_SESSION["user_name"] ?> &nbsp </a>
<?php endif; ?>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse"    data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"   aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URLROOT; ?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">ABOUT</a>
          </li>
        </ul>
        <!-- part floated to the side     ml-auto floats to the side   if the user is not logged in-->
        <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION["user_id"])): ?>
      
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Log Out <span class="sr-only">(current)</span></a>
          </li>
        <?php else: ?>  
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
          </li>
        <?php endif; ?>

        </ul>
      </div>
    </div>
</nav>

<!-- will be imported in the header -->
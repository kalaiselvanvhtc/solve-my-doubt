<link rel='SHORTCUT ICON' href='<?=ROOT_URL?>images/web_hi_res_512.png' type='image/x-icon' />
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
 <span class="icon-bar"></span> 
 <span class="icon-bar"></span> 
 <span class="icon-bar"></span> 
 </button>
      <a class="navbar-brand" style="font-weight: bold" href="<?=ROOT_URL?>?p=blog&a=all"><img class="smdlogo" src="<?=ROOT_URL?>images/smdlogo.png" />
      <p class="alwayslearning hidden">Spread the Knowledge!</p>
      </a>
      
    </div>
      <div id="myNavbar" class="navbar-collapse collapse">     
          <form class="navbar-form navbar-left"  action="/action_page.php">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
              <input type="hidden" name="isUserRegComlete" id="isUserRegComlete" value="<?=$_SESSION['getUserRegistrationComplete']?>" />
               <input type="hidden" name="isUserLoggedIn" id="isUserLoggedIn" value="<?=$_SESSION['is_logged']?>"  />
</form> 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">About</a></li>
      <li><a href="#">Features</a></li>
      <li><a href="#">Contact Us</a></li>
      <li class="home hidden"><a href="<?=ROOT_URL?>?p=blog&a=all">Home</a></li>
       <li class="askquestion hidden"><a href="<?=ROOT_URL?>?p=blog&a=add">Ask Question</a></li>
      <li class="userprofile hidden"><a href="<?=ROOT_URL?>?p=UserProfile&a=getuserinfo">My Profile</a></li>
      <li class="logout hidden"><a href="<?=ROOT_URL?>?p=admin&a=logout">Logout</a></li>
    </ul>
      </div>
    
  </div>
</nav>

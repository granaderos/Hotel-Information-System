<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: log-in.php');
	}

?>
<!DOCTYPE HTML>
<html>
<head>
          <script src="js/jquery-1.8.2.min.js"></script>
          <script src="js/homepage.js"></script>
          <script src="js/jquery-ui.js"></script>
          <link rel="stylesheet" href="CSS/jquery-ui.css" type="text/css"/>
 <style>
          #wew{
          font-family:"Purisa";
          font-size:30px;
          border:solid white;
          border-radius: 10px;
          width: 1000px; 
          }
          #lala{
          color:yellow;
          }
          #pink{
          color:pink;
         }
         #fb{
         cell-spacing: 0px;
         }
         #blog{
         cell-spacing: 0px;
         }
         #divi{
         background-color: white;
         width: 135px;
         border-radius: 15px;
         border-color: yellow;
         margin-left: 1100px;
         margin-bottom: 20px;
         }
         p{
         color: yellow;
         margin-bottom: 0px;
         margin-left: 900px;
         }
 </style>
</head>
         <body style="background:url(http://i908.photobucket.com/albums/ac286/myspace-backgrounds/219u.gif); background-attachment:fixed; background-position: bottom left; background-repeat:repeat; background-color:#000000 !important; text-align:center;" >
        <p>Follow us on</p>
        <div id = "divi">
                  <a id = "twt" href="http://twitter.com/BookandBorrow1" target="_blank"><img src="image.php/twitter.jpg"/></a>
                  <a id = "fb" href="http://www.facebook.com/bookandborrow" target="_blank"><img src="image.php/facebook.jpg"/></a>
                  <a id = "blog" href="http://bookandborrowdotcom.blogspot.in" target="_blank"><img src="image.php/blog.jpg"/></a>
         </div> 
         <a href="logout.php">Log-Out</a>       

<center>
<fieldset id="wew">
<a href="index.php" id="lala">My Dictionary</a>
<a href="Library.php" id="pink">My Library</a>
</fielset></center>
</body>
</html>

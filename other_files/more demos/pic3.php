<html>
<head>
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/homepage.js"></script>
 <script src="js/jquery-ui.js"></script>
 <link rel="stylesheet" href="CSS/jquery-ui.css" type="text/css"/>
 <style>
 #yellow{
color:yellow;
}
 #we{
 font-family:"Purisa";
 font-size:30px;
 border:solid white;
 border-radius: 30px;
 width:1000px; 
 }
 #pink{
 color:pink;
 }
 strong{
 color:yellow;
 }
 p{
 color:pink;
 }
 td{
 color: blue;
 }
 </style>

</head>
<body style="background:url(http://i908.photobucket.com/albums/ac286/myspace-backgrounds/219u.gif); background-attachment:fixed; background-position: bottom left; background-repeat:repeat; background-color:#000000 !important; text-align:center;" ><a href="logout.php">Log-Out</a>
<center>
<fieldset id="we">
<a href="Library.php" id="yellow">My Library</a>
<a href="index.php" id="pink">My Dictionary</a>
<a href="HomePage.php">Home</a>
</fieldset></center>
<form id="UserReview" name="UserReview" method="post" action="">

<table width="100%" cellpadding="5" cellspacing="0">

        <tr>
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1118201290329AM.JPG" alt="1118201290329AM.JPG" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> Thea Stilton and the Star Castaways</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>Thea Stilton is out of this world!<br />
A professor at Mouseford Academy is organizing a trip to outer space, and the Thea Sisters are invited. The mouselings are headed on a fabumouse mission... to the moon! After much preparation, the mice blast off. But when they arrive at their lunar vacation spot, things start to go wrong, including spaceship wrecks and rebellious robots. Can the Thea Sisters save the day? Find out in an adventure that's out of this world!<br />
;</p></td></tr>
        <tr><td><strong>Author Name:</strong>Geronimo Stilton</td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>C 0963</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9780545227742</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>160</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> <img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /></td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5572)"/>
          </td>
        </tr>
  </table>

	


    	
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="padding-left:20px;"><h2>Member reviews:</h2></div></td>
  </tr>
  
  
  <tr>
    <td><div style="padding-left:20px;">No Review</div></td>
  </tr>
  
</table>

</body>
</html>

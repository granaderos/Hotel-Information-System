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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1118201293649AM.jpeg" alt="" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> Sons of Sita</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>Ten years have passed since Rama did the unthinkable and banished Sita. Now, she spends her days in the remote forest ashram of Maharishi Valmiki training her sons at the arts of war, turning them into peerless warriors of exceptional acumen and prowess. To the sorrow of many, they seem unlikely to ever cross paths with their estranged father. Yet destiny works in unexpected ways Rama decides to launch the Ashwamedha yajna. The mightiest Ayodhyan army ever assembled follows the sacred stallion in a campaign of conquest. Defying the military might of Ayodhya and the emperorship of Rama himself, two young striplings capture the Ashwamedha horse and challenge the great army. To Rama's chagrin the challengers turn out to be none other than his own estranged offspring: the Sons of Sita! </p></td></tr>
        <tr><td><strong>Author Name:</strong> <a>Ashok K. Banker</a></td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>3776</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9788183282949</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>362</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> No Rating</td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5575)"/>
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

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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1113201293422PM.jpg" alt="" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> Stalky & Co</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>Based on Kipling's own adolescent experiences, Stalky  Co. is a cunning story of mischievous 19th century British schoolboys attempting scholastic mutiny. The faculty and headmaster of a boys' private school repeatedly pursue a trio of poetic pranksters, Stalky, Beetle and Turkey as they wage war on fellow students and the establishment with unwavering energy and creativity.<br />
<br />
</p></td></tr>
        <tr><td><strong>Author Name:</strong> <a href="AuthorDetails.asp?autID=451" style="font-size:14px; color:#000000; text-decoration:none;">Rudyard Kipling</a></td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>C 0961</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9780140350807</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>222</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> No Rating</td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5569)"/>
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

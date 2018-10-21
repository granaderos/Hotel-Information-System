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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/11152012105934PM.jpg" alt="11152012105934PM.jpg" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> The Mirror Crack'd  from Side to Side</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>One minute, silly Heather Babcock had been babbling on at her movie idol, the glamorous Marina Gregg. The next, Heather suffered a massive seizure, poisoned by a deadly cocktail. <br />
It seems likely that the cocktail was intended for the beautiful actress. But while the police fumble to find clues, Miss Marple begins to ask her own questions, because as she knows--even the most peaceful village can hide dark secrets.<br />
<br />
;</p></td></tr>
        <tr><td><strong>Author Name:</strong>Agatha Christie</td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>873</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9780007282494</td></tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> <img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /></td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5571)"/>
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

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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1112201290330PM.jpg" alt="" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> The Casual Vacancy</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>When Barry Fairbrother dies in his early forties, the town of Pagford is left in shock. <br />
Pagford is, seemingly, an English idyll, with a cobbled market square and an ancient abbey, but what lies behind the pretty faade is a town at war. <br />
Rich at war with poor, teenagers at war with their parents, wives at war with their husbands, teachers at war with their pupils Pagford is not what it first seems. <br />
And the empty seat left by Barry on the parish council soon becomes the catalyst for the biggest war the town has yet seen. Who will triumph in an election fraught with passion, duplicity and unexpected revelations? <br />
A big novel about a small town, The Casual Vacancy is J.K. Rowlings first novel for adults. It is the work of a storyteller like no other.<br />
</p></td></tr>
        <tr><td><strong>Author Name:</strong> <a>J.K. Rowling</a></td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>3774</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9781408704202</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>503</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> <img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate1.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /><img src='image.php/rate.gif' width=10 Height=10 /></td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5568)"/>
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

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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1112201285419PM.jpg" alt="" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> Jane Eyre Laid Bare</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>Everyone is familiar with Charlotte Bront's passionate, but restrained novel in which the plain, yet spirited governess Jane Eyre falls for the arrogant Mr. Rochester. Its a novel that simmers with sexual tension but never quite reaches the boiling point. Which is to be expected. After all, the original was written in 1847. That was then. This is now. And in <strong>Jane Eyre Laid Bare</strong>, author Eve Sinclair writes between the lines to chart the smoldering sexual chemistry between the long-suffering governess and her brooding employer. <br />
When an eager and curious Jane Eyre arrives at Thornfield Hall her sexual desires are awakened. Who is the enigmatic Rochester and why is she attracted to him? What are the strange, yet captivating noises coming from the attic, and why does the very air she breathes feel heavy with passion? Only one thing is certain. Jane Eyre may have arrived at Thornfield an unfulfilled and tentative woman, but she will leave a very different person <br />
</p></td></tr>
        <tr><td><strong>Author Name:</strong> <a>Eve Sinclair</a></td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>3771</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9781447229285</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>322</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> No Rating</td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5565)"/>
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

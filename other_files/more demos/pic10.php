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
          <td width="31%" rowspan="10" valign="top"><div align="center"><img src="image.php/1112201284937PM.jpg" alt="" width="91" height="138"/></div></td>
          <td width="69%"><strong>Book Title:</strong> Cloud Atlas</td>
    </tr>
        <tr><td><strong>Desc:</strong> <p>From David Mitchell, the Booker Prize nominee, award-winning writer and one of the featured authors in Grantas Best of Young British Novelists 2003 issue, comes his highly anticipated third novel, a work of mind-bending imagination and scope.<br />
A reluctant voyager crossing the Pacific in 1850; a disinherited composer blagging a precarious livelihood in between-the-wars Belgium; a high-minded journalist in Governor Reagans California; a vanity publisher fleeing his gangland creditors; a genetically modified dinery server on death-row; and Zachry, a young Pacific Islander witnessing the nightfall of science and civilisation -- the narrators of Cloud Atlas hear each others echoes down the corridor of history, and their destinies are changed in ways great and small.<br />
In his captivating third novel, David Mitchell erases the boundaries of language, genre and time to offer a meditation on humanitys dangerous will to power, and where it may lead us.<br />
</p></td></tr>
        <tr><td><strong>Author Name:</strong> <a>David Mitchell</a></td></tr>
        <tr>
          <td> <strong>Reference Number:</strong>3770</td>
        </tr>
        <tr><td><strong>ISBN:</strong> 9781444761788</td></tr>
        
        <tr>
          <td><strong>Number of Pages: </strong>529</td>
        </tr>
        
        <tr><td><strong>Book rating:</strong> No Rating</td></tr>
        <tr><td><strong>Author rating:</strong> No Rating</td></tr>
        <tr>
          <td>            <input type="hidden" name="CategoryID" id="hiddenField" />
            <input type="hidden" name="BookRefID" id="BookRefID" />
            
          
          <input type="button" name="button2" id="button2" value="Register"   onclick="GoRegister(5564)"/>
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

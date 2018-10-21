<html>
<head>
          <script src="js/jquery-1.8.2.min.js"></script>
          <script src="js/homepage.js"></script>
          <script src="js/jquery-ui.js"></script>
          
          <link rel="stylesheet" href="CSS/jquery-ui.css" type="text/css"/>
<style>
         img.delete{
         cursor: pointer;

         }
         #id{
         cursor: pointer;
         color: white;
         }

         .set{
         background-color: green;
         width:500px;
         border:solid yellow;
         border-radius: 30px;
         }
         .leg
         {
         color:yellow;
         font-family:"Purisa";

         }
         .yet{
         color:white;
         font-size:20px;
         background-color: blue;
         width:600px;
         height: 125px;
         border:solid red;
         margin-top: 50px;
         border-radius: 80px;
         }
         #dialog{
         display: none;
         }
         #dialog2{

         }
         .pi{
         color: white;
         text-align:right;
         }
         #empty{
         color: white;
         background-color: green;
         width:500px;
         border:solid yellow;
         border-radius: 30px;
         }

         .lee{
         color:yellow;
         font-family:"Purisa";
         font-size:50px;
         }
         #wee{
         background-color: black;
         width:800px;
         border:solid white;
         border-radius: 10px;
         }
          #wew{
          font-family:"Purisa";
          font-size:30px;
          border:solid white;
          border-radius: 10px; 
          width: 1000px;
          }
          #s{
          color:yellow;
          }


</style>



</head> 

         <body style="background:url(http://i908.photobucket.com/albums/ac286/myspace-backgrounds/219u.gif); background-attachment:fixed; background-position: bottom left; background-repeat:repeat; background-color:#000000 !important; text-align:center;" ><a href="logout.php">Log-Out</a>
<p class="pi">Date: <input type="text" id="datepicker" /></p>
<center>
<fieldset id="wew">
         <a href="Library.php">Library</a>
         <a href="HomePage.php" id="s">Home</a>
</fieldset></center>
         <h1 class="lee">Dictionary</h1>

 <center><div><fieldset id="wee" />
        <img id="id" src="image.php/kamote.png"/>
        <input type="text" name="search" placeholder="search file:" /><br>
        <table class ="words" id="empty" border="1"  > <br>      
        </table><br>
        <b class="leg" >SEARCHING WORD</b>
        </div><center/>
        </p>
     <center><div class="yet">
     <br>
                  Words:<input type ="text" name="word" placeholder="provide your words"> </input>
                 Definition:<input type ="text" name="definition" placeholder="provide your Definition"> </input><br>
      <input type="hidden" name="id"/>
      
     </br>
        <button id="btn_add">ADD WORD</button> 
        <button id="btn_save">SAVE</button>
        </br>
         </div><center/>
         <br/><br/>
           <button  id="opener" href="#">Open list</button>
           <div id="dialog2" title="click right side to close">
         <center><fieldset class="set"/>
	<b class="leg" >ADD WORD</b>
        <table class ="words" border="1" >
                <tr>
                <th>ID</th>
                <th>WORD</th>
                <th>DEFINITION</th>
                <th>DELETE/EDIT</th>
                </tr>
                <tbody id="bdy"></tbody>
        </table></div><center/>
        <div id ="dialog" title="DELETE words" ><span>Do you delete this words? yes or joke<span></div>
</body>

</html>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>
    <body>
    <div class="center">    
    <header>    
    <h1>Contact</h1>
    </header>        
    <nav> 
    <ul class="menu"> 
        <li><a href="index.html">Startpagina</a></li> 
        <li><a href="about.html">Over mij</a></li> 
        <li><a href="contact.php">Contact</a></li> 
    </ul>
    </nav>
 <?php
      $name = $_POST['firstname'];
 ?>
        <form action="contact.php" method="post">
            <div class="invoervelden">
                <label for="salutation">Aanhef:</label>
                    <select class="sel" id="salutation" name="salutation">
                        <option value="man">Dhr.</option>
                        <option value="woman">Mvr.</option>
                        <option value="different">Anders</option>
                    </select><br>
                <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="firstname" placeholder="Typ hier uw naam" value="<?php echo $name;?>"><br>
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="emailadress" placeholder="Typ hier uw e-mailadres"><br> 
                <label for="phone">Telefoonnummer:</label>
                    <input class="sw" type="text" id="phone" name="phonenumber" placeholder="Typ hier uw telefoonnummer"><br>
                <label for="street">Straatnaam</label>
                    <input class="sw" type="text" id="street" name="streetname" placeholder="Typ hier uw straat"><br>  
                <label for="strnr">Huisnummer</label>
                    <input class="sw" type="text" id="strnr" name="streetnumber" placeholder="Typ hier uw huiwsnummer"><br>
                <label for="zpcd">Postcode</label>
                    <input class="sw" type="text" id="zpcd" name="zipcode" placeholder="Typ hier uw postcode als 1234 AB"><br>
                <label for="resid">Woonplaats</label>
                    <input class="sw" type="text" id="resid" name="residence" placeholder="Typ hier uw woonplaats"><br>
                <br>   
            </div>
            <div>
            Kies uw communicatievoorkeur:<br>
                <input type="radio" id="email" name="communicatievoorkeur" value="E-mail">
                    <label for="email">E-mail</label><br>
                <input type="radio" id="phone" name="communicatievoorkeur" value="Phone">
                    <label for="phone">Telefoon</label><br>
                <input type="radio" id="pst" name="communicatievoorkeur" value="Post">
                    <label for="pst">Post</label><br>
                <br>
            </div>
            <div class="invoervelden">    
            Waarover wilt u contact opnemen?<br>
                <textarea class="sw" name="message" rows="4" cols="53" placeholder="Typ hier uw vraag"></textarea><br>
                <br>
                <input class="knop" type="submit" Value="Verstuur">
            </div>    
        </form>
        <footer>
            <p>&copy; 2023 <a class="auteur" href="//localhost:80/educom-webshop-basis-1699355222/about.html">Nicole Goris</a></p>
        </footer>
    </div>
    </body> 
</html>
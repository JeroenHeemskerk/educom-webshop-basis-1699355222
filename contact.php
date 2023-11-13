<?php

function showContactHeader()
{ 
    echo '<h1>Contact</h1>';
}

/*<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>
<?php
 $salut = $name = $com = $email = $phone = $street = $strnr = $zpcd = $resid = $message = ""; 
 $salutErr = $nameErr = $comErr = $emailErr = $phoneErr = $streetErr = $strnrErr = $zpcdErr = $residErr = $messageErr = ""; 
 $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["salut"])) {                       
            $salutErr = "Aanhef is verplicht";
        } else {
            $salut = $_POST['salut'];
        }
        if (empty($_POST["firstname"])) {
            $nameErr = "Naam is verplicht";
        } else {
            $name = $_POST['firstname'];
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "U kunt hier alleen letters invullen";
            }
        }
        if (empty($_POST["message"])) {
            $messageErr = "Vraag is verplicht";
        } else {
            $message = $_POST['message'];
        }
        if (empty($_POST["com"])) {
            $comErr = "Communicatievoorkeur is verplicht";
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
        } else {
            $com = $_POST['com'];
        }
        if ($com =="E-mail") {
            if (empty($_POST["emailadress"])) {
                $emailErr = "E-mailadres is verplicht";
                $phone = $_POST['phonenumber'];
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
                if (!empty($_POST["streetname"]) || !empty($_POST["strnr"]) || !empty($_POST["zpcd"]) || !empty($_POST["resid"])) {
                    $streetErr = $strnrErr = $zpcdErr = $residErr = "Uw adresgegevens zijn niet volledig";
                }
            } else {
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
                if (!empty($_POST["streetname"]) || !empty($_POST["strnr"]) || !empty($_POST["zpcd"]) || !empty($_POST["resid"])) {
                    $streetErr = $strnrErr = $zpcdErr = $residErr = "Uw adresgegevens zijn niet volledig";
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Dit e-mailadres lijkt niet te kloppen";
                }
            }    
        }    
        else if ($com =="Phone") {                                     
            if (empty($_POST["phonenumber"])) {
                $phoneErr = "Telefoonnummer is verplicht";
                $email = $_POST['emailadress'];                              
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
                if (!empty($_POST["streetname"]) || !empty($_POST["strnr"]) || !empty($_POST["zpcd"]) || !empty($_POST["resid"])) {
                    $streetErr = $strnrErr = $zpcdErr = $residErr = "Uw adresgegevens zijn niet volledig";
                }
            } else {
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
                if (!empty($_POST["streetname"]) || !empty($_POST["strnr"]) || !empty($_POST["zpcd"]) || !empty($_POST["resid"])) {
                    $streetErr = $strnrErr = $zpcdErr = $residErr = "Uw adresgegevens zijn niet volledig";
                }
                if (!preg_match('/^[0-9 -+]+$/', $phone)) { 
                    $phoneErr = "Dit lijkt geen goed telefoonnummer"; 
                }
            }     
        }
        else if ($com == "Mail") {                              
            if (empty($_POST["streetname"])) {                  
                $streetErr = "Staatnaam is verplicht";          
            } else {
                $street = $_POST ['streetname'];
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
            }
            if (empty($_POST["strnr"])) {
                $strnrErr = "Huisnummer is verplicht";
            } else {
                $strnr = $_POST ['strnr'];
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
            } 
            if (empty($_POST["zpcd"])) {
                $zpcdErr = "Postcode is verplicht";
            } else {
                $zpcd = $_POST['zpcd'];
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
            }  
            if (empty($_POST["resid"])) {
                $residErr = "Woonplaats is verplicht";
            } else {
                $resid = $_POST['resid'];
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
            }  
            if (empty($_POST["streetname"]) && empty($_POST["strnr"]) && empty($_POST["zpcd"]) && empty($_POST["resid"])) {
                $email = $_POST['emailadress'];                              
                $phone = $_POST['phonenumber'];
                $street = $_POST ['streetname'];
                $strnr = $_POST ['strnr'];
                $zpcd = $_POST['zpcd'];
                $resid = $_POST['resid'];
            }
        }
        if (empty($salutErr) && empty($nameErr) && empty($comErr) && empty($emailErr) && empty($phoneErr) && empty($streetErr) && empty($strnrErr) && empty($zpcdErr) && empty($residErr) && empty($messageErr))
        {$valid = true;}
    }    
?>
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
    <section>
<?php if (!$valid) { ?>
        <form action="contact.php" method="post">
            <div class="invoervelden">
                <label for="salut">Aanhef:</label>
                    <select class="sel" id="salut" name="salut">
                        <option value=""></option> 
                        <option value="man" <?php if ($salut == "man") { echo 'selected="selected"'; } ?>>Dhr.</option>
                        <option value="woman" <?php if ($salut == "woman") { echo 'selected="selected"'; } ?>>Mvr.</option>
                        <option value="different" <?php if ($salut == "different") { echo 'selected="selected"'; } ?>>Anders</option>
                    </select>
                        <span class="error"> <?php echo $salutErr;?></span><br> 
                <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="firstname" placeholder="Typ hier uw naam" value="<?php echo $name;?>">
                    <span class="error"> <?php echo $nameErr;?></span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="emailadress" placeholder="Typ hier uw e-mailadres" value="<?php echo $email;?>" > 
                    <span class="error"> <?php echo $emailErr;?></span><br>
                <label for="phone">Telefoonnummer:</label>
                    <input class="sw" type="text" id="phone" name="phonenumber" placeholder="Typ hier uw telefoonnummer" value="<?php echo $phone;?>">
                    <span class="error"> <?php echo $phoneErr;?></span><br>
                <label for="street">Straatnaam</label>
                    <input class="sw" type="text" id="street" name="streetname" placeholder="Typ hier uw straat" value="<?php echo $street;?>"> 
                    <span class="error"> <?php echo $streetErr;?></span><br>
                <label for="strnr">Huisnummer</label>
                    <input class="sw" type="text" id="strnr" name="strnr" placeholder="Typ hier uw huisnummer" value="<?php echo $strnr;?>">
                    <span class="error"> <?php echo $strnrErr;?></span><br>
                <label for="zpcd">Postcode</label>
                    <input class="sw" type="text" id="zpcd" name="zpcd" placeholder="Typ hier uw postcode als 1234 AB" value="<?php echo $zpcd;?>">
                    <span class="error"> <?php echo $zpcdErr;?></span><br>
                <label for="resid">Woonplaats</label>
                    <input class="sw" type="text" id="resid" name="resid" placeholder="Typ hier uw woonplaats" value="<?php echo $resid;?>">
                    <span class="error"> <?php echo $residErr;?></span><br>
                <br>   
            </div>
            <div>
            Kies uw communicatievoorkeur:<span class="error"> <?php echo $comErr;?></span><br>
                <input type="radio" id="com_email" name="com" value="E-mail" <?php if ($com =="E-mail") echo 'checked = "checked"';?>>
                    <label for="com_email">E-mail</label><br>
                <input type="radio" id="phone" name="com" value="Phone" <?php if ($com =="Phone") echo 'checked = "checked"';?>>
                    <label for="phone">Telefoon</label><br>
                <input type="radio" id="mail" name="com" value="Mail" <?php if ($com =="Mail") echo 'checked = "checked"';?>>
                    <label for="mail">Post</label><br>
                <br>
            </div>
            <div class="invoervelden">    
            Waarover wilt u contact opnemen?<br>
                <textarea class="sw" name="message" rows="4" cols="53" placeholder="Typ hier uw vraag"><?php echo $message;?></textarea>
                <span class="error"> <?php echo $messageErr;?></span><br>
                <br>
                <input class="knop" type="submit" Value="Verstuur">
            </div>    
        </form>
<?php } else { ?>
        <p> Uw reactie is verzonden. Bedankt voor het invullen!</p>
<?php } ?>
    </section>
        <footer>
            <p>&copy; 2023 <a class="auteur" href="//localhost:80/educom-webshop-basis-1699355222/about.html">Nicole Goris</a></p>
        </footer>
    </div>
    </body> 
</html> */

?>
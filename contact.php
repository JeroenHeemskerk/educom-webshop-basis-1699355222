<?php

function showContactHeader()
{ 
    echo '<h1>Contact</h1>' . PHP_EOL;
}

function showContactContent ()
{
    // declareVar
    $salut = $name = $com = $email = $phone = $street = $strnr = $zpcd = $resid = $message = ""; 
    $salutErr = $nameErr = $comErr = $emailErr = $phoneErr = $streetErr = $strnrErr = $zpcdErr = $residErr = $messageErr = ""; 

    $valid = false;

    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        initiateValidation ();
    }
   
    //* else ($_SERVER["REQUEST_METHOD"] == "GET") 
    //{
    //    showForm ();
    //} */
    
    function initiateValidation()
    {
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
        {
            $valid = true;
            showThanksNote ();
        }
        if ((!valid) || ($_SERVER["REQUEST_METHOD"] == "GET"))
        {
            showForm ();
        }
    }    
}

function showForm ()
{
    echo '<form action="contact.php" method="post">
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="salut">Aanhef:</label>
                    <select class="sel" id="salut" name="salut">
                        <option value=""></option>  
                        <option value="man">'; if ($salut == "man") { echo 'selected="selected"'; } echo '>Dhr.</option>
                        <option value="woman"'; if ($salut == "woman") { echo 'selected="selected"'; } echo '>Mvr.</option>
                        <option value="different"'; if ($salut == "different") { echo 'selected="selected"'; } echo '>Anders</option>
                    </select>
                        <span class="error">'; echo $salutErr; echo '</span><br> 
                <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="firstname" placeholder="Typ hier uw naam" value="'; echo $name; echo '">
                    <span class="error">'; echo $nameErr; echo '</span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="emailadress" placeholder="Typ hier uw e-mailadres" value="'; echo $email; echo '" > 
                    <span class="error">'; echo $emailErr; echo '</span><br>
                <label for="phone">Telefoonnummer:</label>
                    <input class="sw" type="text" id="phone" name="phonenumber" placeholder="Typ hier uw telefoonnummer" value="'; echo $phone; echo '">
                    <span class="error">'; echo $phoneErr; echo '</span><br>
                <label for="street">Straatnaam</label>
                    <input class="sw" type="text" id="street" name="streetname" placeholder="Typ hier uw straat" value="'; echo $street; echo '"> 
                    <span class="error">'; echo $streetErr;echo '</span><br>
                <label for="strnr">Huisnummer</label>
                    <input class="sw" type="text" id="strnr" name="strnr" placeholder="Typ hier uw huisnummer" value="'; echo $strnr; echo '">
                    <span class="error">'; echo $strnrErr; echo '</span><br>
                <label for="zpcd">Postcode</label>
                    <input class="sw" type="text" id="zpcd" name="zpcd" placeholder="Typ hier uw postcode als 1234 AB" value="'; echo $zpcd; echo '">
                    <span class="error">'; echo $zpcdErr; echo '</span><br>
                <label for="resid">Woonplaats</label>
                    <input class="sw" type="text" id="resid" name="resid" placeholder="Typ hier uw woonplaats" value="'; echo $resid; echo '">
                    <span class="error">'; echo $residErr; echo '</span><br>
                <br>   
            </div>
            <div>
            Kies uw communicatievoorkeur:<span class="error">'; echo $comErr; echo '</span><br>
                <input type="radio" id="com_email" name="com" value="E-mail"'; if ($com =="E-mail") echo 'checked = "checked"'; echo '>
                    <label for="com_email">E-mail</label><br>
                <input type="radio" id="phone" name="com" value="Phone"'; if ($com =="Phone") echo 'checked = "checked"'; echo '>
                    <label for="phone">Telefoon</label><br>
                <input type="radio" id="mail" name="com" value="Mail"'; if ($com =="Mail") echo 'checked = "checked"'; echo '>
                    <label for="mail">Post</label><br>
                <br>
            </div>
            <div class="invoervelden">    
            Waarover wilt u contact opnemen?<br>
                <textarea class="sw" name="message" rows="4" cols="53" placeholder="Typ hier uw vraag">'; echo $message; echo '</textarea>
                <span class="error">'; echo $messageErr; echo '</span><br>
                <br>
                <input class="knop" type="submit" Value="Verstuur">
            </div>    
        </form>';
}

function showThanksNote () 
{ 
    echo '<p> Uw reactie is verzonden. Bedankt voor het invullen!</p>';
}

?>
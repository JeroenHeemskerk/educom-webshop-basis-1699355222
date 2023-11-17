<?php

function showContactHeader()
{ 
    echo '<h1>Contact</h1>' . PHP_EOL;
}

function showContactForm ($data)
{
    echo '<form action="index.php" method="POST">
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="salut">Aanhef:</label>
                    <select class="sel" id="salut" name="salut">
                        <option value=""></option>  
                        <option value="man"'; if ($data['salut'] == "man") { echo 'selected="selected"'; } echo '>Dhr.</option>
                        <option value="woman"'; if ($data['salut'] == "woman") { echo 'selected="selected"'; } echo '>Mvr.</option>
                        <option value="different"'; if ($data['salut'] == "different") { echo 'selected="selected"'; } echo '>Anders</option>
                    </select>
                        <span class="error">'; echo $data['salutErr']; echo '</span><br> 
                <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="name" placeholder="Typ hier uw naam" value="'; echo $data['name']; echo '">
                    <span class="error">'; echo $data['nameErr']; echo '</span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $data['email']; echo '" > 
                    <span class="error">'; echo $data['emailErr']; echo '</span><br>
                <label for="phone">Telefoonnummer:</label>
                    <input class="sw" type="text" id="phone" name="phone" placeholder="Typ hier uw telefoonnummer" value="'; echo $data['phone']; echo '">
                    <span class="error">'; echo $data['phoneErr']; echo '</span><br>
                <label for="street">Straatnaam</label>
                    <input class="sw" type="text" id="street" name="street" placeholder="Typ hier uw straat" value="'; echo $data['street']; echo '"> 
                    <span class="error">'; echo $data['streetErr'];echo '</span><br>
                <label for="strnr">Huisnummer</label>
                    <input class="sw" type="text" id="strnr" name="strnr" placeholder="Typ hier uw huisnummer" value="'; echo $data['strnr']; echo '">
                    <span class="error">'; echo $data['strnrErr']; echo '</span><br>
                <label for="zpcd">Postcode</label>
                    <input class="sw" type="text" id="zpcd" name="zpcd" placeholder="Typ hier uw postcode als 1234 AB" value="'; echo $data['zpcd']; echo '">
                    <span class="error">'; echo $data['zpcdErr']; echo '</span><br>
                <label for="resid">Woonplaats</label>
                    <input class="sw" type="text" id="resid" name="resid" placeholder="Typ hier uw woonplaats" value="'; echo $data['resid']; echo '">
                    <span class="error">'; echo $data['residErr']; echo '</span><br>
                <br>   
            </div>
            <div>
            Kies uw communicatievoorkeur:<span class="error">'; echo $data['comErr']; echo '</span><br>
                <input type="radio" id="com_email" name="com" value="E-mail"'; if ($data['com'] =="E-mail") echo 'checked = "checked"'; echo '>
                    <label for="com_email">E-mail</label><br>
                <input type="radio" id="phone" name="com" value="Phone"'; if ($data['com'] =="Phone") echo 'checked = "checked"'; echo '>
                    <label for="phone">Telefoon</label><br>
                <input type="radio" id="mail" name="com" value="Mail"'; if ($data['com'] =="Mail") echo 'checked = "checked"'; echo '>
                    <label for="mail">Post</label><br>
                <br>
            </div>
            <div class="invoervelden">    
            Waarover wilt u contact opnemen?<br>
                <textarea class="sw" name="message" rows="4" cols="53" placeholder="Typ hier uw vraag">'; echo $data['message']; echo '</textarea>
                <span class="error">'; echo $data['messageErr']; echo '</span><br>
                <br>
                <input class="knop" type="submit" Value="Verstuur">
                <input type="hidden" name="page" value="contact">       
            </div>    
        </form>';
    return $data;
}

?>
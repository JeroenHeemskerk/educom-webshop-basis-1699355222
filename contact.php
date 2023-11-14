<?php

function showContactHeader()
{ 
    echo '<h1>Contact</h1>' . PHP_EOL;
}

function showContactContent ()
{
    // declareVar
    $variables = array("salut"=>"", "name"=>"", "com"=>"", "email"=>"", "phone"=>"", "street"=>"", "strnr"=>"", "zpcd"=>"", "resid"=>"", "message"=>"", "salutErr"=>"", "nameErr"=>"", "comErr"=>"", "emailErr"=>"", "phoneErr"=>"", "streetErr"=>"", "strnrErr"=>"", "zpcdErr"=>"", "residErr"=>"", "messageErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $variables['salut'] = htmlspecialchars(getPostVar('salut'));            
        $variables['name'] = htmlspecialchars(getPostVar('name'));
        if (!preg_match("/^[a-zA-Z-' ]*$/",$variables['name'])) {
            $variables['nameErr'] = "U kunt hier alleen letters invullen";}        
        $variables['com'] = htmlspecialchars(getPostVar('com'));
        $variables['email'] = htmlspecialchars(getPostVar('email'));
        $variables['phone'] = htmlspecialchars(getPostVar('phone'));
        $variables['street'] = htmlspecialchars(getPostVar('street'));
        $variables['strnr'] = htmlspecialchars(getPostVar('strnr'));
        $variables['zpcd'] = htmlspecialchars(getPostVar('zpcd'));
        $variables['resid'] = htmlspecialchars(getPostVar('resid'));
        $variables['message'] = htmlspecialchars(getPostVar('message'));
        $variables = test_input ($variables);
        $variables = initiateValidation ($variables);
        }
    if ($variables['valid']) {
        showThanksNote($variables);
    }
    else {
        showForm($variables);
    }
}

function test_input($variables) {
    $results = array();
    foreach($variables as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $results[$key] = $value;
    }
    return $results;
}

function initiateValidation($variables)
{
    if (empty($variables["salut"])) {                       
        $variables['salutErr'] = "Aanhef is verplicht";
    } 
    if (empty($variables['name'])) {
        $variables['nameErr'] = "Naam is verplicht";
    } 
    if (empty($variables['message'])) {
        $variables['messageErr'] = "Vraag is verplicht";
    } 
    if (empty($variables['com'])) {
        $variables['comErr'] = "Communicatievoorkeur is verplicht"; 
    } 
    if ($variables['com'] =="E-mail") {
        if (empty($variables['email'])) {
            $variables['emailErr'] = "E-mailadres is verplicht";
        }
        else {
            if (!filter_var($variables['email'], FILTER_VALIDATE_EMAIL)) {
                $variables['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";}
        }        
    }    
    else if ($variables['com'] =="Phone") {                                     
        if (empty($variables['phone'])) {
            $variables['phoneErr'] = "Telefoonnummer is verplicht";
        }
        else {
            if (!preg_match('/^[0-9 -+]+$/', $variables['phone'])) { 
                $variables['phoneErr'] = "Dit lijkt geen goed telefoonnummer";} 
            }        
    }       
    $adress = false;
    $adress = ($variables['com'] =='Mail') || !empty($variables['street']) || !empty($variables['strnr']) || !empty($variables['zpcd']) || !empty($variables['resid']);
    if ($adress) {                             
        if (empty($variables['street'])) {                  
            $variables['streetErr'] = "Staatnaam is verplicht";          
        } 
        if (empty($variables['strnr'])) {
            $variables['strnrErr'] = "Huisnummer is verplicht";
        }
        if (empty($variables['zpcd'])) {
            $variables['zpcdErr'] = "Postcode is verplicht";
        } 
        if (empty($variables['resid'])) {
            $variables['residErr'] = "Woonplaats is verplicht";
        }
    }
    if (empty($variables['saludErr']) && empty($variables['nameErr']) && empty($variables['comErr']) && empty($variables['emailErr']) && empty($variables['phoneErr']) && empty($variables['streetErr']) && empty($variables['strnrErr']) && empty($variables['zpcdErr']) && empty($variables['residErr']) && empty($variables['messageErr']))
    {
        $variables['valid'] = true;
    }
    return $variables;
}    

function showForm ($variables)
{
    echo '<form action="index.php" method="POST">
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="salut">Aanhef:</label>
                    <select class="sel" id="salut" name="salut">
                        <option value=""></option>  
                        <option value="man"'; if ($variables['salut'] == "man") { echo 'selected="selected"'; } echo '>Dhr.</option>
                        <option value="woman"'; if ($variables['salut'] == "woman") { echo 'selected="selected"'; } echo '>Mvr.</option>
                        <option value="different"'; if ($variables['salut'] == "different") { echo 'selected="selected"'; } echo '>Anders</option>
                    </select>
                        <span class="error">'; echo $variables['salutErr']; echo '</span><br> 
                <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="name" placeholder="Typ hier uw naam" value="'; echo $variables['name']; echo '">
                    <span class="error">'; echo $variables['nameErr']; echo '</span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $variables['email']; echo '" > 
                    <span class="error">'; echo $variables['emailErr']; echo '</span><br>
                <label for="phone">Telefoonnummer:</label>
                    <input class="sw" type="text" id="phone" name="phone" placeholder="Typ hier uw telefoonnummer" value="'; echo $variables['phone']; echo '">
                    <span class="error">'; echo $variables['phoneErr']; echo '</span><br>
                <label for="street">Straatnaam</label>
                    <input class="sw" type="text" id="street" name="street" placeholder="Typ hier uw straat" value="'; echo $variables['street']; echo '"> 
                    <span class="error">'; echo $variables['streetErr'];echo '</span><br>
                <label for="strnr">Huisnummer</label>
                    <input class="sw" type="text" id="strnr" name="strnr" placeholder="Typ hier uw huisnummer" value="'; echo $variables['strnr']; echo '">
                    <span class="error">'; echo $variables['strnrErr']; echo '</span><br>
                <label for="zpcd">Postcode</label>
                    <input class="sw" type="text" id="zpcd" name="zpcd" placeholder="Typ hier uw postcode als 1234 AB" value="'; echo $variables['zpcd']; echo '">
                    <span class="error">'; echo $variables['zpcdErr']; echo '</span><br>
                <label for="resid">Woonplaats</label>
                    <input class="sw" type="text" id="resid" name="resid" placeholder="Typ hier uw woonplaats" value="'; echo $variables['resid']; echo '">
                    <span class="error">'; echo $variables['residErr']; echo '</span><br>
                <br>   
            </div>
            <div>
            Kies uw communicatievoorkeur:<span class="error">'; echo $variables['comErr']; echo '</span><br>
                <input type="radio" id="com_email" name="com" value="E-mail"'; if ($variables['com'] =="E-mail") echo 'checked = "checked"'; echo '>
                    <label for="com_email">E-mail</label><br>
                <input type="radio" id="phone" name="com" value="Phone"'; if ($variables['com'] =="Phone") echo 'checked = "checked"'; echo '>
                    <label for="phone">Telefoon</label><br>
                <input type="radio" id="mail" name="com" value="Mail"'; if ($variables['com'] =="Mail") echo 'checked = "checked"'; echo '>
                    <label for="mail">Post</label><br>
                <br>
            </div>
            <div class="invoervelden">    
            Waarover wilt u contact opnemen?<br>
                <textarea class="sw" name="message" rows="4" cols="53" placeholder="Typ hier uw vraag">'; echo $variables['message']; echo '</textarea>
                <span class="error">'; echo $variables['messageErr']; echo '</span><br>
                <br>
                <input class="knop" type="submit" Value="Verstuur">
                <input type="hidden" name="page" value="contact">       
            </div>    
        </form>';
}


function showThanksNote ($variables) 
{ 
    echo '<p> Uw reactie is verzonden. Bedankt voor het invullen!</p>';
    echo '<p> U heeft het volgende ingevuld:' . '<br><br>';
    echo 'Aanhef: ' . $variables['salut'] . '<br>';
    echo 'Naam: ' . $variables['name'] . '<br>';
    echo 'E-mailadres: ' . $variables['email'] . '<br>';
    echo 'Telefoonnummer: ' . $variables['phone'] . '<br>';
    echo 'Straatnaam: ' . $variables['street'] . '<br>';
    echo 'Huisnummer: ' . $variables['strnr'] . '<br>';
    echo 'Postcode: ' . $variables['zpcd'] . '<br>';
    echo 'Woonplaats: ' . $variables['resid'] . '<br>';
    echo 'Communicatievoorkeur: ' . $variables['com'] . '<br>';
    echo 'Vraag: ' . $variables['message'] . '<br></p>';
}

?>
<?php

function showContactHeader()
{ 
    echo '<h1>Contact</h1>' . PHP_EOL;
}

function showContactContent ()  //verplaast validation naar file
{
    // declareVar
    $data = array("salut"=>"", "name"=>"", "com"=>"", "email"=>"", "phone"=>"", "street"=>"", "strnr"=>"", "zpcd"=>"", "resid"=>"", "message"=>"", "salutErr"=>"", "nameErr"=>"", "comErr"=>"", "emailErr"=>"", "phoneErr"=>"", "streetErr"=>"", "strnrErr"=>"", "zpcdErr"=>"", "residErr"=>"", "messageErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $data['salut'] = (getPostVar('salut'));            
        $data['name'] = (getPostVar('name'));
        if (!preg_match("/^[a-zA-Z-' ]*$/",$data['name'])) {
            $data['nameErr'] = "U kunt hier alleen letters invullen";}        
        $data['com'] = (getPostVar('com'));
        $data['email'] = (getPostVar('email'));
        $data['phone'] = (getPostVar('phone'));
        $data['street'] = (getPostVar('street'));
        $data['strnr'] = (getPostVar('strnr'));
        $data['zpcd'] = (getPostVar('zpcd'));
        $data['resid'] = (getPostVar('resid'));
        $data['message'] = (getPostVar('message'));
        $data = test_input ($data);
        $data = validateContact($data);
    }
    if ($data['valid']) {
        showThanksNote($data);
    }
    else {
        showFormContact($data);
    }
}

function test_input($data) {
    $results = array();
    foreach($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $results[$key] = $value;
    }
    return $results;
}

function validateContact($data)
{
    if (empty($data["salut"])) {                       
        $data['salutErr'] = "Aanhef is verplicht";
    } 
    if (empty($data['name'])) {
        $data['nameErr'] = "Naam is verplicht";
    } 
    if (empty($data['message'])) {
        $data['messageErr'] = "Vraag is verplicht";
    } 
    if (empty($data['com'])) {
        $data['comErr'] = "Communicatievoorkeur is verplicht"; 
    } 
    if ($data['com'] =="E-mail") {
        if (empty($data['email'])) {
            $data['emailErr'] = "E-mailadres is verplicht";
        }
        else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";}
        }        
    }    
    else if ($data['com'] =="Phone") {                                     
        if (empty($data['phone'])) {
            $data['phoneErr'] = "Telefoonnummer is verplicht";
        }
        else {
            if (!preg_match('/^[0-9 -+]+$/', $data['phone'])) { 
                $data['phoneErr'] = "Dit lijkt geen goed telefoonnummer";} 
            }        
    }       
    $adress = false;
    $adress = ($data['com'] =='Mail') || !empty($data['street']) || !empty($data['strnr']) || !empty($data['zpcd']) || !empty($data['resid']);
    if ($adress) {                             
        if (empty($data['street'])) {                  
            $data['streetErr'] = "Staatnaam is verplicht";          
        } 
        if (empty($data['strnr'])) {
            $data['strnrErr'] = "Huisnummer is verplicht";
        }
        if (empty($data['zpcd'])) {
            $data['zpcdErr'] = "Postcode is verplicht";
        } 
        if (empty($data['resid'])) {
            $data['residErr'] = "Woonplaats is verplicht";
        }
    }
    if (empty($data['saludErr']) && empty($data['nameErr']) && empty($data['comErr']) && empty($data['emailErr']) && empty($data['phoneErr']) && empty($data['streetErr']) && empty($data['strnrErr']) && empty($data['zpcdErr']) && empty($data['residErr']) && empty($data['messageErr']))
    {
        $data['valid'] = true;
    }
    return $data;
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
}


function showThanksNote ($data) 
{ 
    echo '<p> Uw reactie is verzonden. Bedankt voor het invullen!</p>';
    echo '<p> U heeft het volgende ingevuld:' . '<br><br>';
    echo 'Aanhef: ' . $data['salut'] . '<br>';
    echo 'Naam: ' . $data['name'] . '<br>';
    echo 'E-mailadres: ' . $data['email'] . '<br>';
    echo 'Telefoonnummer: ' . $data['phone'] . '<br>';
    echo 'Straatnaam: ' . $data['street'] . '<br>';
    echo 'Huisnummer: ' . $data['strnr'] . '<br>';
    echo 'Postcode: ' . $data['zpcd'] . '<br>';
    echo 'Woonplaats: ' . $data['resid'] . '<br>';
    echo 'Communicatievoorkeur: ' . $data['com'] . '<br>';
    echo 'Vraag: ' . $data['message'] . '<br></p>';
}

?>
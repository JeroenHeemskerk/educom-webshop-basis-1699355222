<?php

function showRegisterHeader()
{ 
    echo '<h1>Aanmelden</h1>' . PHP_EOL;
}

function showRegisterContent()
{
    // declareVar
    $data = array("name"=>"","email"=>"", "password"=>"", "passwordrep"=>"", "nameErr"=>"","emailErr"=>"", "passwordErr"=>"", "passwordrepErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {         
        $data['name'] = (getPostVar('name'));
        if (!preg_match("/^[a-zA-Z-' ]*$/",$data['name'])) {
        $data['nameErr'] = "U kunt hier alleen letters invullen";}        
        $data['email'] = (getPostVar('email'));
        $data['password'] = (getPostVar('password'));
        $data['passwordrep'] = (getPostVar('passwordrep'));
        $data = test_input ($data);
        $data = validateRegister($data);
        }
    if ($data['valid']) {
        //echo '<input type="hidden" name="page" value="login">'; 
        
        //addInput();
        require_once('index.php');
        getRequestedPage('login');
        
    }
    else {
        showFormRegister($data);
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

function validateRegister($data)
{
    if (empty($data['name'])) {
        $data['nameErr'] = "Naam is verplicht";
    } 
    if (empty($data['email'])) {
        $data['emailErr'] = "E-mailadres is verplicht";
    }
        else {
            //check of de email al in het bestand voorkomt
            //if (/*weet nog niet wat hier moet*/) {
              //  $data['emailErr'] = "Dit e-mailadres bestaat al";}
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";}
        }               
    if (empty($data['password'])) {
        $data['passwordErr'] = "Wachtwoord is verplicht";
    }
    if (empty($data['passwordrep'])) {
        $data['passwordrepErr'] = "Wachtwoord herhalen is verplicht";
    }
    if (($data['password']) != ($data['passwordrep'])) {
                $data['passwordrepErr'] = $data['passwordErr']= "Wachtwoorden komen niet overeen";
    }
    if (empty($data['nameErr']) && empty($data['emailErr']) && empty($data['passwordErr']) && empty($data['passwordrepErr']))
    {
        $data['valid'] = true;
    }
    return $data;
}    

function showFormRegister ($data)
{ //volgens mij moet ik de action aanpassen
    echo '<form action="index.php" method="POST"> 
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="name" placeholder="Typ hier uw naam" value="'; echo $data['name']; echo '">
                    <span class="error">'; echo $data['nameErr']; echo '</span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $data['email']; echo '" > 
                    <span class="error">'; echo $data['emailErr']; echo '</span><br>
                <label for="password">Wachtwoord:</label>
                    <input class="sw" type="password" id="password" name="password" placeholder="Typ hier uw wachtwoord" value="'; echo $data['password']; echo '">
                    <span class="error">'; echo $data['passwordErr']; echo '</span><br>
                <label for="passwordrep">Herhaal wachtwoord</label>
                    <input class="sw" type="password" id="passwordrep" name="passwordrep" placeholder="Herhaal uw wachtwoord" value="'; echo $data['passwordrep']; echo '"> 
                    <span class="error">'; echo $data['passwordrepErr'];echo '</span><br>
                <br>   
            </div>
                <input class="knop" type="submit" Value="Meld aan">
                <input type="hidden" name="page" value="register">
            </div>    
        </form>';
} // Ik moet nog iets inbouwen zodat hij naar de login pagina gaat als het valide en dat hij juist hier blijft als het fout is. 

?>

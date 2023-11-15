<?php

function showRegisterHeader()
{ 
    echo '<h1>Aanmelden</h1>' . PHP_EOL;
}

function showRegisterContent()
{
    // declareVar
    $variables = array("name"=>"","email"=>"", "password"=>"", "passwordrep"=>"", "nameErr"=>"","emailErr"=>"", "passwordErr"=>"", "passwordrepErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {         
        $variables['name'] = (getPostVar('name'));
        if (!preg_match("/^[a-zA-Z-' ]*$/",$variables['name'])) {
        $variables['nameErr'] = "U kunt hier alleen letters invullen";}        
        $variables['email'] = (getPostVar('email'));
        $variables['password'] = (getPostVar('password'));
        $variables['passwordrep'] = (getPostVar('passwordrep'));
        $variables = test_input ($variables);
        $variables = initiateValidationRegister($variables);
        }
    if ($variables['valid']) {
        echo '<input type="hidden" name="page" value="home">'; 
        /* 
        addInput();
        showResponsPage(logIn);
        */
    }
    else {
        showFormRegister($variables);
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

function initiateValidationRegister($variables)
{
    if (empty($variables['name'])) {
        $variables['nameErr'] = "Naam is verplicht";
    } 
    if (empty($variables['email'])) {
        $variables['emailErr'] = "E-mailadres is verplicht";
    }
        else {
            //check of de email al in het bestand voorkomt
            //if (/*weet nog niet wat hier moet*/) {
              //  $variables['emailErr'] = "Dit e-mailadres bestaat al";}
            if (!filter_var($variables['email'], FILTER_VALIDATE_EMAIL)) {
                $variables['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";}
        }               
    if (empty($variables['password'])) {
        $variables['passwordErr'] = "Wachtwoord is verplicht";
    }
    if (empty($variables['passwordrep'])) {
        $variables['passwordrepErr'] = "Wachtwoord herhalen is verplicht";
    }
    if (($variables['password']) != ($variables['passwordrep'])) {
                $variables['passwordrepErr'] = $variables['passwordErr']= "Wachtwoorden komen niet overeen";
    }
    if (empty($variables['nameErr']) && empty($variables['emailErr']) && empty($variables['passwordErr']) && empty($variables['passwordrepErr']))
    {
        $variables['valid'] = true;
    }
    return $variables;
}    

function showFormRegister ($variables)
{ //volgens mij moet ik de action aanpassen
    echo '<form action="index.php" method="POST"> 
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="fname">Naam:</label>
                    <input class="sw" type="text" id="fname" name="name" placeholder="Typ hier uw naam" value="'; echo $variables['name']; echo '">
                    <span class="error">'; echo $variables['nameErr']; echo '</span><br>                
                <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $variables['email']; echo '" > 
                    <span class="error">'; echo $variables['emailErr']; echo '</span><br>
                <label for="password">Wachtwoord:</label>
                    <input class="sw" type="password" id="password" name="password" placeholder="Typ hier uw wachtwoord" value="'; echo $variables['password']; echo '">
                    <span class="error">'; echo $variables['passwordErr']; echo '</span><br>
                <label for="passwordrep">Herhaal wachtwoord</label>
                    <input class="sw" type="password" id="passwordrep" name="passwordrep" placeholder="Herhaal uw wachtwoord" value="'; echo $variables['passwordrep']; echo '"> 
                    <span class="error">'; echo $variables['passwordrepErr'];echo '</span><br>
                <br>   
            </div>
                <input class="knop" type="submit" Value="Meld aan">
                <input type="hidden" name="page" value="register">
            </div>    
        </form>';
} // Ik moet nog iets inbouwen zodat hij naar de login pagina gaat als het valide en dat hij juist hier blijft als het fout is. 

?>

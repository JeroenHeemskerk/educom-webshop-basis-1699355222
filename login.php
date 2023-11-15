<?php

function showLoginHeader()
{ 
    echo '<h1>Inloggen</h1>' . PHP_EOL;
}

function showLoginContent()
{
    // declareVar
    $variables = array("email"=>"", "password"=>"", "nameErr"=>"","emailErr"=>"", "passwordErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {           
        $variables['email'] = (getPostVar('email'));
        $variables['password'] = (getPostVar('password'));
        $variables = test_input ($variables);
        $variables = initiateValidationLogin($variables);
        }
    if ($variables['valid']) {
        echo '<input type="hidden" name="page" value="home">'; 
        /* 
        startSession ();
        show in menu: $name uitloggen
        showResponsPage(home);
        */
    }
    else {
        showFormLogin($variables);
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

function initiateValidationLogin($variables)
{
    if (empty($variables['email'])) {
        $variables['emailErr'] = "E-mailadres is verplicht";
    }
        else {
            //check of de email al in het bestand voorkomt
            //if (/*weet nog niet wat hier moet*/) {
              //  $variables['emailErr'] = "Dit e-mailadres is onbekend";}
            if (!filter_var($variables['email'], FILTER_VALIDATE_EMAIL)) {
                $variables['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";}
        }               
    if (empty($variables['password'])) {
        $variables['passwordErr'] = "Wachtwoord is verplicht";
    }
        //else, checken of het emailadres en wachtwoord matchen.
 
    if (empty($variables['emailErr']) && empty($variables['passwordErr']) /*&& (match)*/)
    {
        $variables['valid'] = true;
    }
    return $variables;
}    

function showFormLogin ($variables)
{ //volgens mij moet ik de action aanpassen
    echo '<form action="index.php" method="POST"> 
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $variables['email']; echo '" > 
                    <span class="error">'; echo $variables['emailErr']; echo '</span><br>
                <label for="password">Wachtwoord:</label>
                    <input class="sw" type="password" id="password" name="password" placeholder="Typ hier uw wachtwoord" value="'; echo $variables['password']; echo '">
                    <span class="error">'; echo $variables['passwordErr']; echo '</span><br>
                <br>   
            </div>
                <input class="knop" type="submit" Value="Inloggen">
                <input type="hidden" name="page" value="login">
            </div>    
        </form>';
} // Ik moet nog iets inbouwen zodat hij naar de home pagina gaat als het valide en dat hij juist hier blijft als het fout is. 

?>

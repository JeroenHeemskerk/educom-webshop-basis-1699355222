<?php

function showLoginHeader()
{ 
    echo '<h1>Inloggen</h1>' . PHP_EOL;
}

function showLoginContent()
{
    // declareVar
    $data = array("email"=>"", "password"=>"", "nameErr"=>"","emailErr"=>"", "passwordErr"=>"", "valid" => false); 
    
    //varifyRequest
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {           
        $data['email'] = (getPostVar('email'));
        $data['password'] = (getPostVar('password'));
        $data = test_input ($data);
        $data = validenLogin($data);
        }
    if ($data['valid']) {
        echo '<input type="hidden" name="page" value="home">'; 
        
        $_SESSION["login"] = true;
        $_SESSION["name"] = $data['name'];  // dit moet ik uit het .txt bestand halen
        getRequestedPage(home); // Ik weet nog niet hoe dit werkt
        
    }
    else {
        showFormLogin($data);
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

function validateLogin($data)
{
    if (empty($data['email'])) {
        $data['emailErr'] = "E-mailadres is verplicht";
    }
        else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailErr'] = "Dit e-mailadres lijkt niet te kloppen";
            }
        }               
    if (empty($data['password'])) {
        $data['passwordErr'] = "Wachtwoord is verplicht";
    }                                                       
        else {
            $user_input = $data["email"];
            $password_input = $data["password"];

            $file = fopen('users.txt', 'r');

            $found = false;
            while(!feof($file)){
                $line = fget($file);
                list($user, $name, $password) = explode ('|', $line);
                if (trim($user) == $user_input) {
                    $found = true;
                    if (trim($password) == $password_input) {
                    
                        $data['valid'] = true;
                        $data['name'] = $name;
                    }
                    else {
                        $data['passwordErr'] = 'Uw wachtwoord klopt niet'; 
                    }
                    break;
                }
            }
            if (!$found) {
                $data['emailErr'] = 'Uw e-mailadres wordt niet herkend';
            }

            fclose('users.txt');
        }
    return $data;
}    

function showFormLogin ($data)
{ //volgens mij moet ik de action aanpassen
    echo '<form action="index.php" method="POST"> 
            <div class="invoervelden">' . PHP_EOL;
    echo '      <label for="email">E-mailadres:</label>
                    <input class="sw" type="text" id="email" name="email" placeholder="Typ hier uw e-mailadres" value="'; echo $data['email']; echo '" > 
                    <span class="error">'; echo $data['emailErr']; echo '</span><br>
                <label for="password">Wachtwoord:</label>
                    <input class="sw" type="password" id="password" name="password" placeholder="Typ hier uw wachtwoord" value="'; echo $data['password']; echo '">
                    <span class="error">'; echo $data['passwordErr']; echo '</span><br>
                <br>   
            </div>
                <input class="knop" type="submit" Value="Inloggen">
                <input type="hidden" name="page" value="login">
            </div>    
        </form>';
} // Ik moet nog iets inbouwen zodat hij naar de home pagina gaat als het valide en dat hij juist hier blijft als het fout is. 

?>

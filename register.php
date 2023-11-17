<?php

function showRegisterHeader()
{ 
    echo '<h1>Aanmelden</h1>' . PHP_EOL;
}

function showRegisterForm ($data)
{ 
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
    return $data;
} 

?>

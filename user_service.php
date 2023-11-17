<?php

function checkUserExist($data)
{
    while(!feof($file)){
        $line = fget($file);
        list($email, $name, $password) = explode ('|', $line);
        if (trim($email) == $email_input) {
            $data['emailErr'] = 'Dit e-mailadres is al in gebruik'; 
            fclose('users.txt');
            }
    }
}

function storeUser($data)
{
    $userfile = fopen("users.txt", "a") or die("Kan niet worden geopend!");
    $arr = array($email_input, $name_input, $password_input);
    $txt = implode("|",$arr); 
    fwrite($userfile, $txt);
    fclose($userfile);
}

function checkUserLogin($data)
{
    $email_input = $data["email"];
            $password_input = $data["password"];

            $file = fopen('users.txt', 'r');

            $found = false;
            while(!feof($file)){
                $line = fget($file);
                list($email, $name, $password) = explode ('|', $line);
                if (trim($email) == $email_input) {
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
?>

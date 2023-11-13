<?php

$page = getRequestedPage ();
showResponsePage($page);

function getRequestedPage () 
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST')
    {
        $requested_page = getPostVar('page', 'home');
    }
    else 
    {
        $requested_page = getUrlVar('page', 'home');
    }
    return $requested_page;
}

function showResponsePage($page)
{
    echo '<!doctype html><html>' . PHP_EOL;                
    showHeadSection();              
    showBodySection($page);
    echo '</html>' . PHP_EOL;
}

function getArrayVar($array, $key, $default=' ')
{
    return isset($array[$key]) ? $array[$key] : $default;
}

function getPostVar($key, $default=' ')
{
    return getArrayVar($_POST, $key, $default);
} 

function getUrlVar($key, $default=' ')
{
    return getArrayVar($_POST, $key, $default);
} 

function showHeadSection ()
{
    echo '<head>' . PHP_EOL;             
    echo '<link rel="stylesheet" href="CSS/stylesheet.css">' . PHP_EOL;              
    echo '</head>' . PHP_EOL;   
}

function showBodySection($page)
{
    echo '  <body>' . PHP_EOL;             
    showHeader($page);           
    showMenu();             
    showContent($page);          
    showFooter();           
    echo '  </body.' . PHP_EOL;            
}

function showHeader($page)
{
    echo '<header>' . PHP_EOL;       
    showHeaderContent($page);            
    echo '</header>' . PHP_EOL;                
}

function showHeaderContent ($page)
{
    switch ($page)
    {
        case 'home':
            require('home.php');
            showHomeHeader();      //Heb ik nu in home.php als functie
            break;
        case 'about':
            require('about.php');
            showAboutHeader();     //functie nog coden ?Waar moet je die coderen?
            break;
        case 'contact':
            require('contact.php');
            showContactHeader();   //functie nog coden ?Waar moet je die coderen?
            break;
        default:
            echo '<p>Pagina niet gevonden</P>';
    }
}

function showMenu()
{  
    echo '<nav>' . PHP_EOL;         
    showNavigateList(); 
    echo '</nav>' . PHP_EOL;
}

function showNavigateList()
{
    include 'menu.php';
}

function showContent($page)
{
    switch ($page)
    {
        case 'home':
            require('home.php');
            showHomeContent();      //functie nog coden  > ik moet even weten wat er precies gebeurt
            break;
        case 'about':
            require('about.php');
            showAboutContent();     //functie nog coden > ik moet even weten wat er precies gebeurt
            break;
        case 'contact':
            require('contact.php');
            showContactContent();   //functie nog coden > ik moet even weten wat er precies gebeurt
            break;
        default:
            echo '<p>Pagina niet gevonden</P>';
    }
}

function showHomeConent()
{
    include 'home.php';
}

function showAboutContent()
{
    include 'about.php';
}

function showContactContent()
{
    include 'contact.php';
}

function showFooter()           
{
    echo '<footer>' . PHP_EOL;                   
    showFooterContent();             
    echo '</footer>' . PHP_EOL;               
}

function showFooterContent()
{
    include 'footer.php';
}

?>
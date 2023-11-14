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
    echo '<!doctype html><html>' . PHP_EOL;                //beginDocument
    showHeadSection();              
    showBodySection($page);
    echo '</html>' . PHP_EOL;                               //endDocument
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
    return getArrayVar($_GET, $key, $default);
} 

function showHeadSection ()
{
    echo '<head>' . PHP_EOL;             
    showCssFile();           
    echo '</head>' . PHP_EOL;   
}

function showCssFile ()
{
    echo '<link rel="stylesheet" href="CSS/stylesheet.css">' . PHP_EOL;
}

function showBodySection($page)
{
    echo '  <body>' . PHP_EOL;         //openBody    
    showHeader($page);           
    showMenu();             
    showContent($page);          
    showFooter();           
    echo '  </body.' . PHP_EOL;         //closeBody        
}

function showHeader($page)
{
    echo '<header>' . PHP_EOL;          //openHeader
    showHeaderContent($page);            
    echo '</header>' . PHP_EOL;         //closeHeader
}

function showHeaderContent ($page)
{
    switch ($page)
    {
        case 'home':
            require_once ('home.php');  
            showHomeHeader(); 
            break;
        case 'about':
            require_once ('about.php');
            showAboutHeader();     
            break;
        case 'contact':
            require_once ('contact.php');
            showContactHeader();
            break;
        default:
            echo '<p>Pagina niet gevonden</P>';
    }
}

function showMenu()
{  
    $variables['menu']= array('home' => 'Startpagina', 'about' => 'Over mij', 'contact' => 'Contact');
    echo '<nav>' . PHP_EOL;         
    showNavigateList($variables); 
    echo '</nav>' . PHP_EOL;
}

function showNavigateList($variables)
{
    echo    '<ul class="menu">';
    foreach ($variables['menu'] as $link => $label) 
    {
        showNavigateItem($link, $label);
    }
    echo    '</ul>';           // Dit moet anders worden in plaats van de losse items de functie showNavigateItem($link, $label);
}

          /*<li><a href="index.php?page=home">Startpagina</a></li>  
            <li><a href="index.php?page=about">Over mij</a></li> 
            <li><a href="index.php?page=contact">Contact</a></li> */

function showNavigateItem($link, $label) 
{
        echo '<li><a href="index.php?page=' . $link . '">' . $label . '</a></li>';
}     
   

function showContent($page)
{
    switch ($page)
    {
        case 'home':
            require_once('home.php');           
            showHomeContent();      
            break;
        case 'about':
            require_once('about.php');
            showAboutContent();     
            break;
        case 'contact':
            require_once('contact.php');
            showContactContent();                   //functies in post request werken nog niet
            break;
        default:
            echo '<p>Pagina niet gevonden</P>';
    }
}

function showFooter()           
{
    echo '<footer>' . PHP_EOL;                   
    echo '<p>&copy; 2023 Nicole Goris</p>';              
    echo '</footer>' . PHP_EOL;               
}

?>
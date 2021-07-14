# How to hide Navbar in any page?
* Create a variable named $noNavbar with an empty string in the page.
 * $noNavbar = '';
* Check if the variable is found or not in the page to include the Navbar template.
 * if (!isset($noNavbar)) {include $tpl . "navbar.php";}
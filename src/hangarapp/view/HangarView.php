<?php

namespace hangarapp\view;

use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;
use hangarapp\view\HangarView as HangarView;
use mf\view\AbstractView as AbstractView ;

class HangarView extends AbstractView 
{
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe parent
    */
    public function __construct( $data )
    {
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    private function renderHeader()
    {
        return "<div class=\"main_container\"><h1>Le Hangar</h1>%%NAV%%";
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter()
    {
        return "</div>
        <script src=\"/lehangar/html/js/jquery-3.2.1.js\"></script>
        <script src=\"/lehangar/html/js/script.js\"></script>";
    }

     /* Méthode renderNav
     *
     * Retourne le fragment HTML du menu de naviguation 
     */
    private function renderNav()
    {
        $route = new Router();
        $link_home =$route->urlFor('home');
        $link_login =$route->urlFor('home');
        $link_register =$route->urlFor('home');

        $link_form =$route->urlFor('home');

        $nav = "<div class=\"nav_bar\">
    <div id=\"btn_panier\">
        <a href=".$link_home.">🛒</a>
    </div>
    <div id=\"btn_connexion\">
        <a href=".$link_form.">👤</a>
    </div></div>";
        return $nav;
    }

    /* Méthode renderHome
     *
     * 
     *  
     */
    
    private function renderCoucou()
    {

       $displayTweets = "coucou";

         return $displayTweets;


    }
  

  
    /* Méthode renderViewTweet 
     * 
     * Réalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    
    private function renderHome()
    {

        $produits = $this->data;
        $displayProduits= "";
        foreach ($produits as $produit)
        {
            $displayProduits .= "<div class=\"list_produit\">
            $produit->Nom
            <div class=\"info_produit\">Produit : $produit->Nom $produit->Description | Prix/Unité : $produit->Tarif_Unitaire | </div>
        </div>\n";

        }

        return $displayProduits;
        
    }






    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     */
    
    public function renderBody($selector)
    {

        /*
         * voire la classe AbstractView
         */

        $header = $this->renderHeader();
        $navBar = "";
        $center = "";
        $footer = $this->renderFooter();
        
        // variable $$ au lieu du case ??    
        switch ($selector) {
            case 'renderHome':
                $navBar = $this->renderNav();
                $center = $this->renderHome();
                break;

            default:
                $center = "Pas de fonction view correspondante";
                break;
        }


$body = <<<EOT
${header}
${center}
${footer}
EOT;

        return str_replace("%%NAV%%", $navBar, $body);
        
    }

}

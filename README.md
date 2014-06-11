##########################################################################
##########################################################################
##                                                                      ##
##                          Projet_cir2:                                ##
##        Plateforme d'automatisation des tests untitaire ( Java )      ##
##                                                                      ##
##########################################################################
##########################################################################

Projet de fin d'année de web et de java

Equipe: Riouallon Vincent | Collignon Rémi

A améliorer:
- quelle page afficher si erreur? page d'index ou de choix de projet
- gerer les notes -> xls.php et gestion-p
- class pour nav

##########################################################################
##########################################################################
##                                                                      ##
##                            PREREQUIS                                 ##
##                                                                      ##
##########################################################################
##########################################################################

Ce site nécéssite l'installation de :

  - Apache2     Version:  2.2.22
  - PHP5        Version:  5.4.4-14
  - MySQL       Version:  5.4.4-14

  - Vous devez autoriser apache a utiliser les fichiers .htaccess

##########################################################################
##########################################################################
##                                                                      ##
##                           INSTALLATION                               ##
##                                                                      ##
##########################################################################
##########################################################################

I)    Décompresser l'archive Projet_cir2.zip

II)   Copier le contenu de WEB/ dans le dossier de /var/www/ de votre 
	    choix.
      par exemple: /var/www/Mon_site_de_test

II)   modifier les droits:
      Certains fichiers ont besoin de droits particulier,
      Soit $USER$ votre nom d'utilisateur:

	   sudo chown $USER$ -R /var/www/Mon_site_de_test

  	   chmod 755 -R /var/www/Mon_site_de_test
  	   
       chown www-data -R  /var/www/Mon_site_de_test/upload
  	   
       chmod 755 -R /var/www/Mon_site_de_test/upload
      
      ( pour etre sûr )

III)  Générer la base de donnée, 
      Vous devez créer une base de donnée avec PHPMyadmin ou avec le shell mysql
      Ensuite, Executer le script SQL nommé Projet_cir2.sql


IV)  Configuration du site:
      Toute la configuration du site se fait dans le fichier
       /var/www/Mon_site_de_test/include/global.conf
       Vous pourrez modifier les paramètre de la base de donnée
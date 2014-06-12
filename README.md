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

  - Débian 7.5  WHEEZY

  - java(JRE)   Version:  1.7         
          (Pour verrifier: $: update-alternatives --config java )

  - java(JDK)   Version:  1.7         
          (Pour verrifier: $: update-alternatives --config javac )

  - Apache2     Version:  2.2.22

  - PHP5        Version:  5.4.4-14

  - MySQL       Version:  5.5.37

  - Vous devez autoriser apache a utiliser les fichiers .htaccess
          ( config apache2: AllowOverride All )

##########################################################################
##########################################################################
##                                                                      ##
##                           INSTALLATION                               ##
##                                                                      ##
##########################################################################
##########################################################################

I)    ** Décompresser l'archive Projet_cir2.zip

II)   ** Copier le contenu de WEB/ dans le dossier de /var/www/ de votre 
          choix.
          par exemple: /var/www/Mon_site_de_test

II)   modifier les droits:
      ** Certains fichiers ont besoin de droits particulier,
          Soit $USER$ votre nom d'utilisateur, dans un terminal tapez:

            sudo chown $USER$ -R /var/www/Mon_site_de_test

            sudo chown www-data -R /var/www/Mon_site_de_test/css/global.css

            chmod 755 -R /var/www/Mon_site_de_test
           
            chown www-data -R  /var/www/Mon_site_de_test/upload
           
            chmod 755 -R /var/www/Mon_site_de_test/upload
          
              ( pour etre sûr )

III)  Générer la base de donnée:
      ** Commencer par verifier que votre base utilise bien l' UTF-8
      ** Vous devez créer une base de donnée avec PHPMyadmin ou avec le shell mysql
      ** Ensuite, Executer le script SQL nommé bdd_6.sql


IV)  Configuration du site:
      ** Toute la configuration du site se fait dans le fichier
       /var/www/Mon_site_de_test/include/global.conf
       Vous pourrez modifier les paramètre de la base de donnée

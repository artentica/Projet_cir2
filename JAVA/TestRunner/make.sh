rm /var/www/Projet_cir2/JAVA/TestRunner/projet/depot/*.class /var/www/Projet_cir2/JAVA/TestRunner/projet/test/*.class
javac /var/www/Projet_cir2/JAVA/TestRunner/projet/depot/Money.java

#compile la classe de test
javac -cp /usr/share/java/junit4.jar:/var/www/Projet_cir2/JAVA/TestRunner/projet/depot:. /var/www/Projet_cir2/JAVA/TestRunner/projet/test/MoneyTest.java

javac -cp /usr/share/java/junit4.jar:/var/www/Projet_cir2/JAVA/TestRunner/projet/test:. /var/www/Projet_cir2/JAVA/TestRunner/Runner.java
java -cp /usr/share/java/junit4.jar:/var/www/Projet_cir2/JAVA/TestRunner/projet/test:/var/www/Projet_cir2/JAVA/TestRunner/projet/depot:. Runner
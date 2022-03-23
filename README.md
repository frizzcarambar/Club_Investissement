# Club_Investissement

Développement d'un site web en php pour un club d'investissement.

Outils nécessairent au fonctionnement :

  - Serveur web
  - Base de données

Tout ça est disponible en local avec MAMP.

Avant le lancement de index.php, vous devez créer une base de données appelée club_investissement dans votre localhost et y import la base de données nommée "club_investissement.sql" présent dans le dossier dump_database.

Ensuite, vous pourrez lancer index.php sur votre serveur et faire fonctionné les sites web.

Il y a plusieurs comptes sur lesquelles on peux se connecter, avec plus ou moins de fonctionnalité disponible.

Compte disponible de base :

  Mail : -admin           -> accès à toutes les fonctionnalités actuellement présentes
         -analyst         -> accès à toutes les fonctionnalités concernant le portefeuille(visualisation du portefeuille/achat/vente)
         -communication   -> accès à la visualisation du portefeuille et pourra ajouter des newsletters à terme
         -membre          -> accès à la visualisation du portefeuille

Tous les compte ont pour password "test".

Les fonctionnalités NewsLetters et Footer ne sont pas encore disponible.

Pour effectuer une recherche, la connexion à un compte est nécessaire.

La plupart des fonctionnalités nécessitent une API. Etant donné que nous utilisons une API gratuite, la clé est régulièrement changé donc si un problème survient lors d'une quelconque recherche lié à l'API, il faut se crée un compte / se connecter au site "https://www.yahoofinanceapi.com/dashboard" pour récupérer un nouvelle clé API et remplacer celle présente dans le fichier src/control/API_Key.txt.

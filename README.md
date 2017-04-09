# GoHangover

## Find your bar, drink as much as you can and go home safely with Uber

GoHangover est un service de qui aidera les personnes à trouver un bar dans les environs du lieu où elle se situe ainsi qu’un uber pour la suite de la soirée. 

Le sujet choisit : « J’ai pas le temps » / 🙀

les 3 API utilisées pour ce projet sont les suivantes : 
- Google Maps
- Yelp 
- Uber 

####Pour chacune de ses API utilisées certaines clés sont nécessaires : 
- Pour google maps seulement une API KEY relié à un compte google à été utilisé. 
- Yelp des identifiant sont nécessaire, le id pour faire fonctionner l’API vous seront envoyée par email. Il faudra les insérer dans le fichiers config qui est dans le dossier scripts 
- UBER : il faut créer son projet sur le site uber, une fois le projet créé et les clés récupérées il suffit de se rendre sur le lien : https://developer.uber.com/docs/trip-experiences/guides/authentication jusqu’à obtenir l’access token. et donc implémenter dans fichier config.php la variable $TOKEN_UBER

####Procédure d'installation : 
1) Installer composer et guzzle 
2) Insérer les configurations nécessaires pour les identifiants API 
3) Tester le service GoHangover sur [localhost]/gohangover/web


Un projet fait par Héma Lambert, Quentin Giraud et Jordan Desjardin

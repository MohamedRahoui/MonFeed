<p align="center"><img width="100" src="https://image.ibb.co/b9LZkk/logo.png"></p>

----

### À propos de MonFeed

1. ##### Technologies :
    1. ###### FrontEnd :
        - Bootsrtap 4 .
        - VueJs 2.
        - Axios.
    2. ###### Backend  
        - Laravel 5.4.
2. ##### Fonctionnalités :
    1. Authentification
        1. Inscription :
            ```php
            $user = new User();
            $user -> save();   
            ```
        2. Validation email : 
            ```php
            $user -> confirmed = true;
            $user -> save();   
            ```
        2. Connexion : 
            ```php
            Auth($user);
            ```
    3. Api Youtube:
        1. Page d'accueil :
            + Affichage aléatoire des vidéos selon le contenu de mes vidéos.
        2. Mon Contenu :
            + Mes videos , affichage et suppression de me vidéos.
            + Ajouter une vidéo , chercher et ajouter des vidéos.
            
    3. Api Facebook:
        1. Page d'accueil :
            + Affichage aléatoire des articles selon le contenu de mes pages.
        2. Facebook :
            + Publier sure le mur facebook.
            + Chercher et ajouter des pages facebook.
            + Afficher et supprimer mes pages facebook.
    4. Api Twitter:  TODO
            



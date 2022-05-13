
# Management TV

Ce projet est un site de gestion d'une chaîne de télévision.\
On peut y ajouter des genres différents d'émission, ajouter des programmes, y lier des diffusions, etc...


## Auteur 

- [@imxale](https://www.github.com/imxale)


## Documentation
Utilisation de la doc de Symfony :\
[Symfony](https://symfony.com/doc/current/index.html)


## Entity
Description des Entity et de leur Controller dans le code.
- User
- Genre
- CategorieCSA
- Emission
- Programme
- Diffusion
## Gestion rôles
Stocké dans la BDD sous format JSON.
- ROLE_USER : rôle attribué au nouveau compte, permet seulement la lecture des données
- ROLE_EDITOR : rôle permettant l'édition des données
- ROLE_ADMIN : rôle permettant la gestion des comptes


### Exemple :
Dans la base de données :
- Admin : ``` ["ROLE_USER","ROLE_EDITOR","ROLE_ADMIN] ```
- Editor : ``` ["ROLE_USER","ROLE_EDITOR"] ```
- User : ``` ["ROLE_USER"] ```

À ajouter dans l'annotation d'un contrôleur, en fonction du rôle voulu.\
Pour limiter le contrôleur au rôle EDITOR :
```
  * @IsGranted("ROLE_EDITOR")
```

Attention à ne pas oublier !
```
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
```
## Serveur Web

Pour démarrer le serveur Web, se situer dans le dossier du projet

```bash
  symfony server:start
```
## Base de données

Le fichier contenant la base de données avec des données est "management_tv.sql".\
Il vous suffit de créer une base de données vierge nommée "management_tv" et ensuite d'y importer le fichier dans votre serveur de BDD.\
Pour utiliser la base de données suivez ceci :
```bash
  //fichier .env
  //Ligne 29-31
  DATABASE_URL="mysql://USER:MDP@HOST:PORT/management_tv?serverVersion=5.7&charset=utf8mb4"
```
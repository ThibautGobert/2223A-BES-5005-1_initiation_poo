### Utilisation de [Composer](https://getcomposer.org/)
- [Composer est un outil de gestion de dépendances en PHP](https://www.youtube.com/watch?v=EBZ1owgiSSQ)
- Pour faire de l'orienté objet, nous allons utiliser composer afin de gérer l'autoload 
de nos classes de manière plus simple (ça nous permettra également d'installer des librairies externes dans nos projets)
- L'utilisation de composer n'est pas obligatoire, 
[nous pourrions créer nous même un autoloader manuellement](https://www.youtube.com/watch?v=BzJltEYYbMo) 
mais ce n'est pas le but de ce projet
- Pour vérifier si composer est disponible sur votre ordinateur, vous pouvez simplement taper `composer` dans une console, 
s'il est installé vous aurez une liste de toutes les commandes disponibles
- Dans notre cas, nous utilisons Laragon, composer est directement disponible dans la console de Laragon
![La console de Laragon](/img/terminal_laragon.png "Cliquer sur terminal")
![Résultat de la commande composer](/img/composer.png "Résultat de la commande composer")
##### Nous n'utiliseront pas toutes les commandes disponibles, en voici quelques-unes que nous utiliseront :
- `composer require une-librairie/dans-notre-projet` : composer require est la commande qui permet d'installer 
une nouvelle librairie dans un projet
- `composer install` : lorsque vous récupérez un projet existant, les librairies externes ne sont généralement pas incluses dans les fichiers,
si vous avez un fichier ``composer.json`` dans le projet mais que vous n'avez pas de dossier `vendor`, vous devez utiliser 
cette commande pour que composer télécharge les fichiers nécessaires
- ``composer dumpautoload`` : cette commande dit à composer de régénérer un fichier d'autoload, 
par exemple si vous avez créé de nouvelles classes et qu'elle ne sont pas reconnues dans votre projet, cette commande sera peut-être la solution

#### Comment utiliser l'autoload de composer ?
- Lorsque vous installez une librairie avec ``composer``, il génère un dossier `vendor` et si votre projet n'en a pas, 
il créera un fichier `composer.json` et `composer.lock`
- Le fichier `composer.json` est le fichier de configuration de votre application, il liste les différentes dépendances du projet
et c'est dans ce fichier que l'on peut spécifier à composer comment charger nos classes
- Après avoir fait un `composer dumpautoload`, composer génère un fichier d'autoload 
qui se trouve dans le dossier vendor, il ne faut pas oublier de l'inclure dans le point d'entrée de notre application
`require './vendor/autoload.php';`

#### Définir le namespace de notre application

> On peut se représenter un namespace comme une structure de dossiers <br>
> Travailler avec un namespace nous permet d'utiliser l'autoload pour charger nos classes et
> les inclures là où on en a besoin de manière plus simple et plus propre qu'avec l'habituel require.

- Créer un dossier qui sera la racine du namespace, le nom n'a pas d'influence sur le fonctionnement, on a choisit app pour ce projet.
- Ajouter une clé autoload au fichier composer.json qui a été créé automatiquement par composer lors de l'installation de var-dumper
- Ajouter la clé psr-4 dans autoload
- En savoir plus sur les normes [PSR](https://www.php-fig.org/psr/)
- Définir le nom du namespace (App dans cet exemple) et son dossier racine

```
"autoload": {
    "psr-4": {
        "App\\" : "app"
    }
}
```
- On peut ensuite organiser nos classes comme on le souhaite dans notre namespace
- Si on a un sous-dossier dans le namespace, le namespace des classes qui seront dedans sera App\NomDuSousDossier
- Quand on voudra utiliser une classe ailleurs que dans son namespace, on utilisera un ``use`` pour l'inclure, ex : `use App\NomDuDossier\MaClasse`
- Par convention, on nomme les classes et les dossiers en commençant par une majuscule

### Installation de [var-dumper](https://symfony.com/doc/current/components/var_dumper.html) :
> Nous avons pris l'habitude d'utiliser la fonction ``dd()`` de la librairie var-dumper dans nos précédents projets,
> nous allons l'installer à l'aide de composer
- Ouvrir une console et se mettre dans le dossier du projet `cd /chemin/du/projet`
- Installer la librairie avec la commande `composer require --dev symfony/var-dumper`
- Inclure dans index.php le fichier d'autoload qui se trouve dans le dossier vendor `require './vendor/autoload.php';`

## OOP, les principes de base
### Qu'est-ce qu'une classe ?
- On peut se représenter une classe est comme la définition des futurs objets qui seront instanciés à partir de celle-ci.
- De manière imagée, une classe pourrait être un moule à partir duquel des futurs cakes (objets) seront cuisinés (instanciés),
avec un moule, on peut créer une multitude de gateau qui auront les mêmes caractéristiques mais qui seront uniques et qui pourront 
avoir leurs spécificités (par exemple ils auront tous une couleur, mais chacun aura la sienne)
- Une classe peut avoir des propriétés ou attributs (comme des variables)
- Une classe peut également avoir des méthodes (comme des fonctions)
- Toutes les classes ont un constructeur, même si celui-ci n'est pas utilisé
- Un constructeur est simplement une fonction qui est appelée lors de l'instanciation (construction) d'un objet 
- On peut passer des paramètres au constructeur afin de définir les valeurs de certains attributs (ou d'autres traitements),
par exemple :
```
public function __construct(string $nom = null)
    {
        $this->nom = $nom;
        $this->arme = new Arme();
    }
```
- Dans une classe, on a accès au mot clé `$this` qui représente l'instance courante de la classe

### Qu'est ce qu'un objet
- Un objet est une instance de classe
- Pour instancier un objet, on utilise le mot clé `new`

```
$chevalier = new Personnage('Arthur');
```
- Dans cet exemple la variable chevalier est une instance de la classe Personnage
- Pour accéder à une propriété ou méthode d'un objet on utilise, en PHP, une 'flèche' `->`
```
$chevalier->nom;
```

### Que veut dire `public`, `protected` et `private` ?
> Ce sont des mots clés qui définissent [la visibilité ou portée](https://www.youtube.com/watch?v=zZ_tVAPfGAA&t) des attributs (propriétés) et des méthodes
- ``public`` veut dire que l'attribut / méthode sera accessible partout, dans la classe, mais aussi à l'extérieur
- ``private`` rend l'attribut / méthode accessible uniquement à l'intérieur de la classe
- ``protected`` est un compromis entre les deux, il rend l'attribut / méthode accessible dans la classe ainsi que dans les classes qui en héritent


### Qu'est-ce que l'héritage ?
- L'héritage permet à une classe d'hériter des attributs / méthodes de la classe parente
- Pour faire hériter une classe, on utilise le mot clé `extends` suivit du nom de la classe parente
- Si les classes ne se trouvent pas dans le même namespace il faut évidemment ajouter un `use` en haut du fichier de la classe

```
use App\Namespace\De\LaClasse\ClasseParente

class MaClasse extends ClasseParente {

}
```

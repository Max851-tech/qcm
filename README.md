Documentation d’installation de QCM-App
1. Prérequis
   Avant de commencer l’installation, assurez-vous d’avoir les logiciels suivants installés sur votre machine :

1.1. Logiciels nécessaires
PHP ≥ 8.1 (Testé avec PHP 8.1.12)

Composer ≥ 2.0 (Testé avec Composer 2.5.0)

MySQL ≥ 8.0 (Testé avec MySQL 8.0.31)

Node.js ≥ 16 (Testé avec Node.js 16.15.0 et npm 8.5.0)

Laravel ≥ 10 (Le projet est basé sur Laravel 10)

Git (Optionnel mais recommandé)

Serveur local (Laragon, XAMPP ou WAMP) (Testé avec Laragon 5.0.0)

2. Installation des dépendances
   2.1. Installer PHP et Composer
   Si PHP et Composer ne sont pas installés, suivez ces étapes :

Installer PHP

Télécharger PHP depuis le site officiel : https://windows.php.net/download

Ajouter PHP au PATH de Windows si nécessaire.

Installer Composer

Télécharger et installer Composer depuis : https://getcomposer.org/download/

Vérifiez l’installation avec :

bash
Copier
Modifier
composer -V
2.2. Installer MySQL
Télécharger et installer MySQL : https://dev.mysql.com/downloads/mysql/

Créez une base de données qcm_app :

sql
Copier
Modifier
CREATE DATABASE qcm_app;
2.3. Installer Node.js et NPM
Télécharger et installer Node.js depuis : https://nodejs.org/

Vérifiez l’installation avec :

bash
Copier
Modifier
node -v
npm -v
2.4. Installer Laragon (ou XAMPP)
Télécharger et installer Laragon : https://laragon.org/download

Démarrer Laragon et vérifier que MySQL et Apache sont actifs.

3. Cloner et configurer l’application
   3.1. Récupérer le projet
   Si Git est installé, utilisez :

bash
Copier
Modifier
git clone https://github.com/utilisateur/qcm-app.git
cd qcm-app
Sinon, téléchargez l’archive ZIP et extrayez-la dans C:\laragon\www\qcm-app.

3.2. Installer les dépendances PHP
Dans le terminal, exécutez :

bash
Copier
Modifier
composer install
3.3. Installer les dépendances JavaScript
bash
Copier
Modifier
npm install
4. Configuration de l’application
   4.1. Configuration des variables d’environnement
   Copiez le fichier .env.example en .env :

bash
Copier
Modifier
cp .env.example .env
Modifiez les paramètres de connexion à la base de données :

makefile
Copier
Modifier
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qcm_app
DB_USERNAME=root
DB_PASSWORD=
Ajoutez aussi les configurations d’email (si nécessaire) :

ini
Copier
Modifier
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="QCM-App"
Générez la clé d’application :

bash
Copier
Modifier
php artisan key:generate
5. Préparation de la base de données
   5.1. Exécuter les migrations
   bash
   Copier
   Modifier
   php artisan migrate --seed
   ⚠️ Si la base est déjà utilisée, faites :

bash
Copier
Modifier
php artisan migrate:refresh --seed
6. Lancer l’application
   6.1. Démarrer le serveur local
   bash
   Copier
   Modifier
   php artisan serve
   L’application sera accessible via : http://127.0.0.1:8000

6.2. Compiler les assets
Si l’application utilise Vue.js ou React :

bash
Copier
Modifier
npm run dev
7. Configuration des tâches de fond (Queue)
   Laravel utilise une file d’attente pour certaines tâches en arrière-plan.
   Lancez la queue avec :

bash
Copier
Modifier
php artisan queue:work
Si aucun message ne s'affiche, assurez-vous que la configuration QUEUE_CONNECTION=database est bien définie.

8. Problèmes courants et solutions
   Problème	Solution
   Erreur SQLSTATE[HY000] [2002] Connection refused	Vérifiez que MySQL est bien démarré.
   Erreur The stream or file "/storage/logs/laravel.log" could not be opened	Exécutez chmod -R 777 storage bootstrap/cache sous Linux.
   L’email de réinitialisation ne fonctionne pas	Vérifiez la configuration SMTP dans .env.
9. Déploiement en production
   Si vous souhaitez mettre l’application en ligne :

Utiliser un hébergement compatible Laravel (OVH, DigitalOcean, etc.)

Configurer un serveur Apache ou Nginx

Exécuter les migrations et générer les assets en mode production :

bash
Copier
Modifier
php artisan migrate --force
npm run build
Configurer un scheduler pour les tâches cron :

bash
Copier
Modifier
* * * * * php /var/www/qcm-app/artisan schedule:run >> /dev/null 2>&1
          🎉 Félicitations ! L’application est maintenant installée et fonctionnelle.

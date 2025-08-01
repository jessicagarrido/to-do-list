
# ✅ ToDo & Co - OpenClassrooms - Projet 8

> **Améliorez un projet existant**  
> Développé dans le cadre de la formation [Développeur d'application PHP/Symfony](https://openclassrooms.com/fr/paths/80-developpeur-dapplication-php-symfony) - OpenClassrooms

---

![Symfony](https://img.shields.io/badge/Symfony-5.4-black?logo=symfony&style=flat)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.4-purple?logo=bootstrap&style=flat)
![PHP](https://img.shields.io/badge/PHP-8.1-blue?logo=php&style=flat)
[![SymfonyInsight](https://insight.symfony.com/projects/8329888e-b887-45b4-874a-2e05e4141477/mini.svg)](https://insight.symfony.com/projects/8329888e-b887-45b4-874a-2e05e4141477)<!-- Remplacer par ton lien réel -->

---

## 🗂️ Description du projet

**ToDo & Co** est une application de gestion de tâches avec système d'authentification utilisateur et gestion des droits d'accès.  
Elle permet aux utilisateurs de créer, modifier, supprimer et marquer comme terminées leurs tâches, tout en distinguant les rôles administrateurs et utilisateurs classiques.

---

## 🛠️ Environnement de développement

- Symfony **7.3**
- Bootstrap **5.3**
- Composer **2.8.10**
- WampServer **3.3.7**
  - Apache **2.4**
  - PHP **8.1**
  - MySQL **9.1**
- PhpMyAdmin **5.2**

---

## 🚀 Installation

1. **Cloner le dépôt GitHub** :
   ```bash
   git clone https://github.com/jessicagarrido/to-do-list.git
   ```

2. **Installer les dépendances avec Composer** :
   ```bash
   composer install
   ```

3. **Configurer l'environnement** :  
   Copier le fichier `.env` en `.env.local` et modifier la ligne suivante :
   ```dotenv
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
   ```
   Exemple :
   ```dotenv
   DATABASE_URL="mysql://root:@127.0.0.1:3306/todolist"
   ```

4. **Créer la base de données** :
   ```bash
   php bin/console doctrine:database:create
   ```

5. **Créer la migration et l'exécuter** :
   ```bash
   php bin/console make:migration
   php bin/console doctrine:migrations:migrate
   ```

6. **Charger les données fictives (fixtures)** :
   ```bash
   php bin/console doctrine:fixtures:load
   ```

   > Tapez "yes" pour confirmer.

---

## 👤 Utilisateurs de démonstration

**Administrateurs :**
- `username_1` / `todo2025`

**Utilisateurs classiques :**
- `test_user` / `todo2025`

---

## 🧪 Tests et couverture

### Base de données de test

1. Exporter la base `todolist` depuis **PhpMyAdmin**.
2. Créer une nouvelle base de données `todolist_test`.
3. Importer le fichier `todolist.sql` dans `todolist_test`.

### Lancer un test spécifique :

```bash
php bin/phpunit tests/Entity/TaskEntityTest.php
php bin/phpunit tests/Controller/TaskControllerTest.php
```

> ⚠️ Attention : ces tests modifient la base de test. Il peut être nécessaire de la réinitialiser.

### Générer le rapport de couverture (XDebug requis) :

```bash
vendor/bin/phpunit --coverage-html reports/
```

---

## ▶️ Lancer le serveur

```bash
symfony server:start
```

---

## 👨‍💻 Auteur

**Jessica Garrido**  
Formation *Développeur d'application PHP/Symfony* - OpenClassrooms  

---

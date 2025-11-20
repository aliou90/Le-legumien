# Le Légumien – Application de Gestion des Légumes

![Logo](backend/storage/app/public/screenshots/screenshot1.png)

**Le Légumien** est une application fullstack Laravel + Vue.js pour gérer et afficher des légumes frais.  
Elle propose un panneau d'administration pour ajouter, modifier et supprimer des légumes, avec gestion des images et des likes côté utilisateur.

---

## Fonctionnalités

### Frontend (Vue.js + Bootstrap)
- Liste des légumes frais avec images.
- Bouton ❤️ J’aime pour chaque légume, incrémenté côté serveur.
- Responsive et agréable sur mobile, tablette et desktop.
- Menu de navigation global.

### Backend (Laravel)
- API RESTful pour CRUD sur les légumes.
- Upload des images lors de l’ajout ou modification.
- Suppression automatique de l’image lors de la suppression d’un légume.
- Gestion des likes (1 like par visiteur, sans compte requis).

### Admin
- Ajouter / Modifier un légume avec formulaire.
- Supprimer un légume avec confirmation.
- Affichage des messages de succès ou d’erreur via alertes Bootstrap.

---

## Installation

### Backend

1. Cloner le repo :
```bash
git clone <url-du-repo>
cd backend
````

2. Installer les dépendances :

```bash
composer install
```

3. Configurer `.env` (base de données, etc.) :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=legumien
DB_USERNAME=root
DB_PASSWORD=
```

4. Migrer la base de données :

```bash
php artisan migrate
```

5. Créer le lien vers le storage public :

```bash
php artisan storage:link
```

6. Lancer le serveur :

```bash
php artisan serve
```

### Frontend

1. Aller dans le dossier frontend :

```bash
cd frontend
```

2. Installer les dépendances :

```bash
npm install
```

3. Lancer le serveur de développement :

```bash
npm run dev
```

L’application sera accessible sur `http://localhost:5173` ou selon la sortie de Vite.

---

## Structure des dossiers

```
backend/
├─ app/Models/Vegetable.php
├─ app/Http/Controllers/Api/VegetableController.php
├─ database/migrations/xxxx_create_vegetables_table.php
├─ storage/app/public/images/           # Les images uploadées
├─ storage/app/public/screenshots/      # Screenshots pour ce README
frontend/
├─ src/pages/Home.vue
├─ src/pages/admin/AdminEdit.vue
├─ src/pages/admin/AdminList.vue
├─ src/components/Menu.vue
```

---

## Captures d’écran

![Home](backend/storage/app/public/screenshots/screenshot1.png)
*Liste des légumes côté utilisateur*

![Admin List](backend/storage/app/public/screenshots/screenshot2.png)
*Tableau d’administration des légumes*

![Admin Edit](backend/storage/app/public/screenshots/screenshot3.png)
*Formulaire d’ajout / modification d’un légume*

---

## Contribuer

1. Fork ce repository.
2. Crée une branche : `git checkout -b feature/ma-fonctionnalite`
3. Commit tes changements : `git commit -m "Ajout de ma fonctionnalité"`
4. Push sur ta branche : `git push origin feature/ma-fonctionnalite`
5. Ouvre une Pull Request.

---

## Licence

MIT © Aliou Mbengue

```



# Flux Menu Control
Library for managing user's menu.

# Requirements
* Laravel >= 6.0
* Flux Role Permission >= 1.0.2

# Installation

* Run the command below at the project root to add the package to the Laravel application:

```php 
    composer require doc88/flux-menu-control
```

* In the *providers* list in the *config/app.php* file add:

```php     
    'providers' => [
        ...
        Doc88\FluxMenuControl\FluxMenuControlServiceProvider::class,
    ]
```

* Run the command below at the root of your project to publish the new provider:

```php 
    php artisan vendor:publish
```

* Run migrations

```php 
    php artisan migrate
```

* In your User Model add the following lines:

```php     
    use Doc88\FluxMenuControl\Traits\MenuMount;

    class User {
        use MenuMount;
    }
```
# Usage

## Doc88\FluxMenuControl\Menu Class
Class used to Create, Remove, Attach and Dettach Menus and Permission.

* **Create a Menu Item**
```php
    // Create a new Menu Item
    Menu::create([
        'module' => 'Label of Menu Item', // required
        'slug' => 'menu-slug', // required
        'icon' => 'menu-item-icon-class' // optional,
        'parent' => 'parent-menu-item-slug' // optional
    ]);

    // Return (array):
    [
        'module'    => 'Label of Menu Item',
        'slug'      => 'menu-slug',
        'icon'      => null,
        'parent_id' => null
    ]
```

* **Remove a Menu Item**
```php
    // Remove a Menu Item
    Menu::remove('menu-slug');

    // Return (bool)
    true or false
```

* **Attach a permission to Menu Item**
```php
    // Attaching list-users permissions to menu-slug menu
    Menu::attachPermission('menu-slug', 'list-users');

    // Return (bool)
    true or false
```

* **Dettach a permission from a Menu Item**
```php
    // Dettaching list-users permissions to menu-slug menu
    Menu::dettachPermission('menu-slug', 'list-users');

    // Return (bool)
    true or false
```

* **Synchronize Permissions to generate the user's menu**
```php
    // Synchronizing 
    Menu::sync($user);

    // Return (array)
    [
        [
            "module" => "Label of Menu Item",
            "slug" => "menu-slug",
            "icon" => null,
        ],
    ],
```

* **Get user's menu**
```php
    // Getting user's menu
    Menu::get($user);

    // Return (array)
    [
        [
            "module" => "Label of Menu Item",
            "slug" => "menu-slug",
            "icon" => null,
        ],
    ],
```

## Using the User Model
It is possible to Get the user's menu using the User class.

* **List User's Menu**
```php
    $user = User::find(1);
    
    // User's Permissions
    $user->getMenu();

    // Return (array):
    [
        [
            "module" => "Label of Menu Item",
            "slug" => "menu-slug",
            "icon" => null,
        ],
    ],
```

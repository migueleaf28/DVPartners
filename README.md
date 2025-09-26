Módulo DVPartners_Blog

📚 Overview
This module provides a content management solution for creating and managing blog posts and their associated comments within the Magento 2 admin panel.

The module has been developed following Magento 2 best practices, fully implementing the Repository Pattern for a clean and maintainable service architecture.

✨ Key Features
Post Management (Full CRUD): Create, read, update, and delete blog posts.

Repository Pattern: CRUD logic is fully implemented through the PostRepositoryInterface and CommentRepositoryInterface interfaces.

Comment Management:

CRUD structure for the Comment entity.

Related Comments Grid: Display of all comments for a specific post within the edit tab for that post.

UI Component Configuration: Use of ui_component for the post grid and the related comments grid.

⚙️ Requirements
Magento Version: 2.4.x or higher.

PHP Version: Compatible with the installed Magento version.

Database Dependencies: The blog_post and blog_comment tables must exist with the foreign key (FOREIGN KEY (post_id) REFERENCES blog_post (post_id)) to ensure referential integrity.

🚀 Installation
Follow these steps to install the module in your development/production environment.

Copy the Module:
Ensure that the DVPartners/Blog module folder is located in the app/code/DVPartners/Blog path.

Enable and Install the Module:
Run the following commands in the root of your Magento installation:

Bash

php bin/magento module:enable DVPartners_Blog
php bin/magento setup:upgrade
Compilación y Despliegue (Production/Staging):
Asegúrate de limpiar la caché y recompilar todas las dependencias:

Bash

php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy -f
php bin/magento cache:flush

📝 Use
Access: Navigate to the administration panel in the main menu, find the option that says Blog, and select it.

Editing Posts:

Create or edit a Post.

Post information is managed in the General tab.

Comment Management:

When editing an existing Post, the Related Comments tab will appear.

This grid shows all comments associated with that specific post_id, using the DataProvider configured for filtering.

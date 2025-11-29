Animal Adoption Website (PHP + MySQL)
====================================

Structure:
- index.php            (redirects to login)
- login.php            (login form)
- register.php         (create user - optional sample)
- logout.php
- index.php             (protected member area)
- about.php
- adopt.php            (list animals)
- animal.php           (animal details)
- contact.php          (contact form - saves to DB)
- admin_messages.php   (admin: view messages)
- includes/db.php      (PDO MySQL connection)
- includes/header.php  (included header + navbar)
- includes/footer.php
- css/style.css
- js/scripts.js
- sql/schema.sql       (create tables + sample data)

Setup:
1. Create a MySQL database (e.g., `adoption`) and a user.
2. Edit `includes/db.php` with your DB credentials.
3. Import `sql/schema.sql` into your database: `mysql -u user -p adoption < sql/schema.sql`
4. Place the project files in your PHP server root (e.g., /var/www/html/animal_adoption_site).
5. Visit `index.php` -> login with sample user:
   - email: admin@example.com
   - password: adminpass

Notes:
- Passwords are hashed using password_hash().
- Keep this project for learning; in production, secure sessions, input validation, CSRF protections needed.

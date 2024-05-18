# Final Project for Backend Devices
## How to run the project:
1. Download the project into your chosen directory. If using XAMPP in Linux, use **"opt/lampp/htdocs"**.
2. In the terminal, navigate to "Application/BackEnd".
3. In the terminal, enter:
``` console
composer install
```
If everything is working correctly, navigating to **"/ukfIG2_ZaverecnaPraca_Beta/Application/BackEnd/public/"** in your browser should result in a **"500 | SERVER ERROR"**.
4. In the terminal, enter:
``` console
php artisan key:generate
```
You should receive an **"UnexpectedValueException"**.
Next, enter into the terminal:
``` console
cp .env.example .env
```
and immediately after:
``` console
php artisan key:generate
```
You should receive **" INFO  Application key set successfully. "**. If you navigate to the browser, you should now be able to access the index.php page of Laravel.\
5. In the terminal, navigate to "Application/FrontEnd".\
6. In the terminal, enter:
``` console
npm install
```
If an error occurs, delete the "package-lock.json" file and run the installation again.\
7. To start the page, enter:
``` console
npm run dev
```
In your browser, navigate to **"localhost:5173"** and you should see the page.
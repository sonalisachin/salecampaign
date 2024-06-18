Summary

# Step 1: Clone the repository
git clone https://github.com/sonalisachin/campaign.git

# Step 2: Navigate to the project directory
cd your-repo

# Step 3: Install dependencies
composer update

# Step 4: Create a copy of the .env file
cp .env.example .env

# Step 5: Generate an application key
php artisan key:generate

# Step 6: Create a new database
# Create a new MySQL database with the name you specified

# Step 7: Configure the .env file
# Edit .env file with your database credentials

# Step 9: Run database migrations
php artisan migrate

# Step 10: Seed the database
php artisan db:seed --class=ProductsTableSeeder

# Step 11: Serve the application
php artisan serve


# Step 12: Run Application On postman


# Step 13: Import Json file into Postman
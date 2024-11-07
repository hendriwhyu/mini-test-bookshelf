# Full Stack Bookshelf Management Application

This is a Laravel-based bookshelf management application where users can view, search, filter, and manage bookshelf records. The application provides a smooth user experience for both web and mobile platforms.

## Features

-   **View and Search Categories & Books**: Users can view and search through the list of catetgories and books using a dynamic table.
-   **Sort and Filter**: Data can be sorted and filtered based on the desired columns.
-   **Add New Category**: A form with validations for adding new Category.
-   **Update Category**: A form with validations for updating existing Category.
-   **Detail Category**: Users can view about Category and their details.
-   **Delete Category**: Users can delete a Category.
-   **Add New Books**: A form with validations for adding new Books.
-   **Update Book**: A form with validations for updating existing Book.
-   **Detail Book**: Users can view about book and their details.
-   **Delete Book**: Users can delete a Book.
-   **Upload Image**: Users can upload an books cover.
-   **Responsive Design**: The application works well on both mobile and desktop platforms.
-   **Seeder for Dummy Data**: Includes a seeder to populate the database with dummy employee records.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/hendriwhyu/mini-test-bookshelf.git
cd <project-folder>
```

### 2. Install dependencies

```bash
composer install
npm install
npm run dev
```

### 3. Set up environment variables

Copy the `.env.example` file to `.env` and adjust your environment variables as necessary (e.g., database credentials).

```bash
cp .env.example .env
```

### 4. Run database migrations and seeders

Run the following command to create the database tables and seed them with dummy data:

```bash
php artisan migrate --seed
```

### 5. Create storage link

Laravel requires a symbolic link from `public/storage` to `storage/app/public` to serve uploaded files. Run the following command to create the link:

```bash
php artisan storage:link
```

### 6. Run the application

```bash
php artisan serve
```

Your application should now be up and running.

## Technologies Used

-   **Laravel**: Backend framework for building the application.
-   **jQuery**: For dynamic interactions.
-   **Bootstrap 5**: For responsive UI design.
-   **SweetAlert2**: For displaying beautiful and customizable alert messages.
-   **DataTables**: For displaying and searching the categories and books.

## Resources

-   [Laravel](https://select2.org/)
-   [DataTables](https://datatables.net/)
-   [SweetAlert2](https://www.daterangepicker.com/)

## Author

-   [Hendri Wahyu Perdana](https://github.com/hendriwhyu)

# Online Library Web Application

## Project Overview

This web application allows users to log into an online library, search for books by title, description, or genre, and borrow or return books. The borrowed books are added to the user's session and can be returned to the bookshelf when no longer needed. The book list is paginated for easy navigation.

## Assumptions

1. **User Authentication**: User login and session management are handled.
2. **Book Borrowing**: Borrowed books are marked in the database and associated with the user's session.
3. **Book Returning**: Books can be returned by removing them from the user's session.
4. **Pagination**: The book list is paginated to improve user experience and performance.

## Technologies Used

- **Frontend**: Vue.js, Vue Router
- **Backend**: Laravel
- **Database**: MySQL
- **Others**: CSS for styling, Axios for API calls

## Project Setup

### Backend (Laravel)

1. **Clone the repository**:

   ```bash
   git clone https://github.com/your-repo/online-library.git
   cd online-library

   ```

2. **Install dependencies**:
   composer install

3. **Setup environment file**:
   cp .env.example .env
   php artisan key:generate

4. **Configure the database in .env file**:
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password

5. **Run migrations**:
   php artisan migrate

6. **Start the server**:
   php artisan serve

### Frontend (Vue.js)

1. **Navigate to the frontend directory**:
   cd frontend

2. **Install dependencies**:
   npm install

3. **Run the development server**:
   npm run dev

## Features

1. **User Login**: Authentication system for users to log in and manage their session.
2. **Two-Way Login**:
   -Normal users are redirected to the home page.
   -Admin users (login with `admin@admin.com` and password `admin1122`) are redirected to the admin panel.
3. **Book Borrowing**: Ability to borrow books, which adds them to the user's session.
4. **Book Returning**: Ability to return borrowed books to the bookshelf.
5. **Pagination**: Paginated book list for better user experience
6. **Admin Functionalities**: Admin users can create, update, and delete books.

## How to Use

1. **Login**: Users must log in to access the library.
   -Normal users are redirected to the home page.
   -Admin users are redirected to the admin panel (use `admin@admin.com` and password `admin1122` for admin access).
2. **Borrow Books**: Click on the "Borrow" button to borrow a book, which adds it to the session.
3. **View Borrowed Books**: Go to the cart to see borrowed books.
4. **Return Books**: Click on the "Return" button to return borrowed books to the bookshelf.
5. **Admin Actions**: Admins can create, update, and delete books from the admin panel.

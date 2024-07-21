<template>
  <div>
    <h1>All Books</h1>
    <a href="/books/create" class="add-book-button">Add Book</a>
    <table class="books-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Genre</th>
          <th>Price $</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.title }}</td>
          <td>{{ book.description }}</td>
          <td>{{ book.genre }}</td>
          <td>{{ book.price }}</td>
          <td>
            <button class="edit-button" @click="openModal(book)">Edit</button>
            <button class="delete-button" @click="openConfirmation(book.id)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal for Update Form -->
    <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
      <div class="modal-content" @click.stop>
        <h2>Update Book</h2>
        <form @submit.prevent="updateBook">
          <div class="form-group">
            <label for="edit-title">Title</label>
            <input
              type="text"
              id="edit-title"
              v-model="editingBook.title"
              placeholder="Enter Book Title"
            />
          </div>
          <div class="form-group">
            <label for="edit-description">Description</label>
            <input
              type="text"
              id="edit-description"
              v-model="editingBook.description"
              placeholder="Enter Book Description"
            />
          </div>
          <div class="form-group">
            <label for="edit-genre">Genre</label>
            <input
              type="text"
              id="edit-genre"
              v-model="editingBook.genre"
              placeholder="Enter Book Genre"
            />
          </div>
          <div class="form-group">
            <label for="edit-price">Price $</label>
            <input
              type="number"
              id="edit-price"
              v-model="editingBook.price"
              placeholder="Enter Book Price"
              step="0.01"
            />
          </div>
          <div class="form-actions">
            <input type="submit" value="Update Book" class="submit-button" />
            <button @click="closeModal" class="cancel-button">Cancel</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div
      v-if="isConfirmationOpen"
      class="confirmation-overlay"
      @click="closeConfirmation"
    >
      <div class="confirmation-content" @click.stop>
        <h3>Are you sure you want to delete this book?</h3>
        <div class="confirmation-actions">
          <button @click="deleteBook(confirmationId)" class="confirm-button">
            Yes
          </button>
          <button @click="closeConfirmation" class="cancel-button">No</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export default {
  name: "ViewAllBooks",
  data() {
    return {
      books: [],
      editingBook: null,
      isModalOpen: false,
      isConfirmationOpen: false,
      confirmationId: null,
    };
  },
  mounted() {
    this.fetchBooks();
  },
  methods: {
    fetchBooks() {
      axios
        .get("http://127.0.0.1:8000/api/books")
        .then(({ data }) => {
          this.books = data;
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to fetch books",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    openConfirmation(id) {
      this.confirmationId = id;
      this.isConfirmationOpen = true;
    },
    closeConfirmation() {
      this.isConfirmationOpen = false;
      this.confirmationId = null;
    },
    deleteBook(id) {
      axios
        .delete(`http://127.0.0.1:8000/api/books/${id}`)
        .then(() => {
          this.books = this.books.filter((book) => book.id !== id);
          this.closeConfirmation();
          Toastify({
            text: "Book deleted successfully",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to delete book",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    openModal(book) {
      this.editingBook = { ...book };
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.editingBook = null;
    },
    updateBook() {
      axios
        .put(
          `http://127.0.0.1:8000/api/books/${this.editingBook.id}`,
          this.editingBook
        )
        .then(({ data }) => {
          const index = this.books.findIndex((book) => book.id === data.id);
          if (index !== -1) {
            this.books[index] = data;
          }
          this.closeModal();
          Toastify({
            text: "Book updated successfully",
            duration: 3000,
            backgroundColor: "#28a745",
            gravity: "top",
            position: "right",
          }).showToast();
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to update book",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    toggleBorrowStatus(book) {
      axios
        .put(`http://127.0.0.1:8000/api/books/${book.id}`, {
          is_borrowed: !book.is_borrowed,
        })
        .then(({ data }) => {
          const index = this.books.findIndex((b) => b.id === data.id);
          if (index !== -1) {
            this.books[index] = data;
          }
          Toastify({
            text: "Borrow status updated successfully",
            duration: 3000,
            backgroundColor: "#28a745",
            gravity: "top",
            position: "right",
          }).showToast();
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to update borrow status",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
  },
};
</script>

<style scoped>
.books-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
}
.books-table th,
.books-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}
.books-table th {
  background-color: #f4f4f4;
  color: #333;
}
.books-table tr:nth-child(even) {
  background-color: #f9f9f9;
}
.books-table tr:hover {
  background-color: #f1f1f1;
}
.edit-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 0.9em;
  cursor: pointer;
  border-radius: 5px;
  margin-right: 8px;
  transition: background-color 0.3s;
}
.edit-button:hover {
  background-color: #0056b3;
}
.delete-button {
  background-color: #dc3545;
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 0.9em;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}
.delete-button:hover {
  background-color: #c82333;
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: linear-gradient(135deg, #f3f3f3, #ffffff);
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 600px;
}
.form-group {
  margin-bottom: 15px;
}
.form-group label {
  display: block;
  margin-bottom: 5px;
}
.form-group input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
.submit-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}
.submit-button:hover {
  background-color: #218838;
}
.cancel-button {
  background-color: #6c757d;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}
.cancel-button:hover {
  background-color: #5a6268;
}
.confirmation-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.confirmation-content {
  background: white;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 400px;
  text-align: center;
}
.confirmation-actions {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 20px;
}
.confirm-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}
.confirm-button:hover {
  background-color: #218838;
}
.confirmation-content h3 {
  margin-bottom: 20px;
}
.add-book-button {
  position: fixed;
  top: 620px;
  right: 25px;
  background-color: orange;
  color: #303030;
  border: 3px solid orange;
  border-radius: 8px;
  padding: 15px 30px;
  font-size: 1.2em;
  text-decoration: none;
  text-align: center;
  box-shadow: 0 0 15px rgba(255, 165, 0, 0.7);
  transition: background-color 0.3s, box-shadow 0.3s;
}
.add-book-button:hover {
  background-color: #e07b00;
  box-shadow: 0 0 25px rgba(255, 165, 0, 0.9);
}
@keyframes blink {
  0% {
    border-color: orange;
  }
  50% {
    border-color: transparent;
  }
  100% {
    border-color: orange;
  }
}
.add-book-button {
  animation: blink 1.5s infinite;
}
</style>

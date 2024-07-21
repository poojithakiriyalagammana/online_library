<template>
  <div>
    <Hero />
    <Slider />
    <!-- Add Slider component here -->
    <h1>Borrow Books</h1>
    <!-- Cart Button -->
    <div>
      <button @click="viewCart" class="view-cart-button">View Cart</button>
    </div>
    <!-- Search Form -->
    <div class="search-form">
      <input
        type="text"
        v-model="searchQuery"
        placeholder="Search by title, description, or genre"
      />
      <button @click="searchBooks">Search</button>
    </div>

    <!-- Books List -->
    <div class="books-container">
      <ul class="books-list">
        <li v-for="book in paginatedBooks" :key="book.id" class="book-item">
          <div class="book-details">
            <!-- Book Image -->
            <img
              :src="book.image || defaultImage"
              alt="Book Cover"
              class="book-image"
            />
            <div class="book-info">
              <h3>{{ book.title }}</h3>
              <p>{{ book.description }}</p>
              <p>Genre: {{ book.genre }}</p>
              <p>Price: ${{ book.price }}</p>
              <p
                :class="{
                  'status-available': !book.is_borrowed,
                  'status-borrowed': book.is_borrowed,
                }"
              >
                {{ book.is_borrowed ? "Borrowed" : "Available" }}
              </p>
              <button
                v-if="!book.is_borrowed"
                @click="borrowBook(book)"
                class="borrow-button"
              >
                Borrow
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>

    <!-- Pagination -->
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <button
        @click="nextPage"
        :disabled="currentPage * booksPerPage >= books.length"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import defaultImage from "@/assets/no_cover_available.png";
import Hero from "@/components/Hero.vue"; // Update the import path if needed
import Slider from "@/components/Slider.vue"; // Import the Slider component

export default {
  name: "HomeView",
  components: {
    Hero,
    Slider, // Register the Slider component
  },
  data() {
    return {
      books: [],
      searchQuery: "",
      defaultImage,
      currentPage: 1,
      booksPerPage: 4,
    };
  },
  computed: {
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.booksPerPage;
      const end = start + this.booksPerPage;
      return this.books.slice(start, end);
    },
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
    searchBooks() {
      axios
        .get("http://127.0.0.1:8000/api/books/search", {
          params: { query: this.searchQuery },
        })
        .then(({ data }) => {
          this.books = data;
          this.currentPage = 1;
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to search books",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    borrowBook(book) {
      axios
        .put(`http://127.0.0.1:8000/api/books/${book.id}`, {
          is_borrowed: true,
        })
        .then(() => {
          book.is_borrowed = true;
          Toastify({
            text: "Book borrowed successfully",
            duration: 3000,
            backgroundColor: "#28a745",
            gravity: "top",
            position: "right",
          }).showToast();
          this.addToCart(book);
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to borrow book",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    addToCart(book) {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      cart.push(book);
      localStorage.setItem("cart", JSON.stringify(cart));
    },
    viewCart() {
      this.$router.push({ name: "Cart" });
    },
    nextPage() {
      if (this.currentPage * this.booksPerPage < this.books.length) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
  },
};
</script>
<style scoped>
.search-form {
  text-align: center;
  margin-bottom: 20px;
}

.search-form input {
  padding: 10px;
  font-size: 1em;
  margin-right: 10px;
}

.search-form button {
  padding: 10px 20px;
  font-size: 1em;
  background-color: #dc3545;
  color: white;
  border: none;
  cursor: pointer;
  transition: transform 0.2s;
}

.search-form button:hover {
  transform: scale(1.1);
}

.books-container {
  display: flex;
  justify-content: center;
  overflow-x: auto;
  padding: 20px 0;
}

.books-list {
  display: flex;
  gap: 20px;
  padding: 0;
  margin: 0;
}

.book-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 300px; /* Adjust size as needed */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  border: 2px solid black;
  border-radius: 10px;
  overflow: hidden;
  background: #fff;
  transition: transform 0.3s, box-shadow 0.3s;
}

.book-item:hover {
  transform: scale(1.01);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
}

.book-details {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.book-image {
  width: 250px; /* Adjust size as needed */
  height: 375px; /* Adjust size as needed */
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

.book-info {
  text-align: center;
}

.borrow-button {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 15px 30px;
  font-size: 1.2em;
  cursor: pointer;
  border-radius: 5px;
  transition: transform 0.2s, background-color 0.3s;
}

.borrow-button:hover {
  transform: scale(1.1);
  background-color: #218838;
}

.status-available {
  color: red;
  font-size: 1.2em;
}

.status-borrowed {
  color: green;
  font-size: 1.2em;
}

.pagination {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}

.pagination button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 15px 30px;
  font-size: 1.2em;
  margin: 0 10px;
  cursor: pointer;
  transition: transform 0.2s;
}

.pagination button:disabled {
  background-color: #f5c6cb;
  cursor: not-allowed;
}

.pagination button:hover:not(:disabled) {
  transform: scale(1.1);
}

.view-cart-button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 15px 30px;
  font-size: 1.2em;
  cursor: pointer;
  transition: transform 0.2s;
}

.view-cart-button:hover {
  transform: scale(1.1);
}
</style>

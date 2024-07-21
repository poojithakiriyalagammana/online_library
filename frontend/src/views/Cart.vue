<template>
  <div class="cart-container">
    <h1>Your Cart</h1>
    <ul class="cart-list">
      <li v-for="book in cartBooks" :key="book.id" class="cart-item">
        <div class="cart-details">
          <!-- Book Image -->
          <img
            :src="book.image || defaultImage"
            alt="Book Cover"
            class="book-image"
          />
          <div class="cart-info">
            <h3>{{ book.title }}</h3>
            <p>{{ book.description }}</p>
            <p>Genre: {{ book.genre }}</p>
            <p class="price">Price: ${{ book.price }}</p>
            <p
              :class="{
                'status-available': !book.is_borrowed,
                'status-borrowed': book.is_borrowed,
              }"
            >
              {{ book.is_borrowed ? "Borrowed" : "Available" }}
            </p>
            <button
              v-if="book.is_borrowed"
              @click="returnBook(book)"
              class="return-button"
            >
              Return
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import defaultImage from "@/assets/no_cover_available.png"; // Update path if necessary

export default {
  name: "Cart",
  data() {
    return {
      cartBooks: [],
      defaultImage, // Default image path
    };
  },
  mounted() {
    this.loadCart();
  },
  methods: {
    loadCart() {
      this.cartBooks = JSON.parse(localStorage.getItem("cart")) || [];
    },
    returnBook(book) {
      axios
        .put(`http://127.0.0.1:8000/api/books/${book.id}`, {
          is_borrowed: false,
        })
        .then(() => {
          this.cartBooks = this.cartBooks.filter((b) => b.id !== book.id);
          localStorage.setItem("cart", JSON.stringify(this.cartBooks));

          Toastify({
            text: "Book returned successfully",
            duration: 3000,
            backgroundColor: "#28a745",
            gravity: "top",
            position: "right",
          }).showToast();
        })
        .catch((err) => {
          console.error("Error returning book:", err);
          Toastify({
            text: "Failed to return book",
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
.cart-container {
  text-align: center;
}

.cart-list {
  display: flex;
  flex-direction: column;
  padding: 0;
  margin: 0;
  align-items: center;
}

.cart-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%; /* Full width to stack vertically */
  max-width: 800px; /* Limit width to maintain layout */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  border: 2px solid black;
  border-radius: 10px;
  overflow: hidden;
  background: #fff;
  transition: transform 0.3s, box-shadow 0.3s;
  margin-bottom: 20px; /* Space between books */
  padding: 10px; /* Space between border and content */
}

.cart-item:hover {
  transform: scale(1.01);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
}

.cart-details {
  display: flex;
  align-items: flex-start;
  width: 100%;
}

.book-image {
  width: 100px; /* Smaller size for book image */
  height: 150px; /* Adjust size as needed */
  object-fit: cover;
  border-radius: 8px;
  margin-right: 15px; /* Space between image and details */
}

.cart-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.cart-info h3 {
  margin: 10px 0;
}

.cart-info p {
  margin: 5px 0;
}

.price {
  font-size: 1.5em;
  color: red;
}

.return-button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  margin-top: 10px; /* Space above button */
  transition: transform 0.2s, background-color 0.3s;
}

.return-button:hover {
  transform: scale(1.1);
  background-color: #c82333;
}

.status-available {
  color: red;
  font-size: 1.2em;
}

.status-borrowed {
  color: green;
  font-size: 1.2em;
}
</style>

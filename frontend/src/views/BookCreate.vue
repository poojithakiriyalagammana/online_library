<template>
  <div class="create-book-container">
    <h1>Create Book</h1>
    <form @submit.prevent="saveData" class="create-book-form">
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          id="title"
          v-model="book.title"
          placeholder="Enter Book Title"
          class="form-input"
        />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input
          type="text"
          id="description"
          v-model="book.description"
          placeholder="Enter Book Description"
          class="form-input"
        />
      </div>
      <div class="form-group">
        <label for="genre">Genre</label>
        <input
          type="text"
          id="genre"
          v-model="book.genre"
          placeholder="Enter Book Genre"
          class="form-input"
        />
      </div>
      <div class="form-group">
        <label for="price">Price $</label>
        <input
          type="number"
          id="price"
          v-model="book.price"
          placeholder="Enter Book Price"
          step="0.01"
          class="form-input"
        />
      </div>
      <div class="form-actions">
        <input type="submit" value="Save New Book" class="submit-button" />
        <router-link to="/books/view-all" class="go-back-button"
          >Go Back</router-link
        >
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export default {
  name: "BookCreate",
  data() {
    return {
      book: {
        title: "",
        description: "",
        genre: "",
        price: "",
      },
    };
  },
  methods: {
    saveData() {
      axios
        .post("http://127.0.0.1:8000/api/books", this.book)
        .then(({ data }) => {
          console.log(data);
          Toastify({
            text: "Book added successfully",
            duration: 3000,
            backgroundColor: "#28a745",
            gravity: "top",
            position: "right",
          }).showToast();
          this.resetForm(); // Reset the form fields
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to save data",
            duration: 3000,
            backgroundColor: "#dc3545",
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
    resetForm() {
      this.book = {
        title: "",
        description: "",
        genre: "",
        price: "",
      };
    },
  },
};
</script>

<style scoped>
.create-book-container {
  text-align: center;
  padding: 20px;
}

.create-book-form {
  max-width: 600px;
  margin: 0 auto;
  background: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.form-group {
  margin-bottom: 15px;
  text-align: left;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.form-actions {
  text-align: center;
  margin-top: 20px;
}

.submit-button {
  background-color: #28a745; /* Green for success */
  color: white;
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

.go-back-button {
  display: inline-block;
  background-color: #dc3545; /* Red for go back */
  color: white;
  text-decoration: none;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  border-radius: 5px;
  margin-left: 10px;
  transition: background-color 0.3s;
}

.go-back-button:hover {
  background-color: #c82333;
}
</style>

<template>
  <div>
    <h1>Books</h1>
    <ul>
      <li v-for="book in books" :key="book.id">
        {{ book.title }} - {{ book.price }}
        <button @click="deleteBook(book.id)">Delete</button>
        <router-link :to="{ name: 'BookEdit', params: { id: book.id } }"
          >Edit</router-link
        >
      </li>
    </ul>
    <router-link to="/books/create">Add New Book</router-link>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      books: [],
    };
  },
  mounted() {
    this.fetchBooks();
  },
  methods: {
    fetchBooks() {
      axios
        .get("http://localhost/api/books")
        .then((response) => {
          this.books = response.data;
        })
        .catch((error) => {
          console.error("There was an error fetching the books:", error);
        });
    },
    deleteBook(id) {
      axios
        .delete(`http://localhost/api/books/${id}`)
        .then(() => {
          this.fetchBooks();
        })
        .catch((error) => {
          console.error("There was an error deleting the book:", error);
        });
    },
  },
};
</script>

<template>
  <div>
    <h1>Add Books</h1>
  </div>
</template>

<script>
import axios from "axios";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

export default {
  data() {
    return {
      borrowedBooks: [], // Initialize with empty array
    };
  },
  methods: {
    fetchBorrowedBooks() {
      axios
        .get("http://127.0.0.1:8000/api/borrowed-books")
        .then((response) => {
          this.borrowedBooks = response.data;
        })
        .catch((error) => {
          console.error("Error fetching borrowed books:", error);
          toastr.error("Error fetching borrowed books.");
        });
    },
    returnBook(id) {
      axios
        .post(`http://127.0.0.1:8000/api/return/${id}`)
        .then(() => {
          toastr.success("Book returned successfully!");
          this.fetchBorrowedBooks(); // Refresh borrowed books list after returning
        })
        .catch((error) => {
          console.error("Error returning book:", error);
          toastr.error("Error returning book.");
        });
    },
  },
  mounted() {
    this.fetchBorrowedBooks(); // Fetch borrowed books when component mounts
  },
};
</script>

<style scoped>
/* Add any additional styling here */
</style>

<template>
  <nav class="navbar">
    <div class="navbar-brand">
      <router-link to="/home2">LibraryLink</router-link>
    </div>
    <ul class="navbar-menu">
      <!-- Conditionally render links based on the current route -->
      <li
        class="navbar-item"
        v-if="
          !isAuthPage &&
          !isBooksCreatePage &&
          !isBooksViewAllPage &&
          !isCartPage &&
          !isHome2Page
        "
      >
        <router-link to="/">Home</router-link>
      </li>
      <li class="navbar-item" v-if="isHome2Page">
        <router-link to="/cart">Cart</router-link>
      </li>
      <li
        class="navbar-item"
        v-if="
          !isAuthPage &&
          !isBooksCreatePage &&
          !isBooksViewAllPage &&
          !isCartPage &&
          !isHome2Page
        "
      >
        <router-link to="/login">Login</router-link>
      </li>
      <li class="navbar-item" v-if="isBooksViewAllPage && !isBooksCreatePage">
        <router-link to="/books/create">Add Book</router-link>
      </li>
      <li class="navbar-item" v-if="isHome2Page">
        <router-link to="/login">Logout</router-link>
      </li>
      <li class="navbar-item" v-if="isCartPage || isBooksViewAllPage">
        <router-link to="/home2">Home</router-link>
      </li>
      <li class="navbar-item" v-if="isCartPage">
        <router-link to="/login">Logout</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
  computed: {
    isAuthPage() {
      return this.$route.path === "/login" || this.$route.path === "/register";
    },
    isBooksCreatePage() {
      return this.$route.path === "/books/create";
    },
    isBooksViewAllPage() {
      return this.$route.path === "/books/view-all";
    },
    isHome2Page() {
      return this.$route.path === "/home2";
    },
    isCartPage() {
      return this.$route.path === "/cart";
    },
  },
};
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #3c3c3c;
}

.navbar-brand {
  font-size: 1.5em;
  color: #fff;
}

.navbar-brand a {
  color: #fff;
  text-decoration: none;
}

.navbar-menu {
  list-style-type: none;
  display: flex;
  gap: 20px;
  margin: 0;
  padding: 0;
}

.navbar-item a {
  color: #fff;
  text-decoration: none;
  padding: 10px 15px;
  border-radius: 5px;
}

.navbar-item a:hover {
  background-color: #555;
}
</style>

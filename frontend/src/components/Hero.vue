<template>
  <div>
    <!-- Hero Section -->
    <section v-if="isHomePage" class="hero">
      <div class="hero-content">
        <h1>Welcome to LibraryLink</h1>
        <p>Your gateway to a world of knowledge and adventure.</p>
        <router-link to="/login" class="btn-primary">Explore Books</router-link>
      </div>
    </section>

    <!-- Home2 Page Content -->
    <section v-if="isHome2Page" class="home2">
      <div class="home2-content">
        <h1>Welcome to LibraryLink</h1>
        <p>
          Your gateway to a world of knowledge and adventure. Dive into a
          diverse collection of books, explore new genres, and find your next
          great read. Whether you're a lifelong learner or just starting your
          reading journey, LibraryLink offers a vast array of titles to inspire,
          inform, and entertain. Start your exploration today and unlock the
          doors to endless possibilities. Welcome to a community where every
          page turns into a new experience.
        </p>
        <!-- Animated down arrows -->
        <div class="arrows">
          <div class="arrow"></div>
          <div class="arrow"></div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "App",
  computed: {
    isHomePage() {
      return this.$route.path === "/";
    },
    isHome2Page() {
      return this.$route.path === "/home2";
    },
  },
};
</script>

<style scoped>
/* Hero Section Styles */
.hero {
  background: url("../assets/header.jpg") no-repeat center center/cover;
  height: 92vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  text-align: center;
  position: relative;
}

.home2 {
  background: url("../assets/Bookskssk.png") no-repeat center center/cover;
  height: 92vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  text-align: center;
  position: relative;
}

.home2::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
}

.hero::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
}

.home2-content {
  position: relative;
  z-index: 1;
}

.hero-content {
  z-index: 1;
}

.hero h1,
.home2 h1 {
  font-size: 3em;
  margin: 0.5em 0;
}

.hero p {
  font-size: 1.5em;
  margin-bottom: 1.5em;
}
.home2 p {
  font-size: 1.3em;
  margin-bottom: 1.5em;
}

.btn-primary {
  background-color: #ff5733;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  font-size: 1em;
  transition: background-color 0.3s;
}

.btn-primary:hover {
  background-color: #e14b2b;
}

.home2 {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  text-align: center;
  position: relative;
}

.arrows {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.arrow {
  width: 20px;
  height: 20px;
  border: 4px solid #ff8000;
  border-width: 4px 4px 0 4px;
  border-radius: 50%;
  transform: rotate(45deg);
  animation: bounce 1s infinite;
}

.arrow:nth-child(2) {
  animation-delay: 0.5s;
}

@keyframes bounce {
  0%,
  100% {
    transform: translateY(0) rotate(45deg);
  }
  50% {
    transform: translateY(-20px) rotate(45deg);
  }
}
</style>

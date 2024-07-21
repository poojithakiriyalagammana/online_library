<template>
  <div>
    <Hero />
    <Slider />
    <!-- Add a bigger link styled as a button under the Slider -->
    <router-link to="/login" class="login-link">Log In</router-link>
  </div>
</template>

<script>
import Hero from "@/components/Hero.vue";
import Slider from "@/components/Slider.vue";

export default {
  name: "HomeView",
  components: {
    Hero,
    Slider,
  },
};
</script>

<style scoped>
.login-link {
  display: block;
  width: 200px;
  padding: 20px;
  background-color: #dc3545;
  color: white;
  text-align: center;
  border-radius: 10px;
  text-decoration: none;
  cursor: pointer;
  transition: transform 0.2s;
  margin: 20px auto;
  font-size: 24px;
}

.login-link:hover {
  transform: scale(1.1);
  background-color: #c82333;
}
</style>

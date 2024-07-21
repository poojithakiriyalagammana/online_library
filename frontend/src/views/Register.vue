<template>
  <div class="card-container">
    <div class="card">
      <div class="card-header">Register Form</div>
      <div class="card-body">
        <form @submit.prevent="saveData">
          <label for="name">First Name</label>
          <input
            type="text"
            v-model="student.name"
            name="name"
            id="name"
            class="form-control"
          />

          <label for="email">Email</label>
          <input
            type="email"
            v-model="student.email"
            name="email"
            id="email"
            class="form-control"
          />

          <label for="password">Password</label>
          <input
            type="password"
            v-model="student.password"
            name="password"
            id="password"
            class="form-control"
          />

          <input type="submit" value="Register" class="btn btn-success" />
        </form>
        <div class="signup-link">
          <a href="/login">Have an Account?&nbsp;&nbsp;&nbsp;Login</a><br />
        </div>
        <div class="home">
          <a href="/">&lt;&lt; Home</a>
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
  name: "Register",
  data() {
    return {
      student: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    saveData() {
      axios
        .post("http://127.0.0.1:8000/api/register", this.student)
        .then(({ data }) => {
          console.log(data);
          Toastify({
            text: "Registered successfully",
            duration: 3000,
            backgroundColor: "#28a745", // Green color
            gravity: "top",
            position: "right",
          }).showToast();
          // Redirect to home page
          this.$router.push({ name: "home" }); // Ensure 'home' is defined in your routes
        })
        .catch((err) => {
          console.error(err);
          Toastify({
            text: "Failed to save data",
            duration: 3000,
            backgroundColor: "#dc3545", // Red color
            gravity: "top",
            position: "right",
          }).showToast();
        });
    },
  },
};
</script>

<style scoped>
.card-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: url("../assets/Lovepik_com-400081044-the-mystery-of-the-book.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}
.card {
  background: rgba(0, 0, 0, 0.7);
  padding: 30px 50px 30px 30px;
  border-radius: 8px;
  color: #fff;
  width: 350px;
  margin: 0 auto;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  position: relative;
}

.card-header {
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
  color: #f8f9fa;
}

.card-body {
  display: flex;
  flex-direction: column;
}

.card-body label {
  margin-bottom: 5px;
  font-size: 16px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  margin-bottom: 15px;
  font-size: 16px;
}

.btn-success {
  width: 106%;
  padding: 10px;
  background-color: #28a745;
  border: none;
  border-radius: 4px;
  color: #fff;
  font-size: 16px;
}

.btn-success:hover {
  background-color: #218838;
}
.signup-link {
  text-align: center;
  margin-top: 10px;
}

.signup-link a {
  color: #ffffff;
  text-decoration: none;
  padding-left: 20px;
}

.signup-link a:hover {
  text-decoration: underline;
  color: #85bdf8;
}
.home {
  padding-top: 15px;
  font-size: 12px;
}
.home a {
  color: #ffffff;
  text-decoration: none;
}
.home a:hover {
  text-decoration: underline;
  color: #85bdf8;
}
.home a {
  display: inline-block;
  color: #fff;
  text-decoration: none;
  font-size: 1.2em;
  transition: transform 0.3s;
}

.home a {
  display: inline-block;
  color: #fff;
  text-decoration: none;
  font-size: 1.2em;
  transition: transform 0.3s;
  animation: wave 1s infinite;
}

@keyframes wave {
  0%,
  100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-4px);
  }
}
</style>

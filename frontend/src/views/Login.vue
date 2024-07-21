<template>
  <div class="login-container">
    <div class="login-card">
      <div class="card-header">LOGIN</div>
      <div class="card-body">
        <form @submit.prevent="login">
          <div class="form-group">
            <label for="email">Username or email:</label>
            <input
              type="email"
              v-model="user.email"
              name="email"
              id="email"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input
              type="password"
              v-model="user.password"
              name="password"
              id="password"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <input type="submit" value="LOGIN" class="btn btn-primary" />
          </div>
        </form>
        <div class="signup-link">
          <a href="/register"
            >Don't have an account?&nbsp;&nbsp;&nbsp;Register</a
          ><br />
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
import { useRouter } from "vue-router";

export default {
  name: "Login",
  setup() {
    const router = useRouter();

    const user = {
      email: "",
      password: "",
    };

    const login = () => {
      // Check for specific credentials
      if (user.email === "admin@admin.com" && user.password === "admin1122") {
        Toastify({
          text: "Logged in successfully",
          duration: 3000,
          backgroundColor: "#28a745", // Green color
          gravity: "top",
          position: "right",
        }).showToast();
        router.push({ path: "/books/view-all" });
      } else {
        // Make an API call to validate credentials
        axios
          .post("http://127.0.0.1:8000/api/login", user)
          .then(({ data }) => {
            console.log(data);
            Toastify({
              text: "Logged in successfully",
              duration: 3000,
              backgroundColor: "#28a745", // Green color
              gravity: "top",
              position: "right",
            }).showToast();
            router.push({ path: "/home" }); // Redirect to home page for other users
          })
          .catch((err) => {
            console.error(err);
            Toastify({
              text: "Failed to log in",
              duration: 3000,
              backgroundColor: "#dc3545", // Red color
              gravity: "top",
              position: "right",
            }).showToast();
          });
      }
    };

    return {
      user,
      login,
    };
  },
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Adjusted to cover full viewport height */
  background-image: url("../assets/Lovepik_com-400081044-the-mystery-of-the-book.png");
  background-size: cover;
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Prevent tiling */
  position: relative; /* Ensure the pseudo-element is positioned correctly */
}

.login-card {
  background: rgba(0, 0, 0, 0.5);
  padding: 30px 50px 30px 30px;
  border-radius: 8px;
  color: #fff;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-header {
  text-align: center;
  padding-left: 15px;
  font-size: 32px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
}

.btn-primary {
  width: 107%;
  padding: 10px;
  background-color: #007bff;
  border: none;
  border-radius: 4px;
  color: #fff;
  font-size: 16px;
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

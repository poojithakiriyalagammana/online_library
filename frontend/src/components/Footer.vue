<template>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h4>Contact Us</h4>
        <p>Email: contact@librarylink.com</p>
        <p>Phone: +123 456 7890</p>
      </div>
      <div class="footer-section">
        <h4>Quick Links</h4>
        <ul>
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/about">About Us</router-link></li>
          <li><router-link to="/contact">Contact Us</router-link></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Follow Us</h4>
        <div class="social-media">
          <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 LibraryLink. All Rights Reserved.</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style scoped>
.footer {
  background-color: #3c3c3c;
  color: #fff;
  padding: 20px 0;
}

.footer-container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.footer-section {
  flex: 1;
  margin: 10px;
}

.footer-section h4 {
  margin-bottom: 15px;
}

.footer-section p,
.footer-section ul,
.footer-section li {
  margin: 0;
  padding: 0;
  list-style: none;
}

.footer-section ul {
  padding: 0;
}

.footer-section li {
  margin-bottom: 10px;
}

.footer-section a {
  color: #fff;
  text-decoration: none;
}

.footer-section a:hover {
  text-decoration: underline;
}

.social-media {
  display: flex;
  gap: 10px;
}

.social-media a {
  color: #fff;
  font-size: 1.5em;
  text-decoration: none;
}

.social-media a:hover {
  color: #ddd;
}

.footer-bottom {
  text-align: center;
  padding: 10px 0;
  border-top: 1px solid #555;
}
</style>

<template>
  <div class="slider">
    <div
      class="slides"
      :style="{
        transform: `translateX(-${slideIndex * (100 / totalSlides)}%)`,
      }"
    >
      <div
        v-for="(image, index) in loopedImages"
        :key="index"
        class="slide"
        :class="{ center: index === centerIndex }"
      >
        <img :src="image" alt="Flower" />
      </div>
    </div>
    <div class="navigation">
      <button @click="prevSlide">&#10094;</button>
      <button @click="nextSlide">&#10095;</button>
    </div>
    <div class="dots">
      <span
        v-for="(image, index) in images"
        :key="index"
        :class="{ active: index === slideIndex % images.length }"
        @click="setSlide(index)"
      ></span>
    </div>
  </div>
</template>

<script>
import book1 from "../assets/book1.webp";
import book2 from "../assets/book2.jpg";
import book3 from "../assets/book3.jpg";
import book4 from "../assets/book4.webp";
import book5 from "../assets/book5.jpg";
import book6 from "../assets/book6.jpg";
import book7 from "../assets/book7.webp";

export default {
  name: "Slider",
  data() {
    return {
      images: [book1, book2, book3, book4, book5, book6, book7],
      slideIndex: 0,
      interval: null,
    };
  },
  computed: {
    loopedImages() {
      return [...this.images, ...this.images];
    },
    totalSlides() {
      return this.loopedImages.length;
    },
    centerIndex() {
      const totalSlides = this.totalSlides;
      return (this.slideIndex + Math.floor(totalSlides / 2)) % totalSlides;
    },
  },
  mounted() {
    this.startSlider();
  },
  beforeDestroy() {
    clearInterval(this.interval);
  },
  methods: {
    startSlider() {
      this.interval = setInterval(() => {
        this.nextSlide();
      }, 3000);
    },
    nextSlide() {
      this.slideIndex = (this.slideIndex + 1) % this.totalSlides;
      this.checkReset();
    },
    prevSlide() {
      this.slideIndex =
        (this.slideIndex - 1 + this.totalSlides) % this.totalSlides;
      this.checkReset();
    },
    setSlide(index) {
      this.slideIndex = index;
      this.checkReset();
    },
    checkReset() {
      if (this.slideIndex === this.images.length) {
        setTimeout(() => {
          this.slideIndex = 0;
          this.resetTransition();
        }, 500);
      }
      if (this.slideIndex === this.totalSlides - 1) {
        setTimeout(() => {
          this.slideIndex = this.images.length - 1;
          this.resetTransition();
        }, 500);
      }
    },
    resetTransition() {
      const slides = this.$el.querySelector(".slides");
      slides.style.transition = "none";
      slides.style.transform = `translateX(-${
        this.slideIndex * (100 / this.totalSlides)
      }%)`;
      setTimeout(() => {
        slides.style.transition = "transform 0.5s ease-in-out";
      }, 50);
    },
  },
};
</script>

<style scoped>
.slider {
  position: relative;
  width: 500%;
  max-width: 1200px;
  margin: auto;
  overflow: hidden;
  padding: 35px 0;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.slides {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.slide {
  flex: 0 0 auto;
  width: 20%;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
  padding: 0 10px;
  box-sizing: border-box;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.slide img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 10px;
}

.slide.center {
  transform: scale(1.5);
  z-index: 1;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.navigation {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
}

.navigation button {
  background-color: rgba(0, 0, 0, 0.5);
  border: none;
  color: white;
  font-size: 18px;
  cursor: pointer;
  padding: 10px;
  transition: background-color 0.3s;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navigation button:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

.dots {
  text-align: center;
  position: absolute;
  bottom: 10px;
  width: 100%;
}

.dots span {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 0 5px;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.3s;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dots .active {
  background-color: rgba(0, 0, 0, 0.8);
}
</style>

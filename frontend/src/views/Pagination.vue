<template>
  <div>
    <button @click="changePage(page - 1)" :disabled="page <= 1">
      Previous
    </button>
    <span>Page {{ page }} of {{ lastPage }}</span>
    <button @click="changePage(page + 1)" :disabled="page >= lastPage">
      Next
    </button>
  </div>
</template>

<script>
export default {
  props: {
    pagination: {
      type: Object,
      required: true,
    },
  },
  computed: {
    page() {
      return this.pagination.current_page;
    },
    lastPage() {
      return this.pagination.last_page;
    },
  },
  methods: {
    changePage(newPage) {
      if (newPage >= 1 && newPage <= this.lastPage) {
        this.$emit("change-page", newPage);
      }
    },
  },
};
</script>

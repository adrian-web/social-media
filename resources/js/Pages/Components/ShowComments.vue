<template>
  <div class="mt-3" v-if="commentsShow">
    <p class="text-lg">Comments</p>
    <div class="my-3" v-for="(comment, index) in comments" :key="comment.id">
      <div class="flex items-center text-xs">
        <img
          class="h-6 w-6 rounded-full object-cover"
          :src="comment.owner.profile_photo_url"
          :alt="comment.owner.name"
        />
        <span class="mx-1">posted by</span>
        <inertia-link class="hover:underline" :href="comment.owner.path">
          {{ comment.owner.name }}
        </inertia-link>
        <span class="ml-1" v-text="ago(comment)"></span>
      </div>
      <p class="mt-3">
        {{ comment.body }}
      </p>
      <hr class="my-3" v-if="index != comments.length - 1" />
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        comments: "",
      };
    },

    created() {
      this.fetch();
    },

    mounted() {
      this.$root.$on("created-comment", () => {
        this.fetch();
      });
    },

    methods: {
      fetch() {
        axios.get(this.url()).then(this.refresh);
      },
      url() {
        return `${location.pathname}/comments`;
      },
      refresh({ data }) {
        this.comments = data;
      },
      ago(comment) {
        return moment(comment.created_at).fromNow();
      },
    },

    computed: {
      commentsShow() {
        return this.comments.length > 0;
      },
    },
  };
</script>

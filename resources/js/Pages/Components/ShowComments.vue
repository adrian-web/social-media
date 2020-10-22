<template>
  <div class="mt-3" v-if="showComments">
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
        <button type="button" class="ml-auto" @click="deletingComment(comment)">
          Delete
        </button>
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
    props: ["post"],

    data() {
      return {
        comments: "",
        deleteCommentForm: this.$inertia.form(),
      };
    },

    created() {
      this.fetchComments();
    },

    mounted() {
      this.$root.$on("created-comment", () => {
        this.fetchComments();
      });
    },

    methods: {
      fetchComments() {
        axios.get(route("comments.index", this.post)).then(({ data }) => {
          this.comments = data;
        });
      },
      ago(comment) {
        return moment(comment.created_at).fromNow();
      },
      deletingComment(comment) {
        this.deleteCommentForm.delete(
          route("comments.destroy", { post: this.post, comment: comment }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.fetchComments();
            },
          }
        );
      },
    },

    computed: {
      showComments() {
        return this.comments.length > 0;
      },
    },
  };
</script>

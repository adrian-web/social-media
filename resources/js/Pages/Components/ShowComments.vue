<template>
  <div class="mt-3" v-if="showComments">
    <p class="text-lg">Comments</p>
    <div class="my-3" v-for="(comment, index) in comments" :key="comment.id">
      <show-comment :comment="comment" />
      <hr class="my-3" v-if="index != comments.length - 1" />
    </div>
  </div>
</template>

<script>
  import ShowComment from "./ShowComment";

  export default {
    components: {
      ShowComment,
    },

    props: ["post", "comments"],

    computed: {
      showComments() {
        return this.comments.length > 0;
      },
    },
  };
</script>

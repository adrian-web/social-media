<template>
  <div class="my-3" v-if="showComments">
    <show-comment
      v-for="(comment, index) in comments.data"
      :comment="comment"
      :index="index"
      :key="comment.id"
    />
    <paginator :collection="comments" :show="showPaginator" class="mt-2" />
  </div>
</template>

<script>
  import ShowComment from "./ShowComment";
  import Paginator from "./../../Components/Paginator";

  export default {
    components: {
      ShowComment,
      Paginator,
    },

    props: ["post", "comments"],

    computed: {
      showComments() {
        return this.post.comments_count > 0;
      },
      showPaginator() {
        return (
          this.comments.links.prev != null || this.comments.links.next != null
        );
      },
    },
  };
</script>

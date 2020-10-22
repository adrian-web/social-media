<template>
  <div class="mt-3" v-if="showComments">
    <p class="text-lg">Comments</p>
    <div
      class="my-3"
      v-for="(comment, index) in comments.data"
      :key="comment.id"
    >
      <show-comment :comment="comment" />
      <hr class="my-3" v-if="index != comments.data.length - 1" />
    </div>
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
          this.comments.prev_page_url != null ||
          this.comments.next_page_url != null
        );
      },
    },
  };
</script>

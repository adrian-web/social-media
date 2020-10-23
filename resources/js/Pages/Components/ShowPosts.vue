<template>
  <div>
    <div
      class="my-2 p-3 shadow-md rounded-md"
      v-for="post in posts.data"
      :key="post.id"
    >
      <div class="flex flex-col">
        <div class="font-medium text-lg">
          <inertia-link class="hover:underline" :href="post.path">
            {{ post.title }}
          </inertia-link>
        </div>
        <div class="mt-1 text-xs">
          <span>created by</span>
          <inertia-link class="hover:underline" :href="post.creator.path">
            {{ post.creator.name }}
          </inertia-link>
        </div>
      </div>

      <div class="mt-3">
        {{ post.body }}
      </div>
      <div class="mt-1 flex text-xs">
        <p class="ml-auto" v-text="commentsCount(post.comments_count)"></p>
      </div>
    </div>
    <paginator :collection="posts" :show="showPaginator" class="mt-2" />
  </div>
</template>

<script>
  import Paginator from "./../../Components/Paginator";

  export default {
    components: {
      Paginator,
    },

    props: ["posts"],

    methods: {
      commentsCount(count) {
        if (count == 1) {
          return count + " comment";
        } else {
          return count + " comments";
        }
      },
    },

    computed: {
      showPaginator() {
        return this.posts.links.prev != null || this.posts.links.next != null;
      },
    },
  };
</script>

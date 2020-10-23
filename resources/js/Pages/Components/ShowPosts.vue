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

    computed: {
      showPaginator() {
        return (
          this.posts.prev_page_url != null || this.posts.next_page_url != null
        );
      },
    },
  };
</script>

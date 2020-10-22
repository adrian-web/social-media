<template>
  <article>
    <div class="flex">
      <div class="flex flex-col">
        <h4 class="font-medium text-lg">
          {{ post.title }}
        </h4>
        <h6 class="mt-1 text-xs">
          <span>created by</span>
          <inertia-link class="hover:underline" :href="post.creator.path">
            {{ post.creator.name }}
          </inertia-link>
        </h6>
      </div>
      <div class="contents">
        <button type="button" class="ml-auto" @click="deletingPost()">
          Delete
        </button>
      </div>
    </div>

    <h5 class="mt-3">
      {{ post.body }}
    </h5>
  </article>
</template>

<script>
  export default {
    props: ["post"],

    data() {
      return {
        deletePostForm: this.$inertia.form(),
      };
    },

    methods: {
      deletingPost() {
        this.deletePostForm.delete(route("posts.destroy", this.post));
      },
    },
  };
</script>

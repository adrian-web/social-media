<template>
  <div>
    <article v-for="(post, index) in posts" :key="post.id">
      <div class="flex flex-col">
        <h4 class="font-medium text-lg">
          <inertia-link class="hover:underline" :href="post.path">
            {{ post.title }}
          </inertia-link>
        </h4>
        <h6 class="mt-1 text-xs">
          <span>created by</span>
          <inertia-link class="hover:underline" :href="post.creator.path">
            {{ post.creator.name }}
          </inertia-link>
        </h6>
      </div>

      <h5 class="mt-3">
        {{ post.body }}
      </h5>

      <hr class="my-3" v-if="index != posts.length - 1" />
    </article>
  </div>
</template>

<script>
  export default {
    props: ["posts"],
  };
</script>

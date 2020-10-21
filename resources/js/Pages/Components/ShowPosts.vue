<template>
  <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
    <article v-for="(post, index) in posts" :key="post.id">
      <div class="flex flex-col">
        <h4 class="font-medium text-lg">
          <a href="#">
            {{ post.title }}
          </a>
        </h4>
        <h6 class="mt-1 text-xs">
          <span>created by</span>
          <a href="#">
            {{ post.creator.name }}
          </a>
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

<template>
  <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
    <article>
      <div class="flex flex-col">
        <h4 class="font-medium text-lg">
          {{ post.title }}
        </h4>
        <h6 class="mt-1 text-xs">
          <span>created by</span>
          <inertia-link :href="post.creator.path">
            {{ post.creator.name }}
          </inertia-link>
        </h6>
      </div>

      <h5 class="mt-3">
        {{ post.body }}
      </h5>
    </article>
  </div>
</template>

<script>
  export default {
    props: ["post"],
  };
</script>

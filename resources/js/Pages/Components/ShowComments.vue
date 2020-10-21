<template>
  <div class="mt-3">
    <p class="text-lg">Comments</p>
    <div class="my-3" v-for="(comment, index) in comments" :key="comment.id">
      <div class="flex items-center text-xs">
        <img
          class="h-6 w-6 rounded-full object-cover"
          :src="comment.owner.profile_photo_url"
          :alt="comment.owner.name"
        />
        <span class="mx-1">owned by</span>
        <inertia-link class="hover:underline" :href="comment.owner.path">
          {{ comment.owner.name }}
        </inertia-link>
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
    props: ["comments"],
  };
</script>

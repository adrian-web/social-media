<template>
  <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
    <p>This is {{ activity.name }}'s profile page.</p>
  </div>
</template>

<script>
  export default {
    props: ["activity"],
  };
</script>

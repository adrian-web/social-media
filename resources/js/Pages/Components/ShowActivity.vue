<template>
  <div>
    <p>This is {{ profileUser.name }}'s profile page.</p>
  </div>
</template>

<script>
  export default {
    props: ["profileUser"],
  };
</script>

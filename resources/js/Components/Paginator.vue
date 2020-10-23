<template>
  <nav
    v-show="show"
    role="navigation"
    aria-label="Pagination Navigation"
    class="flex justify-between"
  >
    <span
      v-if="collection.meta.current_page == 1"
      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
    >
      prev
    </span>
    <inertia-link
      v-else
      :href="collection.links.prev"
      rel="prev"
      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
    >
      prev
    </inertia-link>

    <inertia-link
      v-if="collection.links.next != null"
      :href="collection.links.next"
      rel="next"
      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
    >
      next
    </inertia-link>
    <span
      v-else
      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
    >
      next
    </span>
  </nav>
</template>

<script>
  export default {
    props: ["collection", "show"],
  };
</script>
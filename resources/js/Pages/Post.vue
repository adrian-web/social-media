<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
            <show-post :post="post" />
            <show-comments />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
  import AppLayout from "./../Layouts/AppLayout";
  import ShowPost from "./Components/ShowPost";
  import ShowComments from "./Components/ShowComments";

  export default {
    props: ["post"],

    components: {
      AppLayout,
      ShowPost,
      ShowComments,
    },
  };
</script>

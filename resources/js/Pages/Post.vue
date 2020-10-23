<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
            <show-post :post="post.data" :key="post.data.id" />
            <show-comments
              :post="post.data"
              :key="post.data.id"
              :comments="comments"
            />
            <create-comment :post="post.data" />
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
  import CreateComment from "./Components/CreateComment";

  export default {
    props: ["can", "post", "comments"],

    components: {
      AppLayout,
      ShowPost,
      ShowComments,
      CreateComment,
    },
  };
</script>

<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Activity
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 border-b border-gray-200 text-gray-500">
            <show-activity :profileUser="profileUser.data" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
  import AppLayout from "./../Layouts/AppLayout";
  import ShowActivity from "./Components/ShowActivity";

  export default {
    props: ["profileUser"],

    components: {
      AppLayout,
      ShowActivity,
    },
  };
</script>

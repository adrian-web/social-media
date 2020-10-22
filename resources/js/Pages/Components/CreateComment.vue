<template>
  <form @submit.prevent="createComment">
    <div class="mt-4 shadow shadow-md sm:rounded-md">
      <div class="px-4 py-5 sm:p-6">
        <jet-label for="body" value="Body" />
        <textarea
          id="body"
          rows="10"
          v-model="form.body"
          ref="body"
          class="form-textarea shadow shadow-sm mt-1 w-full"
          required
        ></textarea>
        <jet-input-error :message="form.error('body')" class="mt-2" />
      </div>
      <div class="flex items-center justify-end px-4 py-3 bg-gray-50 sm:px-6">
        <jet-button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </jet-button>
      </div>
    </div>
  </form>
</template>

<script>
  import JetLabel from "./../../Jetstream/Label";
  import JetInputError from "./../../Jetstream/InputError";
  import JetButton from "./../../Jetstream/Button";

  export default {
    components: {
      JetButton,
      JetInputError,
      JetLabel,
    },

    props: ["post"],

    data() {
      return {
        form: this.$inertia.form(
          {
            body: "",
          },
          {
            bag: "createComment",
            resetOnSuccess: true,
          }
        ),
      };
    },

    methods: {
      createComment() {
        this.form
          .post(route("comments.store", this.post), {
            preserveScroll: true,
          })
          .then(() => {
            this.$refs.body.focus();
            this.$root.$emit("created-comment");
          });
      },
    },
  };
</script>

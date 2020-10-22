<template>
  <div class="contents">
    <jet-secondary-button @click.native="creatingPost = true">
      Create
    </jet-secondary-button>

    <submit-modal
      :show="creatingPost"
      :submit="createPost"
      @close="creatingPost = false"
    >
      <template #title> Create Post </template>

      <template #content>
        <div class="mt-4 shadow shadow-md sm:rounded-md">
          <div class="px-4 py-5 sm:p-6">
            <jet-label for="title" value="Title" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              required
            />
            <jet-input-error :message="form.error('title')" class="mt-2" />

            <jet-label class="mt-2" for="body" value="Body" />
            <textarea
              id="body"
              rows="10"
              v-model="form.body"
              ref="body"
              class="form-textarea rounded-md shadow-sm mt-1 block w-full"
              required
            ></textarea>
            <jet-input-error :message="form.error('body')" class="mt-2" />
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click.native="creatingPost = false">
          Nevermind
        </jet-secondary-button>

        <jet-button
          class="ml-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </jet-button>
      </template>
    </submit-modal>
  </div>
</template>

<script>
  import SubmitModal from "./../../Components/SubmitModal";
  import JetSecondaryButton from "./../../Jetstream/SecondaryButton";
  import JetInput from "./../../Jetstream/Input";
  import JetLabel from "./../../Jetstream/Label";
  import JetInputError from "./../../Jetstream/InputError";
  import JetButton from "./../../Jetstream/Button";

  export default {
    components: {
      SubmitModal,
      JetSecondaryButton,
      JetInput,
      JetButton,
      JetInputError,
      JetLabel,
    },

    data() {
      return {
        creatingPost: false,
        form: this.$inertia.form(
          {
            title: "",
            body: "",
          },
          {
            bag: "createPost",
            resetOnSuccess: true,
          }
        ),
      };
    },

    methods: {
      createPost() {
        this.form.post(route("posts.store")).then(() => {
          this.creatingPost = false;
          this.$root.$emit("created-post");
        });
      },
    },
  };
</script>

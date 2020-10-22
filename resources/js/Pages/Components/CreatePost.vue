<template>
  <span class="flex items-center">
    <nav-button class="h-full" @click.native="creatingPost = true">
      Create
    </nav-button>

    <submit-modal
      :show="creatingPost"
      :submit="createPost"
      @close="creatingPost = false"
    >
      <template #title> Create Post </template>

      <template #content>
        <jet-label for="title" value="Title" />
        <jet-input
          id="title"
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
          class="form-textarea rounded-md shadow-sm mt-1 block w-full"
          required
        ></textarea>
        <jet-input-error :message="form.error('body')" class="mt-2" />
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
  </span>
</template>

<script>
  import SubmitModal from "./../../Components/SubmitModal";
  import JetSecondaryButton from "./../../Jetstream/SecondaryButton";
  import JetInput from "./../../Jetstream/Input";
  import JetLabel from "./../../Jetstream/Label";
  import JetInputError from "./../../Jetstream/InputError";
  import JetButton from "./../../Jetstream/Button";
  import NavButton from "./../../Components/NavButton";

  export default {
    components: {
      SubmitModal,
      JetSecondaryButton,
      JetInput,
      JetButton,
      JetInputError,
      JetLabel,
      NavButton,
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
        this.form.post(route("posts.store"), {
          preserveScroll: true,
          onSuccess: () => {
            if (!this.form.hasErrors()) {
              this.creatingPost = false;
            }
          },
        });
      },
    },
  };
</script>

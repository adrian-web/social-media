<template>
  <div>
    <div class="flex" v-show="!editing">
      <div class="flex flex-col">
        <div class="font-medium text-lg">
          {{ post.title }}
        </div>
        <div class="mt-1 text-xs">
          <span>created by</span>
          <inertia-link class="hover:underline" :href="post.creator.path">
            {{ post.creator.name }}
          </inertia-link>
        </div>
      </div>
      <div class="flex items-start ml-auto">
        <button type="button" @click="editing = !editing">
          <span class="fa fa-chevron-down"></span>
        </button>
      </div>
    </div>

    <div class="mt-3" v-show="!editing">
      {{ post.body }}
    </div>

    <div class="mt-1" v-show="editing">
      <form @submit.prevent="editingPost">
        <jet-label for="title" value="Title" />
        <jet-input
          id="title"
          type="text"
          class="mt-1 block w-full"
          v-model="editPostForm.title"
          required
        />
        <jet-input-error :message="editPostForm.error('title')" class="mt-2" />

        <jet-label class="mt-2" for="body" value="Body" />
        <textarea
          id="body"
          rows="5"
          class="form-textarea rounded-md shadow-sm mt-1 block w-full"
          v-model="editPostForm.body"
          required
        ></textarea>
        <jet-input-error :message="editPostForm.error('body')" class="mt-2" />

        <div class="flex mt-2">
          <jet-secondary-button @click.native="editingClose">
            Cancel
          </jet-secondary-button>

          <jet-button
            class="ml-2"
            :class="{ 'opacity-25': editPostForm.processing }"
            :disabled="editPostForm.processing"
          >
            Update
          </jet-button>
          <button
            type="button"
            class="text-xl ml-auto"
            :class="{ 'opacity-25': deletePostForm.processing }"
            :disabled="deletePostForm.processing"
            @click="deletingPost"
          >
            <span class="fa fa-trash-o"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import JetInput from "./../../Jetstream/Input";
  import JetLabel from "./../../Jetstream/Label";
  import JetInputError from "./../../Jetstream/InputError";
  import JetSecondaryButton from "./../../Jetstream/SecondaryButton";
  import JetButton from "./../../Jetstream/Button";

  export default {
    components: {
      JetInput,
      JetLabel,
      JetInputError,
      JetSecondaryButton,
      JetButton,
    },

    props: ["post"],

    data() {
      return {
        deletePostForm: this.$inertia.form(),
        editing: false,
        cacheTitle: this.post.title,
        cacheBody: this.post.body,
        editPostForm: this.$inertia.form(
          {
            title: this.post.title,
            body: this.post.body,
          },
          {
            bag: "editPost",
            resetOnSuccess: false,
          }
        ),
      };
    },

    methods: {
      deletingPost() {
        this.deletePostForm.delete(route("posts.destroy", this.post));
      },
      editingPost() {
        this.editPostForm.put(route("posts.update", this.post), {
          preserveScroll: true,
          onSuccess: () => {
            if (!this.editPostForm.hasErrors()) {
              this.cacheTitle = this.editPostForm.title;
              this.cacheBody = this.editPostForm.body;
              this.editing = false;
            }
          },
        });
      },
      editingClose() {
        this.editPostForm.title = this.cacheTitle;
        this.editPostForm.body = this.cacheBody;
        this.editing = false;
      },
    },
  };
</script>

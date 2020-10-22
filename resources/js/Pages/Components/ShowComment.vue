<template>
  <div>
    <div class="flex items-center" v-show="!editing">
      <div class="flex">
        <img
          class="h-6 w-6 rounded-full object-cover"
          :src="comment.owner.profile_photo_url"
          :alt="comment.owner.name"
        />
        <span class="mx-1 text-xs">posted by</span>
        <inertia-link
          class="hover:underline text-xs"
          :href="comment.owner.path"
        >
          {{ comment.owner.name }}
        </inertia-link>
        <span class="ml-1 text-xs" v-text="ago(comment)"></span>
      </div>

      <div class="flex ml-auto">
        <button type="button" class="ml-auto" @click="editing = !editing">
          <span class="fa fa-chevron-down"></span>
        </button>
      </div>
    </div>

    <div class="mt-3" v-show="!editing">
      {{ comment.body }}
    </div>

    <div class="mt-1" v-show="editing">
      <form @submit.prevent="editingComment">
        <jet-label class="mt-2" for="body" value="Body" />
        <textarea
          id="body"
          rows="5"
          class="form-textarea rounded-md shadow-sm mt-1 block w-full"
          v-model="editCommentForm.body"
          required
        ></textarea>
        <jet-input-error
          :message="editCommentForm.error('body')"
          class="mt-2"
        />

        <div class="flex mt-2">
          <jet-secondary-button @click.native="editingClose">
            Cancel
          </jet-secondary-button>

          <jet-button
            class="ml-2"
            :class="{ 'opacity-25': editCommentForm.processing }"
            :disabled="editCommentForm.processing"
          >
            Update
          </jet-button>
          <button
            type="button"
            class="text-xl ml-auto"
            :class="{ 'opacity-25': deleteCommentForm.processing }"
            :disabled="deleteCommentForm.processing"
            @click="deletingComment"
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

    props: ["comment"],

    data() {
      return {
        deleteCommentForm: this.$inertia.form(),
        editing: false,
        cacheBody: this.comment.body,
        editCommentForm: this.$inertia.form(
          {
            body: this.comment.body,
          },
          {
            bag: "editComment",
            resetOnSuccess: false,
          }
        ),
      };
    },

    methods: {
      ago(comment) {
        return moment(comment.created_at).fromNow();
      },
      deletingComment() {
        this.deleteCommentForm.delete(
          route("comments.destroy", {
            post: this.comment.post,
            comment: this.comment,
          }),
          {
            preserveScroll: true,
          }
        );
      },
      editingComment() {
        this.editCommentForm.put(
          route("comments.update", {
            post: this.comment.post,
            comment: this.comment,
          }),
          {
            preserveScroll: true,
            onSuccess: () => {
              if (!this.editCommentForm.hasErrors()) {
                this.cacheBody = this.editCommentForm.body;
                this.editing = false;
              }
            },
          }
        );
      },
      editingClose() {
        this.editCommentForm.body = this.cacheBody;
        this.editing = false;
      },
    },
  };
</script>

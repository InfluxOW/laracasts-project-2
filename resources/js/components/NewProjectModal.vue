<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg border border-muted" height="auto">
            <h1 class="font-normal mb-16 text-center text-2xl text-default">Let’s Start Something New</h1>
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="field mb-6">
                        <label for="title" class="label text-sm mb-2 block">Title</label>
                        <div class="control">
                            <input class="bg-page border border-muted-light rounded p-2 text-xs w-full" required name="title" type="text" value="">
                        </div>
                    </div>

                    <div class="field mb-6">
                        <label for="description" class="label text-sm mb-2 block">Description</label>
                        <div class="control">
                            <textarea class="bg-page border border-muted-light rounded p-2 text-xs w-full" required name="description" cols="50" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="field mb-2">
                        <label for="body" class="label text-sm mb-2 block">Need some tasks?</label>
                        <div class="control">
                            <input
                                class="bg-page border border-muted-light rounded p-2 text-xs w-full mb-2"
                                placeholder="Task 1"
                                name="body" type="text"
                                value=""
                                v-for="task in tasks"
                                v-model="task.value"
                            >
                        </div>
                    </div>
                        <button type="submit" class="inline-flex items-center text-xs" @click="addTask">
                            <img src="/icons/add.svg" alt="" width="32px" class="mr-2 rounded-full border border-transparent hover:border-muted-light">
                            <span class="text-muted">Add New Task Field</span>
                        </button>
                </div>
            </div>
        <footer>
            <div class="field">
                <div class="control flex items-center justify-end">
                    <button class="button hover:bg-card hover:border-accent hover:text-accent border border-transparent mr-2 is-link" type="submit">Create</button>
                    <a href="#" @click="$modal.hide('new-project')" class="text-sm text-accent no-underline whitespace-no-wrap border border-transparent hover:border-accent py-2 px-4 rounded-lg">Cancel</a>
                </div>
            </div>
        </footer>
    </modal>
</template>

<script>
    import BirdboardForm from './BirdboardForm';
    export default {
        data() {
            return {
                form: new BirdboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: ''},
                    ]
                })
            };
        },
        methods: {
            addTask() {
                this.form.tasks.push({ body: '' });
            },
            async submit() {
                if (! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }
                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>

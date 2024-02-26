<template>
    <div
        v-if="movieInfo"
        class="max-w-lg mx-auto bg-white rounded-lg overflow-hidden shadow-lg"
    >
        <img class="w-full h-auto" :src="movieInfo.url" :alt="movieInfo.name" />
        <div class="p-6">

            <!-- Form for editing -->
            <form @submit.prevent="submitEditForm" class="mt-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input v-model="editFormData.name" type="text" name="name" id="name" class="mt-1 p-2 border rounded-lg w-full">
                </div>
                <div class="mb-4">
                    <label for="publish_status" class="block text-sm font-medium text-gray-700">Publish Status</label>
                    <select v-model="editFormData.publish_status" name="publish_status" id="publish_status" class="mt-1 p-2 border rounded-lg w-full">
                        <option value="published">Published</option>
                        <option value="underConsideration">Under Consideration</option>
                    </select>
                </div>
                <button type="submit" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Save Changes</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

export default {
    setup() {
        const router = useRouter();
        const movieInfo = ref(null);
        const editFormData = ref({
            name: "",
            publish_status: ""
        });

        onMounted(() => {
            axios
                .get("/api/movie/" + router.currentRoute.value.params.id)
                .then((res) => {
                    movieInfo.value = res.data.data;
                    editFormData.value.name = movieInfo.value.name;
                    editFormData.value.publish_status = movieInfo.value.publish_status;
                })
                .catch((err) => {
                    console.log(err);
                });
        });


        const submitEditForm = () => {
            axios.put(`/api/movie/${router.currentRoute.value.params.id}`, editFormData.value)
                .then((res) => {
                    console.log("Movie updated successfully");
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        onMounted(() => {
            axios
                .get("api/genres")
                .then((res) => {
                    genres.value = res.data.data;
                    console.log(genres.value);
                })
                .catch((err) => {
                    console.log(err);
                });
        });

        return { movieInfo, editFormData, submitEditForm };
    },
};
</script>

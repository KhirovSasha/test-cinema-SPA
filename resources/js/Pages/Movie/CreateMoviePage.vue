<template>
    <div>
        <form class="max-w-sm mx-auto" @submit.prevent="submitForm">
            <div class="mb-5">
                <label
                    for="movieName"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Movie name</label
                >
                <input
                    type="text"
                    id="movieName"
                    name="movieName"
                    v-model="movieName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter movie name"
                    required
                />
            </div>
            <div class="mb-5">
                <label
                    for="image"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Upload your image</label
                >
                <input
                    type="file"
                    id="image"
                    accept="image/*"
                    @change="onImageChange"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :required="false"
                />
            </div>
            <div class="mb-5 grid grid-cols-2 gap-4">
                <div
                    class="flex items-center"
                    v-for="(genre, index) in genres"
                    :key="index"
                >
                    <input
                        :id="'checkbox_' + index"
                        type="checkbox"
                        :value="genre.id"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @change="toggleGenreSelection(genre.id)"
                    />
                    <label
                        :for="'checkbox_' + index"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >
                        {{ genre.name }}
                    </label>
                </div>
            </div>

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Submit
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
    data() {
        return {
            movieName: "",
            imageFile: null,
            selectedGenres: [],
        };
    },
    methods: {
        async submitForm() {
            try {
                const formData = new FormData();

                formData.append("name", this.movieName);

                if (this.imageFile) {
                    formData.append("image", this.imageFile);
                }

                this.selectedGenres.forEach((genreId) => {
                    formData.append("genres[]", genreId);
                });

                const response = await axios.post(
                    "/api/movie/create",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );

                this.$router.push("/");
            } catch (error) {
                console.error(error);
            }
        },
        onImageChange(event) {
            this.imageFile = event.target.files[0];
        },
        toggleGenreSelection(genreId) {
            const index = this.selectedGenres.indexOf(genreId);
            if (index === -1) {
                this.selectedGenres.push(genreId);
            } else {
                this.selectedGenres.splice(index, 1);
            }
        },
    },
    setup() {
        const genres = ref([]);

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

        return { genres };
    },
};
</script>

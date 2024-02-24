<template>
    <div>
        <form class="max-w-sm mx-auto" @submit.prevent="submitForm">
            <div class="mb-5">
                <label for="movieName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie name</label>
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
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload your image</label>
                <input
                    type="file"
                    id="image"
                    accept="image/*"
                    @change="onImageChange"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
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

export default {
    data() {
        return {
            movieName: "",
            imageFile: null,
        };
    },
    methods: {
        async submitForm() {
            try {
                const formData = new FormData();
                formData.append("name", this.movieName);
                formData.append("image", this.imageFile); 

                const response = await axios.post(
                    "/api/movie/create",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );

                console.log(response.data);
            } catch (error) {
                console.error(error);
            }
        },
        onImageChange(event) {
            this.imageFile = event.target.files[0];
        },
    },
};
</script>

<template>
    <div class="flex justify-center items-center h-screen">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">List of Genres</h2>
            <ul v-if="genres" class="list-disc list-none pl-6">
                <li v-for="genre in genres" :key="genre.id" class="text-gray-800"><router-link :to="'/infoGenre/' + genre.id" class="hover:text-blue-500">{{ genre.name }}</router-link></li>
            </ul>
            <p v-else class="text-gray-800">No genres found.</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";
export default {
    setup() {
        const genres = ref(null);

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

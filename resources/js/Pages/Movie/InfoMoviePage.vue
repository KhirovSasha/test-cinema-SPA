<template>
    <div
        v-if="movieInfo"
        class="max-w-lg mx-auto bg-white rounded-lg overflow-hidden shadow-lg"
    >
        <img class="w-full h-auto" :src="movieInfo.url" :alt="movieInfo.name" />
        <div class="p-6">
            <h1 class="text-xl font-semibold text-gray-800">
                Movie name: {{ movieInfo.name }}
            </h1>
            <p class="text-gray-600 mt-2">ID: {{ movieInfo.id }}</p>
            <p
                class="text-gray-600 mt-2"
                v-if="movieInfo.publish_status == 'published'"
            >
                Publish Status: Published
            </p>
            <p
                class="text-gray-600 mt-2"
                v-else="movieInfo.publish_status == 'underConsideration'"
            >
                Publish Status: Under Consideration
            </p>
            <button
                type="button"
                @click="changeMovieStatus"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
            >
                Change
            </button>
            <div class="mt-4">
                <h2 class="text-lg font-semibold text-gray-800">Genres</h2>
                <ul class="mt-2">
                    <li
                        v-for="genre in movieInfo.genres"
                        :key="genre.id"
                        class="text-gray-600"
                    >
                        {{ genre.name }}
                    </li>
                </ul>
            </div>
            <div class="mt-4 flex justify-center items-center">
                <button
                    @click="deleteMovie"
                    type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                >
                    Delete
                </button>
                <button
                    type="button"
                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                >
                    Edit
                </button>
            </div>
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

        onMounted(() => {
            axios
                .get("/api/movie/" + router.currentRoute.value.params.id)
                .then((res) => {
                    movieInfo.value = res.data.data;
                    console.log(movieInfo.value);
                })
                .catch((err) => {
                    console.log(err);
                });
        });
    
        const changeMovieStatus = () => {
            axios
                .put(
                    `/api/movie/${router.currentRoute.value.params.id}/change-status`
                )
                .then((res) => {
                    movieInfo.value.publish_status =
                        movieInfo.value.publish_status === "published"
                            ? "underConsideration"
                            : "published";
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        const deleteMovie = () => {
            axios.delete(`/api/movie/${router.currentRoute.value.params.id}/delete`)
            .then((res) => {
                router.push("/");
            })
            .catch((err) => {
                    console.log(err);
                });
        };

        return { movieInfo, changeMovieStatus, deleteMovie };
    },
};
</script>

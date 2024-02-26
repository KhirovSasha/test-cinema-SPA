<template>
    <div>
        <router-link to="/createMovie">
            <button
                type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            >
                Add Movie
            </button>
        </router-link>
        <router-link to="/createGenre">
            <button
                type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            >
                Add Genre
            </button>
        </router-link>
        <router-link to="/genres">
            <button
                type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            >
                Genres
            </button>
        </router-link>
        <div v-if="paginationMovies && paginationMovies.meta">
            <pagination
                :links="paginationMovies.meta.links"
                :fetch-data="fetchPaginationData"
            ></pagination>
            <div class="flex justify-center">
                <table>
                    <tr>
                        <th>№</th>
                        <th>Movie Name</th>
                        <th>Poster</th>
                        <th>Genres</th>
                        <th>Status</th>
                    </tr>
                    <tr v-for="(movie, index) in paginationMovies.data">
                        <td class="py-2 px-4">
                            {{
                                (paginationMovies.meta.current_page - 1) *
                                    paginationMovies.meta.per_page +
                                index +
                                1
                            }}
                        </td>
                        <td class="py-2 px-4">{{ movie.name }}</td>
                        <td class="py-2 px-4">
                            <img
                                class="w-32 h-28 object-cover"
                                :src="movie.url"
                                alt=""
                            />
                        </td>
                        <td class="py-2 px-4 flex flex-col">
                            <span
                                v-for="(genre, index) in movie.genres"
                                :key="index"
                                class="focus:outline-none text-white bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                                >{{ genre.name }}</span
                            >
                        </td>
                        <td
                            v-if="movie.publish_status == 'published'"
                            class="py-2 px-4"
                        >
                            <div
                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            >
                                Published
                            </div>
                        </td>
                        <td
                            class="py-2 px-4"
                            v-else="
                                movie.publish_status == 'underConsideration'
                            "
                        >
                            <div
                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            >
                                Under Consideration
                            </div>
                        </td>

                        <td class="py-2 px-4">
                            <router-link :to='"/infoMovie/" + movie.id' class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Info</router-link>
                        </td>
                        <td class="py-2 px-4 ">
                            <router-link :to='"/editMovie/" + movie.id' class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Edit</router-link>
                        </td>
                        <td class="py-2 px-4">
                            <span @click="deleteMovie(movie.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
    setup() {
        const paginationMovies = ref(null);

        const fetchPaginationData = async (url) => {
            try {
                const response = await axios.get(url);
                paginationMovies.value = response.data;
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        };

        const deleteMovie = (id) => {
            axios.delete(`/api/movie/${id}/delete`)
            .then((res) => {
                console.log(res);
            })
            .catch((err) => {
                    console.log(err);
                });
        };

        onMounted(() => {
            axios
                .get("api/pagination")
                .then((res) => {
                    paginationMovies.value = res.data;
                    console.log(paginationMovies.value);
                })
                .catch((err) => {
                    console.log(err);
                });
        });

        return { paginationMovies, fetchPaginationData, deleteMovie };
    },
};
</script>

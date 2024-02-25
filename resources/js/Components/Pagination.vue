<template>
    <div v-if="links.length > 3" class="flex justify-center mt-4 space-x-4">
        <div class="flex flex-wrap -mb-1">
            <template v-for="link in links" :key="link.label">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"
                ></div>
                <a
                    v-else-if="link.url"
                    @click.prevent="fetchData(link.url)"
                    class="px-4 py-3 text-sm leading-4 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
                    :class="{ 'bg-indigo-400 text-red': link.active }"
                    v-html="link.label"
                ></a>
            </template>
        </div>
    </div>
</template>

<script setup>

defineProps({
    links: Array,
    fetchData: Function,
});

</script>

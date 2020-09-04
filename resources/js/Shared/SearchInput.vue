<template>

    <div class="max-w-xs w-full relative text-gray-600 focus-within:text-blue-500">
        <button type="submit" class="absolute inset-y-0 left-0 flex items-center pl-4 focus:outline-none">
          <svg viewBox="0 0 20 20" fill="currentColor" class="search fill-current w-4 h-4">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <label :for="name" class="hidden"></label>
        <input @input="sendData" v-model="data" :id="name" :name="name" type="search" :placeholder="placeholder || 'Search...'" class="block w-full rounded-full pr-5 pl-10 py-1 text-lg border-2 border-transparent focus:shadow-outline focus:outline-none bg-gray-200 hover:bg-white border border-gray-400 text-gray-600 focus:bg-white">
    </div>

</template>

<script>
export default {
    name: "SearchInput",
    data: () => ({
        data: null,
    }),
    props: {
        name: {
            type: String,
            required: true,
        },
        placeholder: null,
        value: null,
    },
    methods: {
        sendData() {
          return this.$emit('input', this.data)
        },
    }

}
</script>

<style scoped>

</style>

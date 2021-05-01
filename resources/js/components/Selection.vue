<template>
    <div>
        <div>Data parsing</div>
        <ul>
            <li
                v-for="record in currency"
                :key="record.id"
                >
                {{ record.symbol }}
            </li>
        </ul>
        <select class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"
                id="cur1" name="cur1" required>
            <option selected value="EUR">EUR</option>
            <option value="F">Female</option>
            <option value="M">Male</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "Select",
    props: ["currency"],
    mounted() {
        // console.log(this.currency[0].symbol);
        console.log(this.currency);
    }
}
</script>

<style scoped>

</style>

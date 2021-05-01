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
    </div>
</template>

<script>
export default {
    name: "Data",
    props: ["currency"],
    mounted() {
        // console.log(this.currency[0].symbol);
        console.log(this.currency);
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <h2>This is our Vue index.</h2>
        <p>With spinner added</p>
        <spinner v-if="spinning"></spinner>
        <button class="text-8xl text-green-800" :disabled="spinning" @click="updateRates()">Click to Spin</button>
    </div>
</template>

<script>
    import Spinner from "../components/Spinner";
    import axios from "axios";
    export default {
        name: "Index",
        components: {
            Spinner
        },
        data: () => ({
            spinning: false
        }),/*
        mounted() {
            this.updateRates()
        },*/
        methods: {
            updateRates() {
                this.spinning = true;
                axios.get("/import")
                .then(response => {
                    console.log(response.data);
                    // this.import = response.data - mums te īsti nav, ko padot
                    this.spinning = false;
                })
                .catch(error => {
                    // this.not_found = true;
                    console.log(error.error());
                })
                /*
                this.spinning = true;
                console.log("clicked");
                // console.log("clicked");
                setTimeout(() => { this.spinning = false }, 2000)
                */
            }
        }
    }
</script>

<style scoped>

</style>

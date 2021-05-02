<template>
    <div>
        <button class="flex justify-center mt-16 mr-auto ml-auto w-80 py-4 px-4 w-24 border-2 border-blue-700 border-opacity-0 hover:border-blue-300 hover:bg-green-600 text-center text-white text-3xl font-bold hover:text-white rounded-xl"
                type="button" :disabled="spinning" @click="updateRates()">UPDATE RATES
        </button>
        <spinner class="flex justify-center mt-8" v-if="spinning"></spinner>
        <div class="flex justify-center mt-8 opacity-0" v-else>Spinner replacement text<br/>Spinner replacement text<br/>Spinner replacement text</div>
        <div class="flex justify-center mt-16 mb-5 text-center ">
            <table class="table-fixed text-center">
                <tbody>
                    <tr>
                        <td class="bg-yellow-100 rounded focus-within:outline-none mb-0.5">
                            <select class="bg-yellow-100 w-full h-full text-2xl" id="cur1" :disabled="spinning" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                        <td class="bg-yellow-400 hover:bg-yellow-500 px-5 text-2xl rounded">
                            <button class="h-10 fas" type="button" :disabled="spinning" @click="convert('left')">&#xf100;</button>
                        </td>
                        <td class="">
                            <input id="number" class="h-10 w-80 text-2xl text-center" type="text" :disabled="spinning" placeholder="Enter number..." :value="total">
                        </td>
                        <td class="bg-yellow-400 hover:bg-yellow-500 px-5 text-2xl rounded">
                            <button class="h-10 fas" type="button" :disabled="spinning" @click="convert('right')">&#xf101;</button>
                        </td>
                        <td class="bg-yellow-100 rounded focus-within:outline-none mb-0.5">
                            <select class="bg-yellow-100 w-full h-full text-2xl" id="cur2" :disabled="spinning" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-yellow-100 py-2 px-5 w-48 text-left text-2xl rounded">Buy for 1: {{ rate }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-8 text-blue-900 text-3xl">{{ errorMessage }}</div>
    </div>
</template>

<script>
    import Spinner from "../components/Spinner";
    import axios from "axios";

    let total;
    let rate;
    let errorMessage;
    export default {
        name: "Update",
        props: ["currency"],
        components: {
            Spinner
        },
        data: () => ({
            spinning: false,
            total,
            rate,
            errorMessage
        }),
        mounted() {
            console.log(this.currency);
        },
        methods: {
            updateRates() {
                this.spinning = true;
                axios.get("/import")
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error.error());
                })
                setTimeout(() => {
                    this.spinning = false;
                }, 2000);
            },
            convert(direction) {
                this.spinning = true;
                const cur1 = document.getElementById("cur1").value;
                const cur2 = document.getElementById("cur2").value;
                const num = document.getElementById("number").value;

                const url = (direction === "right") ? "/convert?cur1=" + cur1 + "&cur2=" + cur2 + "&num=" + num :
                    "/convert?cur1=" + cur2 + "&cur2=" + cur1 + "&num=" + num;

                axios.get(url)
                    .then(response => {
                        console.log(response);
                        if (response.data[0] === "FAIL") {
                            const obj = response.data[1];
                            this.errorMessage = Object.values(obj)[0][0];
                            this.total = null;
                            this.rate = null;
                            this.spinning = false;
                        }
                        if (response.data[0] === "OK") {
                            console.log(response.data[1]);
                            this.total = parseFloat(response.data[1][0]).toFixed(2);
                            this.rate = parseFloat(response.data[1][1]).toFixed(2);
                            this.errorMessage = "";
                            this.spinning = false;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })

            }
        }
    }
</script>

<style scoped>

</style>

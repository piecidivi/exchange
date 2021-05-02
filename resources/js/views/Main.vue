<template>
    <div>
        <button class="border-2 border-blue-700 border-opacity-0 font-bold hover:border-blue-300 hover:bg-green-600 hover:text-white flex justify-center w-80 py-4 px-4 w-24 rounded-xl mt-16 mr-auto ml-auto text-white text-center text-3xl"
                type="button" :disabled="spinning" @click="updateRates()">UPDATE RATES
        </button>
        <spinner class="flex justify-center mt-8" v-if="spinning"></spinner>
        <div class="flex justify-center mt-8 opacity-0" v-else>Spinner replacement text<br/>Spinner replacement text<br/>Spinner replacement text</div>
        <div class="flex justify-center mt-16 text-center mb-5">
            <table id="exchange_table" class="table-fixed text-center">
                <tbody>
                    <tr>
                        <td>
                            <select :disabled="spinning" class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"
                                    id="cur1" name="cur1" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                        <td>
                            <button class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                                    type="button" :disabled="spinning" @click="convert('left')">&#xf100;
                            </button>
                        </td>
                        <td class="border-2 border-blue-700 border-collapse py-2 px-5">
                            <input :disabled="spinning" id="number" type="text" placeholder="Enter number..." :value="total" pattern="[0-9]+">
                        </td>
                        <td>
                            <button :disabled="spinning" class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                                    type="button" @click="convert('right')">&#xf101;
                            </button>
                        </td>
                        <td>
                            <select :disabled="spinning" class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"
                                    id="cur2" name="cur2" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="border-2 border-blue-700 border-collapse py-2 px-5 w-28">{{ rate }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-8 text-2xl text-green-800">{{ errorMessage }}</div>
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
                            // console.log(errorMessage);
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

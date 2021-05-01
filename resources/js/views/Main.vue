<template>
    <div>
        <button class="border-2 border-blue-700 border-opacity-0 font-bold hover:border-blue-300 hover:bg-green-600 hover:text-white flex justify-center w-80 py-4 px-4 w-24 rounded-xl mt-16 mr-auto ml-auto text-white text-center text-3xl"
                type="button" :disabled="spinning" @click="updateRates()">UPDATE RATES
        </button>
        <spinner class="flex justify-center mt-8" v-if="spinning"></spinner>
        <div class="flex justify-center mt-8 opacity-0" v-else>This is opacity text<br/>Some more text<br/>Some more text</div>
        <div class="flex justify-center mt-16 text-center mb-5">
            <table id="exchange_table" class="table-fixed text-center">
                <tbody>
                    <tr>
                        <td>
                            <select class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"
                                    id="cur1" name="cur1" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                        <td>
                            <button class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                                    type="button" :disabled="spinning" @click="testMe()">&#xf100;
                            </button>
                        </td>
                        <td class="border-2 border-blue-700 border-collapse py-2 px-5">
                            <input id="some_id" oninput="" type="text" placeholder="Enter number..." pattern="[0-9]+">
                        </td>
                        <td>
                            <button class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                                    type="button" id="right" name="right" onclick="">&#xf101;
                            </button>
                        </td>
                        <td>
                            <select class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"
                                    id="cur2" name="cur2" required>
                                <option disabled selected value>--SELECT--</option>
                                <option v-for="record in currency" :key="record.id" :value="record.symbol">{{ record.symbol }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td id="output_rate" class="border-2 border-blue-700 border-collapse py-2 px-5 w-28">"1->X or X<-1"</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Spinner from "../components/Spinner";
    import axios from "axios";
    export default {
        name: "Update",
        props: ["currency"],
        components: {
            Spinner
        },
        data: () => ({
            spinning: false
        }),
        mounted() {
            // console.log(this.currency[0].symbol);
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
            testMe() {
                console.log("This is click! :)");
            }
        }
    }
</script>

<style scoped>

</style>

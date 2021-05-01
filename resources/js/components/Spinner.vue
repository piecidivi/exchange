<template>
    <div class="spinner">
        <flower-spinner
            :animation-duration="2800"
            :size="60"
            :color="'#29720d'"
        />
    </div>
</template>

<script>
import {FlowerSpinner} from "epic-spinners"
export default {
    name: "Spinner",
    components: {
        FlowerSpinner
    }
}
</script>

<style scoped>

</style>

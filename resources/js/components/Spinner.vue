<template>
    <div class="spinner">
        <radar-spinner
            :animation-duration="2800"
            :size="65"
            :color="'#ffffff'"
        />
    </div>
</template>

<script>
import {RadarSpinner} from "epic-spinners"
export default {
    name: "Spinner",
    components: {
        RadarSpinner
    }
}
</script>

<style scoped>

</style>

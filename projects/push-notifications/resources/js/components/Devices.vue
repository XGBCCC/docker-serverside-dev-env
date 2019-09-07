<template>
    <div class="container-fluid">
        <div class="row mx-2 my-5">
            <device-table></device-table>
        </div>
    </div>
</template>

<script>
    import DeviceTable from './DeviceTable';

    export default {
        components: {
            DeviceTable
        }
    }
</script>

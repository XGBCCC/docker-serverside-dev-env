<template>
    <div class="w-100">
        <table v-if="displayTable" class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">UUID</th>
                <th scope="col">Device token</th>
                <th scope="col">Locale</th>
                <th scope="col">Environment</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(data, index) in tableData" :key="index">
                <th scope="row">{{ index + 1 }} </th>
                <td>{{ data.uuid }}</td>
                <td>{{ data.token }}</td>
                <td>{{ data.locale }}</td>
                <td>{{ data.environment }}</td>
                <td>{{ data.updatedAt }}</td>
            </tr>
            </tbody>
        </table>
        <div v-else class="text-black-50" role="status">
            <i class="material-icons">cached</i>&nbsp;&nbsp;Fetching tokens...
        </div>
    </div>
</template>

<script>
    import AES from '../aes';
    import axios from 'axios';

    export default {
        created() {
            this.fetchTokens();

            // echo_recv.private('device.table')
            //     .listen('DeviceRegistered', (e) => {
            //         this.tableData.splice(0, 0, e.device);
            //     });
        },
        data() {
            return {
                tableData: [],
                displayTable: false
            }
        },
        methods: {
            async fetchTokens() {
                try {
                    const response = await axios.get('/api/v1/devices');
                    let data = response.data;
                    this.tableData = data.data;
                    this.displayTable = true;
                    // let aes = new AES(data.key);
                    // let thisObj = this;
                    // aes.decrypt(data.encrypted).then(function(data) {
                    //     thisObj.tableData = data.data;
                    //     thisObj.displayTable = true;
                    //     console.log(data);
                    // });
                }
                catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

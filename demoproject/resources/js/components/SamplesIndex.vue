<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createSample'}" class="btn btn-success">Create new sample code</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Sample Code list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="sample, index in samples">
                        <td>{{ sample.name }}</td>
                        <td>{{ sample.address }}</td>
                        <td>{{ sample.website }}</td>
                        <td>{{ sample.email }}</td>
                        <td>
                            <router-link :to="{name: 'editSample', params: {id: sample.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(sample.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                samples: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/samples')
                .then(function (resp) {
                    app.samples = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load sample code");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/samples/' + id)
                        .then(function (resp) {
                            app.samples.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete sample");
                        });
                }
            }
        }
    }
</script>
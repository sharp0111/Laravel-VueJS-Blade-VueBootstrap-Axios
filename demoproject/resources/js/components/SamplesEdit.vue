<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Edit sample code</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Name</label>
                            <input type="text" v-model="sample.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Description</label>
                            <input type="text" v-model="sample.description" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Code</label>
                            <input type="text" v-model="sample.code" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Status</label>
                            <input type="text" v-model="sample.status" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.sampleId = id;
            axios.get('/api/samples/' + id)
                .then(function (resp) {
                    app.sample = resp.data;
                })
                .catch(function () {
                    alert("Could not load your sample code")
                });
        },
        data: function () {
            return {
                sampleId: null,
                sample: {
                    name: '',
                    description: '',
                    code: '',
                    status: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newSample = app.sample;
                axios.patch('/api/samples/' + app.sampleId, newSample)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your sample code");
                    });
            }
        }
    }
</script>